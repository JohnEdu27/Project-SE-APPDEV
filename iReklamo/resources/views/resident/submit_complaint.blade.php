<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint - iReklamo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0088FF 0%, #FDFDFE 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .complaint-container {
            background: white;
            border-radius: 30px;
            padding: 50px;
            max-width: 650px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,136,255,0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            color: #0088FF;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: #0088FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
            box-shadow: 0 10px 20px rgba(0,136,255,0.2);
        }

        .header h2 {
            color: #333;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 15px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s, box-shadow 0.3s;
            background: #FDFDFE;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0088FF;
            box-shadow: 0 0 0 4px rgba(0,136,255,0.1);
            background: white;
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
            line-height: 1.6;
        }

        .char-count {
            text-align: right;
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .btn-submit {
            width: 100%;
            background: #0088FF;
            color: white;
            padding: 18px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            background: #0066cc;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,136,255,0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .back-link a {
            color: #0088FF;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .validation-error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 500;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .complaint-container {
                padding: 30px 25px;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="complaint-container">
        <div class="header">
            <div class="logo">IREKLAMO</div>
            <div class="icon-circle">📢</div>
            <h2>Submit a Complaint</h2>
            <p>Help us improve our community. Your report will be reviewed by barangay officials.</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif


        <form method="POST" action="{{ route('complaints.store') }}">
            @csrf

                <div class="form-group">
                    <label for="complainant_name">Complainant Name *</label>
                    <input type="text" id="complainant_name" name="complainant_name" value="{{ old('complainant_name') }}" placeholder="Your Name" required>
                    @error('complainant_name')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
                </div>
           

            <div class="form-group">
                <label for="name">Phone Number *</label>
                <input type="tel" id="contact" name="contact" value="{{ old('contact') }}" placeholder="09123456789" required>
                @error('contact')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                    <label for="purok">Location of Incident *</label>
                    <input type="text" id="purok" name="purok" value="{{ old('purok') }}" placeholder="e.g., Corner of Rizal St. and Mabini St." required>
                    @error('purok')
                        <div class="validation-error">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="text">Complaint Details *</label>
                <textarea id="text" name="text" placeholder="Please describe the issue in detail. Include dates, times, and any other relevant information..." required>{{ old('text') }}</textarea>
                <div class="char-count"><span id="charCount">0</span> characters</div>
                @error('text')
                    <div class="validation-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Submit Complaint</button>
        </form>

        <div class="back-link">
            <a href="{{ route('homepage') }}">← Back to Dashboard</a>
        </div>
    </div>

    <script>
        // Simple character counter for the textarea
        const textarea = document.getElementById('description');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });

        // Initialize count on page load if there's old input
        if(textarea.value) {
            charCount.textContent = textarea.value.length;
        }
    </script>
</body>
</html>