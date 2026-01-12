<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to KAFA Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
        color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .credentials {
            background-color: #fff;
            border: 2px solid #4CAF50;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .credentials strong {
            color: #4CAF50;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to KAFA Management System!</h1>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $user->user_name }}</strong>,</p>

        <p>Welcome to KAFA Management System! Your teacher account has been successfully created.</p>

        <p>You can now access the system using the following credentials:</p>

        <div class="credentials">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>

        <p><strong>Important:</strong> For security reasons, we recommend that you change your password after your first login.</p>

        <p>To get started, please visit the KAFA Management System and log in with your credentials.</p>

        <p>If you have any questions or need assistance, please don't hesitate to contact the administrator.</p>

        <p>Best regards,<br>
        <strong>KAFA Management System Team</strong></p>
    </div>

    <div class="footer">
        <p>This is an automated email. Please do not reply to this message.</p>
    </div>
</body>
</html>
