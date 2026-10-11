<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
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

<style>
    .container {
    display: flex;
    flex-direction: column;
    margin-left: 30px;
    margin-right: 30px;
    margin-top: 50px;
    border: 1px solid black;
    padding: 10px 10px;
    border-radius: 30px;
}
input {
    margin-bottom: 10px;
    padding: 10px 15px;
    border-radius: 30px;
}
button {
    margin-bottom: 10px;
    padding: 10px 15px;
    border-radius: 30px;
    background-color: blue;
    color: antiquewhite;
}
button :hover {
    background-color: blueviolet;
    cursor: pointer;
}
.center {
    text-align: center;
}
</style>