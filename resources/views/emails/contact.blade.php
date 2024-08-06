<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .field p {
            margin: 0;
            color: #333;
            font-size: 16px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>New Contact Form Submission</h1>
    <div class="field">
        <label>Name:</label>
        <p>{{ $data['name'] }}</p>
    </div>
    <div class="field">
        <label>Email:</label>
        <p>{{ $data['email'] }}</p>
    </div>
    <div class="field">
        <label>Message:</label>
        <p>{{ $data['message'] }}</p>
    </div>
    <div class="footer">
        This email was sent from your website's contact form.
    </div>
</div>
</body>
</html>
