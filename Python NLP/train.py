"""Run once (and whenever you add data):  python train.py
Kept separate from classifier.py so the saved models can be loaded by main.py."""
import classifier

if __name__ == "__main__":
    classifier.train()
    for t in ["Ang ingay ng videoke ng kapitbahay",
              "May nakagat na bata ng asong gala kanina",
              "Walang tubig sa gripo namin ng tatlong araw",
              "Open manhole on the road, very dangerous"]:
        print(t, "->", classifier.predict(t))
