<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Company!</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #666666;
            font-size: 16px;
            line-height: 1.5;
            margin: 20px 0; /* Increase space between paragraphs */
            display: block; /* Ensure paragraphs are block elements */
        }
        strong {
            color: #333333;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #999999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Welcome, {{ $user->firstname }}!</h1>
        <p>We are excited to have you join our team. Below are your login details:</p>
        <p><strong>Email:</strong> {{ $user->email }}<br>
        <strong>Password:</strong> {{ $password }}</p>
        <p>Please log in to your account and change your password as soon as possible. We look forward to working with you!</p>
        <p class="footer">Best Regards,<br>Your Company Name</p>
    </div>
</body>
</html>
