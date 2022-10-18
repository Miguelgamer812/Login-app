<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="/register" method="POST">
        @csrf <!-- Este comando nos ayuda a agregar nuestro campo oculto para poder manejar tokens yb evitar problemas de seguridad-->
        <input type="text" placeholder="User name" name="username">
        <input type="email" placeholder="e-mail" name="email">
        <input type="password" placeholder="***********" name="password">
        <input type="password" placeholder="***********" name="password_confirmation">
        <input type="submit" value="Register">
    </form>
</body>
</html>