"""FastAPI bridge between Laravel and the Naive Bayes classifier. It never touches MySQL.

Run:  python train.py   (once)
      uvicorn main:app --port 8000
Docs: http://127.0.0.1:8000/docs
"""
import os
import threading
from typing import Literal

import pandas as pd
from fastapi import Depends, FastAPI, Header, HTTPException
from pydantic import BaseModel, Field

import classifier

app = FastAPI(title="Barangay Complaint NLP Service")
API_KEY = os.getenv("NLP_API_KEY")  # optional shared secret; if set, Laravel must send it as X-API-Key
_retrain_lock = threading.Lock()


def check_key(x_api_key: str | None = Header(default=None)):
    if API_KEY and x_api_key != API_KEY:
        raise HTTPException(status_code=401, detail="Invalid API key")


class ClassifyIn(BaseModel):
    text: str = Field(min_length=5, max_length=2000)


class Example(BaseModel):
    text: str
    category: str | None = None  # staff-verified; either field may be missing
    urgency: Literal["low", "medium", "high"] | None = None


class RetrainIn(BaseModel):
    examples: list[Example] = []


@app.get("/health")
def health():
    return {"status": "ok"}


@app.post("/classify", dependencies=[Depends(check_key)])
def classify(body: ClassifyIn):
    try:
        return classifier.predict(body.text)
    except FileNotFoundError:
        raise HTTPException(status_code=503, detail="Model not trained yet. Run: python train.py")


@app.post("/retrain", dependencies=[Depends(check_key)])
def retrain(body: RetrainIn):
    """Seed data + staff-verified complaints (category and/or urgency) sent by Laravel."""
    if not _retrain_lock.acquire(blocking=False):
        raise HTTPException(status_code=409, detail="Retraining already in progress")
    try:
        seed = pd.read_csv("data/sample_complaints.csv")
        extra = pd.DataFrame([e.model_dump() for e in body.examples], columns=["text", "category", "urgency"])
        data = pd.concat([seed, extra]).dropna(subset=["text"]).drop_duplicates("text")
        data.to_csv("data/training_data.csv", index=False)
        classifier.train("data/training_data.csv", evaluate=False)
        classifier.reset_cache()
        return {"message": "retrained", "total_examples": len(data), "added": len(extra)}
    finally:
        _retrain_lock.release()
