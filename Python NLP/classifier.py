"""Complaint text classifier. Two separate models share the same pipeline:
Bag-of-words (unigrams + bigrams) + Multinomial Naive Bayes -> one predicts category, one predicts urgency."""
import os
import re

import joblib
import pandas as pd
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.metrics import classification_report
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import MultinomialNB
from sklearn.pipeline import Pipeline

MODEL_PATHS = {
    "category": "models/category_nb.joblib",
    "urgency": "models/urgency_nb.joblib",
}
CONFIDENCE_THRESHOLD = 0.5  # category confidence below this -> flag for manual review

# Common English + Tagalog filler words that carry little signal
STOPWORDS = set("""
a an the is are was were to of in on at for and or but with from by it this that
ang ng sa na at ay mga si ni kay para po ako namin amin ninyo nila nang kasi pero
din rin lang lamang naman pa na yung iyong ito iyon dito doon may mayroon wala
""".split())


def preprocess(text: str) -> str:
    text = text.lower()
    text = re.sub(r"[^a-zñ0-9\s-]", " ", text)
    tokens = [t for t in text.split() if t not in STOPWORDS and len(t) > 1]
    return " ".join(tokens)


def build_pipeline() -> Pipeline:
    return Pipeline([
        ("bow", CountVectorizer(preprocessor=preprocess, ngram_range=(1, 2))),
        ("nb", MultinomialNB(alpha=0.1)),
    ])


def _train_one(df: pd.DataFrame, label: str, evaluate: bool) -> bool:
    """Train one model on the rows that have a value for `label`. Rows missing it are ignored."""
    d = df.dropna(subset=["text", label])
    if d[label].nunique() < 2:
        print(f"Skipped {label}: need at least 2 different values.")
        return False
    if evaluate:
        try:
            X_tr, X_te, y_tr, y_te = train_test_split(
                d["text"], d[label], test_size=0.2, stratify=d[label], random_state=42)
            m = build_pipeline().fit(X_tr, y_tr)
            print(f"--- {label} (held-out test) ---")
            print(classification_report(y_te, m.predict(X_te), zero_division=0))
        except ValueError as e:
            print(f"Skipped evaluation for {label}: {e}")
    model = build_pipeline().fit(d["text"], d[label])  # final model uses all rows
    joblib.dump(model, MODEL_PATHS[label])
    return True


def train(csv_path: str = "data/sample_complaints.csv", evaluate: bool = True) -> None:
    """CSV columns: text, category, urgency (urgency is optional)."""
    df = pd.read_csv(csv_path)
    os.makedirs("models", exist_ok=True)
    _train_one(df, "category", evaluate)
    if "urgency" in df.columns:
        _train_one(df, "urgency", evaluate)
    reset_cache()


_models = {}


def load_model(label: str):
    if label not in _models:
        path = MODEL_PATHS[label]
        if not os.path.exists(path):
            if label == "category":
                raise FileNotFoundError(path)
            return None  # urgency model is optional
        _models[label] = joblib.load(path)
    return _models[label]


def reset_cache():
    _models.clear()


def _rank(model, text: str):
    probs = model.predict_proba([text])[0]
    return sorted(zip(model.classes_, probs), key=lambda p: p[1], reverse=True)


def predict(text: str) -> dict:
    ranked = _rank(load_model("category"), text)
    label, prob = ranked[0]
    result = {
        "category": str(label),
        "confidence": round(float(prob), 3),
        "needs_review": bool(prob < CONFIDENCE_THRESHOLD),
        "top3": [(str(c), round(float(p), 3)) for c, p in ranked[:3]],
        "urgency": None,
        "urgency_confidence": None,
    }
    urgency_model = load_model("urgency")
    if urgency_model is not None:
        u_label, u_prob = _rank(urgency_model, text)[0]
        result["urgency"] = str(u_label)
        result["urgency_confidence"] = round(float(u_prob), 3)
    return result
