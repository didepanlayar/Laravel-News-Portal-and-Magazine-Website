<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
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
        {!! $body !!}

        <div class="footer">
            <p>This email was sent automatically. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
