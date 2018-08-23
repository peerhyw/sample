<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmaiton</title>
</head>
<body>
    <h1>Thanks to sign up</h1>

    <p>
        Click the link to complete
        <a href="{{ route('confirm_email',$user->activation_token) }}">{{ route('confirm_email',$user->activation_token) }}</a>
    </p>

    <p>
        If this is not your own operation, please ignore this message.
    </p>
</body>
</html>