
<?php
session_start();
require_once "includes/db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $pass = $_POST["password"] ?? "";
    $confirm = $_POST["confirm_password"] ?? "";

    if ($name === "" || $email === "" || $pass === "" || $confirm === "") {
        $error = "Please fill all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } elseif (strlen($pass) < 8) {
        $error = "Password must contain at least 8 characters.";
    } elseif ($pass !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        try {
            $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check->execute([$email]);

            if ($check->fetch()) {
                $error = "This email is already registered.";
            } else {
                $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

                $stmt = $conn->prepare(
                    "INSERT INTO users (full_name, email, password)
                     VALUES (?, ?, ?)"
                );

                $stmt->execute([$name, $email, $hashedPassword]);

                $success = "Account created successfully!";
            }
        } catch (PDOException $e) {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account | Resumate AI</title>

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
    max-width: 440px;
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
    margin: 9px 0 15px;
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

.message { color: #16834c; }
.error { color: #c03959; }
a { color: #8753bd; text-decoration: none; }
</style>
</head>

<body>
<div class="auth-card">

    <h1>Create Account</h1>
    <p>Join Resumate AI and improve your resume.</p>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($success): ?>

        <p class="message"><?= htmlspecialchars($success) ?></p>
        <p><a href="login.php">Go to Login →</a></p>

    <?php else: ?>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Enter your name" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimum 8 characters" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm password" required>

        <button type="submit">Create Account →</button>

    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>

    <?php endif; ?>

</div>
</body>
</html>
