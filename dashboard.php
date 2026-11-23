
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userName = $_SESSION["user_name"] ?? "User";
$userEmail = $_SESSION["user_email"] ?? "";

require_once "includes/db.php";

$statsQuery = $conn->prepare(
    "SELECT
        COUNT(*) AS total,
        COALESCE(ROUND(AVG(ats_score)), 0) AS average_score,
        COALESCE(MAX(ats_score), 0) AS best_score
     FROM analysis_history
     WHERE user_id = ?"
);

$statsQuery->execute([$_SESSION["user_id"]]);
$stats = $statsQuery->fetch();

$historyQuery = $conn->prepare(
    "SELECT ats_score, matched_count, missing_count, created_at
     FROM analysis_history
     WHERE user_id = ?
     ORDER BY created_at DESC
     LIMIT 10"
);

$historyQuery->execute([$_SESSION["user_id"]]);
$history = $historyQuery->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Resumate AI</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    min-height: 100vh;
    color: #49345e;
    background: linear-gradient(135deg,#f5edff,#fff0f6,#e8f7ff);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 7%;
    background: rgba(255,255,255,.48);
    border-bottom: 1px solid rgba(255,255,255,.8);
    backdrop-filter: blur(20px);
}

.logo {
    font-size: 25px;
    font-weight: 800;
    color: #8052b5;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 22px;
}

.nav-links a {
    text-decoration: none;
    color: #654b7b;
    font-weight: 600;
}

.logout {
    padding: 10px 20px;
    border-radius: 25px;
    color: white !important;
    background: linear-gradient(110deg,#9861d5,#d77fb8);
}

.container {
    width: 90%;
    max-width: 1150px;
    margin: 45px auto;
}

.welcome {
    padding: 38px;
    border-radius: 25px;
    background: linear-gradient(
        120deg,
        rgba(210,185,250,.45),
        rgba(255,202,226,.4),
        rgba(183,225,250,.45)
    );
    border: 1px solid white;
    backdrop-filter: blur(22px);
    box-shadow: 0 15px 40px rgba(120,80,150,.10);
}

.welcome h1 {
    font-size: 32px;
    margin-bottom: 12px;
}

.welcome p {
    color: #78678b;
    line-height: 1.7;
}

.section-title {
    margin: 35px 0 20px;
    font-size: 23px;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 22px;
}

.dashboard-card {
    padding: 27px;
    border-radius: 22px;
    background: rgba(255,255,255,.42);
    border: 1px solid rgba(255,255,255,.9);
    backdrop-filter: blur(20px);
    box-shadow: 0 12px 32px rgba(120,80,150,.09);
    transition: .3s;
}

.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 35px rgba(120,80,150,.15);
}

.card-icon {
    font-size: 34px;
    margin-bottom: 16px;
}

.dashboard-card h3 {
    margin-bottom: 12px;
    color: #63447d;
}

.dashboard-card p {
    color: #82728e;
    line-height: 1.6;
    font-size: 14px;
    min-height: 65px;
}

.card-btn {
    display: inline-block;
    margin-top: 18px;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    font-weight: bold;
    background: linear-gradient(110deg,#9861d5,#d77fb8,#83c5e6);
}

.profile-card {
    margin-top: 30px;
    padding: 25px;
    border-radius: 20px;
    background: rgba(255,255,255,.42);
    border: 1px solid white;
}

.profile-card p {
    margin-top: 12px;
    color: #78678b;
}

footer {
    text-align: center;
    padding: 30px 15px;
    color: #897b96;
}

@media(max-width:800px) {
    .dashboard-grid {
        grid-template-columns: repeat(2,1fr);
    }
}

@media(max-width:550px) {
    .navbar {
        padding: 18px 5%;
        flex-wrap: wrap;
        gap: 15px;
    }

    .nav-links {
        gap: 12px;
        font-size: 13px;
    }

    .container {
        margin: 25px auto;
    }

    .welcome {
        padding: 25px;
    }

    .welcome h1 {
        font-size: 25px;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body>

<nav class="navbar">
    <div class="logo">✦ Resumate AI</div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="analyzer.php">Analyzer</a>
        <a href="logout.php" class="logout">Logout ↗</a>
    </div>
</nav>

<main class="container">

    <section class="welcome">
        <h1>Welcome Back, <?= htmlspecialchars($userName) ?>! 👋</h1>

        <p>
            Your personal resume improvement workspace is ready.
            Analyze your resume, improve your bullet points and get
            closer to your dream internship.
        </p>
    </section>

<h2 class="section-title">Your Performance</h2>

<section class="dashboard-grid">

    <div class="dashboard-card">
        <div class="card-icon">📊</div>
        <h3>Total Analyses</h3>
        <h2><?= (int)$stats["total"] ?></h2>
        <p>Total resumes analyzed by you.</p>
    </div>

    <div class="dashboard-card">
        <div class="card-icon">📈</div>
        <h3>Average ATS Score</h3>
        <h2><?= (int)$stats["average_score"] ?>%</h2>
        <p>Your average resume matching score.</p>
    </div>

    <div class="dashboard-card">
        <div class="card-icon">🏆</div>
        <h3>Best ATS Score</h3>
        <h2><?= (int)$stats["best_score"] ?>%</h2>
        <p>Your highest resume matching score.</p>
    </div>

</section>

<h2 class="section-title">Recent Analysis History</h2>

<div class="profile-card" style="overflow-x:auto;">

    <?php if (count($history) > 0): ?>

    <table style="width:100%; border-collapse:collapse; text-align:left;">
        <thead>
            <tr>
                <th style="padding:14px;">Date</th>
                <th style="padding:14px;">ATS Score</th>
                <th style="padding:14px;">Matched</th>
                <th style="padding:14px;">Missing</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($history as $item): ?>
            <tr>
                <td style="padding:14px;">
                    <?= htmlspecialchars(date("d M Y, h:i A", strtotime($item["created_at"]))) ?>
                </td>

                <td style="padding:14px;">
                    <strong><?= (int)$item["ats_score"] ?>%</strong>
                </td>

                <td style="padding:14px;">
                    <?= (int)$item["matched_count"] ?>
                </td>

                <td style="padding:14px;">
                    <?= (int)$item["missing_count"] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php else: ?>

        <p>No analysis history yet. Analyze your first resume to see your statistics here!</p>

    <?php endif; ?>

</div>

    <h2 class="section-title">Your Workspace</h2>

    <section class="dashboard-grid">

        <div class="dashboard-card">
            <div class="card-icon">📄</div>
            <h3>ATS Resume Analyzer</h3>
            <p>
                Check your resume against a job description and
                discover matched and missing keywords.
            </p>
            <a href="analyzer.php" class="card-btn">Analyze Resume →</a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">✨</div>
            <h3>Bullet Point Improver</h3>
            <p>
                Transform weak resume sentences into stronger,
                professional bullet points.
            </p>
            <a href="analyzer.php#bulletImprover" class="card-btn">
                Improve Bullets →
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">👤</div>
            <h3>My Account</h3>
            <p>
                View your registered account details and
                manage your Resumate AI session.
            </p>
            <a href="#profile" class="card-btn">View Profile →</a>
        </div>

    </section>

    <section class="profile-card" id="profile">
        <h2>Account Information</h2>

        <p><strong>Name:</strong>
            <?= htmlspecialchars($userName) ?>
        </p>

        <p><strong>Email:</strong>
            <?= htmlspecialchars($userEmail) ?>
        </p>

        <p><strong>Account Status:</strong> Active</p>
    </section>

</main>

<footer>
    © 2026 Resumate AI. Built to make your career journey smarter. ✦
</footer>

</body>
</html>
