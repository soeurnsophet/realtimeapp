<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Hello, {{ $user->name }},</h1>
    <h1>{{ $notifiable }}</h1>
    <p>Thank you for registering with us. We are thrilled to have you join our community.</p>
    <p>Get ready to explore everything we have to offer. If you ever have any questions, feel free to reach out.</p>
    <p>your account has been created successfully with email: {{ $user->email }}</p>
    <a href="#">Get Started</a>
    <p>Best regards,<br>
        The Laravel Team</p>
</body>

</html>