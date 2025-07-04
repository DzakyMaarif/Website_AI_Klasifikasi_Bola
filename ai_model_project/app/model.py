import tensorflow as tf
import joblib
import numpy as np
from PIL import Image
from tensorflow.keras.applications.mobilenet_v2 import preprocess_input

# Load model dan label
model = tf.keras.models.load_model('app/best_model_bola.h5')
label_map = joblib.load('app/label_map.pkl')
label_map_reverse = {v: k for k, v in label_map.items()}

def predict_image(image_path):
    # Sesuaikan ukuran input ke 224x224 dan preprocessing khusus MobileNetV2
    img = Image.open(image_path).convert('RGB').resize((224, 224))
    img_array = np.array(img)
    img_array = preprocess_input(img_array)  # normalisasi sesuai MobileNetV2
    img_array = np.expand_dims(img_array, axis=0)  # tambahkan batch dimensi

    predictions = model.predict(img_array)
    predicted_class = np.argmax(predictions, axis=1)[0]
    return label_map_reverse[predicted_class]
