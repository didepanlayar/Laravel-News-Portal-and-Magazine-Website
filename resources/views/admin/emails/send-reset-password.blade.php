<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
            color: #333;
        }
        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password Request</h2>

        <p>We received a request to reset your account password. Click the button below to reset your password:</p>

        <p style="text-align: center;">
            <a href="{{ route('admin.reset-password', ['token' => $token, 'email' => $email]) }}" class="btn" target="_blank">Reset Password</a>
        </p>

        <p>If you did not request a password reset, please ignore this email. The reset link is only valid for 60 minutes.</p>

        <p>Thank you,<br>{{ config('app.name') }} Team</p>

        <div class="footer">
            <p>This email was sent automatically. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
