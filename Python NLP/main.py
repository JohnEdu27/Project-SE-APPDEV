from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes.MultinomialNB import MultinomialNB
from sklearn.pipeline import make_pipeline

# 1. Sample labeled training data
train_sentences = ["Win a free cruise cash prize now", "Let's grab lunch tomorrow", "Claim your lottery rewards"]
train_labels = ["spam", "ham", "spam"]

# 2. Build a pipeline (Vectorizes text, then applies Multinomial Naive Bayes)
model = make_pipeline(TfidfVectorizer(), MultinomialNB())

# 3. Train the model
model.fit(train_sentences, train_labels)

# 4. Predict on a new sentence
new_message = ["Get cash prizes today"]
prediction = model.predict(new_message)
print(f"Prediction: {prediction[0]}")  # Output: spam