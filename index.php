<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f4f7; }
        .container { max-width: 400px; margin: 80px auto; padding: 24px; background: #fff; border-radius: 10px; }
        .center { text-align: center; }
        input, button { box-sizing: border-box; width: 100%; margin-bottom: 12px; padding: 10px; }
        button { border: 0; background: #0d6efd; color: #fff; cursor: pointer; }
        a { display: block; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="center">LOGIN FORM</h1>
        <form action="pakicheck.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">LOG IN</button>
        </form>
        <a href="register.php">Create an account</a>
    </div>
</body>
</html>
