<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Has Been Created</title>
    <style>
        /* Basic resets */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #4CAF50;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        .cta {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .cta:hover {
            background-color: #45a049;
        }

        .credentials {
            background-color: #f8f8f8;
            padding: 15px;
            margin: 20px 0;
            border-radius: 6px;
        }

        .credentials ul {
            list-style-type: none;
            padding: 0;
        }

        .credentials li {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 40px;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Our Charity Contribution Portal, {{ $user->email }}!</h2>
        <p>Thank you for joining our community of generous supporters. Your account has been successfully created, and we are thrilled to have you on board. Below are your login credentials:</p>

        <div class="credentials">
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Password:</strong> {{ 'defaultpassword' }}</li>
            </ul>
        </div>

        <p>We recommend you change your password after logging in for the first time to ensure the security of your account.</p>

        <a href="{{ route('login') }}" class="cta">Go to Login</a>

        <p>Your contributions can make a world of difference to those in need. Thank you for being part of this cause.</p>
        <p>If you need any assistance or have any questions, feel free to reach out to us.</p>

        <div class="footer">
            <p>Best regards,<br>The Charity Team</p>
            <p><a href="mailto:support@example.com">Contact Support</a></p>
        </div>
    </div>
</body>
</html>
