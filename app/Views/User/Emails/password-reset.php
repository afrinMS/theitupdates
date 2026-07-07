<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #cca541;
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
        }
        .email-body {
            padding: 30px;
        }
        .email-body h2 {
            color: #cca541;
            margin-top: 0;
        }
        .email-body p {
            margin-bottom: 15px;
        }
        .reset-button {
            display: inline-block;
            background-color: #cca541;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .reset-button:hover {
            background-color: #10a860;
        }
        .reset-link-text {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #cca541;
            word-break: break-all;
        }
        .email-footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Password Reset Request</h1>
        </div>

        <div class="email-body">
            <h2>Hello <?= htmlspecialchars($user['name']) ?>,</h2>

            <p>We received a request to reset the password for your TheITUpdates account. If you made this request, click the button below to reset your password.</p>

            <center>
                <a href="<?= htmlspecialchars($resetLink) ?>" class="reset-button">Reset Your Password</a>
            </center>

            <p>Or copy and paste this link into your browser:</p>
            <div class="reset-link-text">
                <?= htmlspecialchars($resetLink) ?>
            </div>

            <div class="warning">
                <strong>⚠️ Security Notice:</strong> This password reset link will expire in <?= $expiresIn ?>. If you didn't request a password reset, please ignore this email or contact our support team if you have concerns.
            </div>

            <p><strong>For your security:</strong></p>
            <ul>
                <li>Never share this link with anyone</li>
                <li>Do not forward this email to others</li>
                <li>If you didn't request this, you can safely delete this email</li>
            </ul>
        </div>

        <div class="email-footer">
            <p>&copy; <?= date('Y') ?> TheITUpdates. All rights reserved.</p>
            <p>
                This is an automated email. Please do not reply to this message.
                <br>If you need help, visit our <a href="<?= base_url('contact') ?>" style="color: #cca541; text-decoration: none;">Contact Us</a> page.
            </p>
        </div>
    </div>
</body>
</html>
