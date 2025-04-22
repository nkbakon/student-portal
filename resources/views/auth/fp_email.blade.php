<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Preparation Fees Report</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px auto;
            width: 80%;
        }

        .header-title {
            color: #193cb8;
            font-size: 16px;
            padding: 10px;
        }

        .logo-header {
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 150px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
       <div class="logo-header">
            <div class="logo">
                <img src="{{ $message->embed(public_path('assets/logo.png')) }}" alt="NEXTGENEDU Logo" />
            </div>
       </div><br>
       <h1 class="header-title">Reset Your Password</h1><br>
        <p>Click the link below to reset the password for your account.</p>
        <a href="{{ route('password.recovery', ['token' => $token, 'email' => $email]) }}">Reset Password</a>
    </div>
</body>
</html>