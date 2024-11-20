<!DOCTYPE html>
<html>
<head>
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            Your OTP Code
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>Your OTP code is:</p>
            <div class="otp">{{ $otp }}</div>
            <p>This code is valid for 5 minutes. Please do not share it with anyone.</p>
            <p>Thank you for using our service.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Contributions. All rights reserved.
        </div>
    </div>
</body>
</html>
