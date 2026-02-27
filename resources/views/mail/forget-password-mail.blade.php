<div>
    <h1>Hello {{ $user->name }},</h1>
    <p>You have requested to reset your password. Please use the following OTP to reset your password:</p>
    <h2>{{ $otp }}</h2>
    <p>This OTP is valid for the next 5 minutes. If you did not request a password reset, please ignore this email.</p>
    <p>Best regards,<br>AESport Team</p>
</div>
