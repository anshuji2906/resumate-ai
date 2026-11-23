
<?php
session_start();
require_once "includes/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $pass = $_POST["password"] ?? "";

    if ($email === "" || $pass === "") {
        $error = "Please enter email and password.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user["password"])) {

            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["full_name"];
            $_SESSION["user_email"] = $user["email"];

            header("Location: dashboard.php");
            exit;

        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Resumate AI</title>

<style>
* { box-sizing: border-box; }

body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg,#f4eaff,#ffeaf3,#e5f5ff);
    padding: 20px;
}

.auth-card {
    width: 100%;
    max-width: 420px;
    padding: 38px;
    border-radius: 25px;
    background: rgba(255,255,255,.48);
    border: 1px solid rgba(255,255,255,.9);
    backdrop-filter: blur(22px);
    box-shadow: 0 15px 45px rgba(120,80,150,.13);
}

h1 { color: #573b70; text-align: center; }
p { color: #82728e; text-align: center; }

label {
    color: #573b70;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 14px;
    margin: 9px 0 18px;
    border: 1px solid #dfc9ee;
    border-radius: 12px;
    background: rgba(255,255,255,.65);
    outline: none;
}

button {
    width: 100%;
    padding: 15px;
    border: 0;
    border-radius: 30px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    background: linear-gradient(110deg,#9861d5,#d77fb8,#83c5e6);
}

.error { color: #c03959; }
a { color: #8753bd; text-decoration: none; }
</style>
</head>

<body>
<div class="auth-card">

    <h1>Welcome Back!</h1>
    <p>Login to your Resumate AI account.</p>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <button type="submit">Login →</button>

    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>

</div>
</body>
</html>
