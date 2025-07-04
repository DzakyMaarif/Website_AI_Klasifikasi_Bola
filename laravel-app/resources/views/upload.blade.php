<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasifikasi Bola - AI Sports Recognition</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .upload-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .upload-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }

        .header-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .main-title {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            animation: fadeInUp 0.8s ease;
        }

        .subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            font-weight: 400;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .sports-icon {
            font-size: 3rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        .upload-section {
            position: relative;
            margin-bottom: 2rem;
        }

        .file-input-wrapper {
            position: relative;
            display: block;
            background: rgba(102, 126, 234, 0.1);
            border: 2px dashed #667eea;
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .file-input-wrapper:hover {
            background: rgba(102, 126, 234, 0.15);
            border-color: #764ba2;
            transform: scale(1.02);
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .file-input-wrapper:hover .upload-icon {
            color: #764ba2;
            transform: scale(1.1);
        }

        .upload-text {
            color: #495057;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .upload-hint {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .submit-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 50px;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            font-weight: 500;
            animation: slideInDown 0.5s ease;
        }

        .alert-success-custom {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
        }

        .alert-danger-custom {
            background: var(--secondary-gradient);
            color: white;
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.3);
        }

        .result-section {
            text-align: center;
            padding: 1.5rem;
            background: rgba(79, 172, 254, 0.1);
            border-radius: 15px;
            margin-bottom: 2rem;
            animation: pulse 0.5s ease;
        }

        .result-icon {
            font-size: 2.5rem;
            color: #4facfe;
            margin-bottom: 1rem;
        }

        .uploaded-image {
            max-width: 100%;
            max-height: 400px;
            width: auto;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin: 1rem auto;
            display: block;
            transition: transform 0.3s ease;
        }

        .uploaded-image:hover {
            transform: scale(1.05);
        }

        .uploaded-image-container {
            margin-top: 1.5rem;
            text-align: center;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin: 1rem 0;
            display: none;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .upload-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            .main-title {
                font-size: 2rem;
            }
            
            .file-input-wrapper {
                padding: 2rem 1rem;
            }
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="upload-card">
            <div class="header-section">
                <div class="sports-icon">
                    <i class="fas fa-basketball-ball"></i>
                </div>
                <h1 class="main-title">AI Sports Recognition</h1>
                <p class="subtitle">Upload gambar bola untuk klasifikasi otomatis menggunakan AI</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger-custom alert-custom">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    @foreach ($errors->all() as $err)
                        <div>{{ $err }}</div>
                    @endforeach
                </div>
            @endif

            @if (isset($prediction))
                <div class="result-section">
                    <div class="result-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4 class="mb-3">Hasil Klasifikasi</h4>
                    <h3 class="text-primary fw-bold mb-3">{{ ucfirst($prediction) }}</h3>
                    
                    @if (isset($imagePath))
                        <div class="uploaded-image-container">
                            <p class="text-muted mb-2">Gambar yang dianalisis:</p>
                            <img src="{{ $imagePath }}" alt="Uploaded Image" class="uploaded-image">
                        </div>
                    @endif
                </div>
            @endif

            <form action="{{ route('predict') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="upload-section">
                    <label for="image" class="file-input-wrapper">
                        <input type="file" name="image" id="image" class="file-input" accept="image/*" required>
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">Klik untuk memilih gambar</div>
                        <div class="upload-hint">atau seret dan lepas file di sini</div>
                        <div class="upload-hint mt-2">
                            <small>Format: JPG, PNG, GIF (Max: 5MB)</small>
                        </div>
                    </label>
                    <img id="imagePreview" class="preview-image" alt="Preview">
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <span class="loading-spinner" id="loadingSpinner"></span>
                    <i class="fas fa-magic me-2"></i>
                    <span id="btnText">Klasifikasi Gambar</span>
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-shield-alt me-1"></i>
                    Gambar Anda aman dan akan diproses secara lokal
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const uploadForm = document.getElementById('uploadForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const btnText = document.getElementById('btnText');
            const fileWrapper = document.querySelector('.file-input-wrapper');

            // File input change handler
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        
                        // Update wrapper text
                        const uploadText = fileWrapper.querySelector('.upload-text');
                        uploadText.textContent = file.name;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Drag and drop functionality
            fileWrapper.addEventListener('dragover', function(e) {
                e.preventDefault();
                fileWrapper.style.background = 'rgba(102, 126, 234, 0.2)';
                fileWrapper.style.borderColor = '#764ba2';
            });

            fileWrapper.addEventListener('dragleave', function(e) {
                e.preventDefault();
                fileWrapper.style.background = 'rgba(102, 126, 234, 0.1)';
                fileWrapper.style.borderColor = '#667eea';
            });

            fileWrapper.addEventListener('drop', function(e) {
                e.preventDefault();
                fileWrapper.style.background = 'rgba(102, 126, 234, 0.1)';
                fileWrapper.style.borderColor = '#667eea';
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });

            // Form submission handler
            uploadForm.addEventListener('submit', function() {
                loadingSpinner.style.display = 'inline-block';
                btnText.textContent = 'Memproses...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>