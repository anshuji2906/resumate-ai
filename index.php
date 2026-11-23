
<?php
$siteName = "Resumate AI";
$currentYear = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resumate AI | Smart Resume Analyzer</title>

    <meta name="description" content="Analyze your resume against job descriptions, discover missing keywords and improve your internship applications with Resumate AI.">

    <meta name="theme-color" content="#110817">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- BACKGROUND EFFECTS -->
<div class="ambient-background" aria-hidden="true">
    <div class="ambient-orb orb-one"></div>
    <div class="ambient-orb orb-two"></div>
    <div class="ambient-orb orb-three"></div>
</div>

<!-- NAVIGATION -->
<header class="navbar" id="navbar">

    <a href="index.php" class="logo">
        <span class="logo-icon">R</span>
        <span>Resumate<span class="logo-gradient">AI</span></span>
    </a>

    <nav class="nav-links" id="navLinks">
        <a href="#home">Home</a>
        <a href="#features">Features</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#about">About</a>
    </nav>

    <div class="nav-actions">
        <a href="login.php" class="login-btn">Login</a>
        <a href="analyzer.php" class="nav-cta">
            Get Started <span>↗</span>
        </a>
    </div>

    <button
        class="menu-btn"
        id="menuBtn"
        aria-label="Toggle navigation"
        aria-expanded="false"
    >
        ☰
    </button>

</header>

<main>

<!-- HERO SECTION -->
<section class="hero" id="home">

    <div class="hero-content">

        <div class="announcement reveal">
            <span class="live-dot"></span>
            SMART RESUME ANALYSIS FOR STUDENTS
            <span class="announcement-arrow">↗</span>
        </div>

        <h1 class="hero-title reveal">
            Your Dream Internship.
            <span class="gradient-text">
                A Better Resume.
            </span>
        </h1>

        <p class="hero-description reveal">
            Stop guessing what recruiters want.

            Analyze your resume against job descriptions,
            discover missing skills and create stronger
            project descriptions with Resumate AI.
        </p>

        <div class="hero-buttons reveal">

            <a href="analyzer.php" class="primary-btn">
                Analyze My Resume
                <span class="button-arrow">→</span>
            </a>

            <a href="#how-it-works" class="secondary-btn">
                Explore Features
                <span>↗</span>
            </a>

        </div>

        <div class="hero-trust reveal">
            <span>✓ Student Friendly</span>
            <span>✓ Smart Analysis</span>
            <span>✓ Actionable Feedback</span>
        </div>

        <div class="hero-bottom-note">
            <span class="note-line"></span>
            BUILT FOR THE NEXT GENERATION
        </div>

    </div>

    <!-- HERO VISUAL -->
    <div class="hero-visual reveal">

        <div class="visual-glow"></div>

        <div class="floating-tag tag-one">
            <span class="tag-icon">✦</span>
            Smart Analysis
        </div>

        <div class="floating-tag tag-two">
            <span class="tag-icon pink-tag">↗</span>
            Skill Insights
        </div>

        <div class="preview-card glass-card">

            <div class="preview-top">

                <div>
                    <span class="preview-label">
                        YOUR RESUME OVERVIEW
                    </span>

                    <h3>ATS Compatibility</h3>
                </div>

                <div class="preview-menu">•••</div>

            </div>

            <div class="score-section">

                <div class="score-circle">

                    <div class="score-inner">
                        <strong>78</strong>
                        <span>/100</span>
                    </div>

                </div>

                <div class="score-info">

                    <span class="score-status">
                        GOOD START
                    </span>

                    <h3>Looking Good!</h3>

                    <p>
                        Your resume has potential.
                        A few improvements can make it stronger.
                    </p>

                </div>

            </div>

            <div class="preview-divider"></div>

            <div class="keyword-heading">
                <h4>Keyword Analysis</h4>
                <span>Live Preview</span>
            </div>

            <div class="keyword-row">
                <span class="keyword-name">
                    <span class="keyword-dot green-dot"></span>
                    JavaScript
                </span>
                <span class="matched">✓ Matched</span>
            </div>

            <div class="keyword-row">
                <span class="keyword-name">
                    <span class="keyword-dot green-dot"></span>
                    HTML & CSS
                </span>
                <span class="matched">✓ Matched</span>
            </div>

            <div class="keyword-row">
                <span class="keyword-name">
                    <span class="keyword-dot red-dot"></span>
                    React.js
                </span>
                <span class="missing">✕ Missing</span>
            </div>

            <div class="keyword-row">
                <span class="keyword-name">
                    <span class="keyword-dot red-dot"></span>
                    REST API
                </span>
                <span class="missing">✕ Missing</span>
            </div>

            <div class="preview-tip">
                <span>✦</span>
                Add relevant skills only if you genuinely have them.
            </div>

            <div class="preview-footer">
                <span>RESUMATE AI ANALYSIS</span>
                <span class="footer-indicator">● DEMO</span>
            </div>

        </div>

    </div>

</section>

<!-- FEATURE SECTION -->
<section class="features section" id="features">

    <div class="section-heading reveal">

        <span class="section-label">
            ✦ POWERFUL FEATURES
        </span>

        <h2>
            Everything your resume needs
            <span class="gradient-text">to stand out.</span>
        </h2>

        <p>
            Smart tools designed to help students build
            stronger internship applications.
        </p>

    </div>

    <div class="feature-grid">

        <div class="feature-card glass-card reveal">
            <div class="feature-icon purple-icon">◉</div>
            <span class="card-number">01 / ANALYSIS</span>
            <h3>ATS Score Checker</h3>
            <p>
                Get a compatibility score based on relevant
                skills, keywords and project descriptions.
            </p>
            <span class="feature-link">Analyze compatibility →</span>
        </div>

        <div class="feature-card glass-card reveal">
            <div class="feature-icon blue-icon">⌕</div>
            <span class="card-number">02 / KEYWORDS</span>
            <h3>Keyword Gap Analyzer</h3>
            <p>
                Discover important technical skills that
                are present or missing in your resume.
            </p>
            <span class="feature-link">Find missing skills →</span>
        </div>

        <div class="feature-card glass-card reveal">
            <div class="feature-icon pink-icon">✎</div>
            <span class="card-number">03 / WRITING</span>
            <h3>Bullet Point Improver</h3>
            <p>
                Transform vague project descriptions into
                clear and impactful resume bullet points.
            </p>
            <span class="feature-link">Improve your bullets →</span>
        </div>

        <div class="feature-card glass-card reveal">
            <div class="feature-icon green-icon">↗</div>
            <span class="card-number">04 / ACTION VERBS</span>
            <h3>Action Verb Detector</h3>
            <p>
                Find weak words and discover stronger
                alternatives to improve your resume writing.
            </p>
            <span class="feature-link">Strengthen your writing →</span>
        </div>

        <div class="feature-card glass-card reveal">
            <div class="feature-icon orange-icon">◎</div>
            <span class="card-number">05 / SKILLS</span>
            <h3>Skill Gap Insights</h3>
            <p>
                Understand which relevant technologies
                you can learn for your target internship.
            </p>
            <span class="feature-link">Discover skill gaps →</span>
        </div>

        <div class="feature-card glass-card reveal">
            <div class="feature-icon violet-icon">▤</div>
            <span class="card-number">06 / REPORT</span>
            <h3>Improvement Report</h3>
            <p>
                Get a structured report with strengths,
                weaknesses and practical suggestions.
            </p>
            <span class="feature-link">View your report →</span>
        </div>

    </div>

</section>

<!-- HOW IT WORKS -->
<section class="how-section section" id="how-it-works">

    <div class="section-heading reveal">

        <span class="section-label">
            ✦ SIMPLE PROCESS
        </span>

        <h2>
            Three steps to a
            <span class="gradient-text">stronger resume.</span>
        </h2>

        <p>
            No complicated process. Just useful and
            actionable feedback.
        </p>

    </div>

    <div class="steps-grid">

        <div class="step-card glass-card reveal">
            <span class="step-number">01</span>
            <div class="step-icon">📄</div>
            <h3>Add Your Resume</h3>
            <p>
                Paste your resume text or upload your
                resume file for analysis.
            </p>
            <span class="step-bottom">YOUR EXPERIENCE</span>
        </div>

        <div class="step-card glass-card reveal">
            <span class="step-number">02</span>
            <div class="step-icon">🎯</div>
            <h3>Add Job Description</h3>
            <p>
                Provide the target internship description
                to identify relevant requirements.
            </p>
            <span class="step-bottom">YOUR TARGET ROLE</span>
        </div>

        <div class="step-card glass-card reveal">
            <span class="step-number">03</span>
            <div class="step-icon">🚀</div>
            <h3>Improve Your Resume</h3>
            <p>
                Review your score, missing keywords
                and practical improvement suggestions.
            </p>
            <span class="step-bottom">YOUR NEXT OPPORTUNITY</span>
        </div>

    </div>

</section>

<!-- ABOUT / CTA -->
<section class="cta-section glass-card reveal" id="about">

    <div class="cta-decoration cta-decoration-one"></div>
    <div class="cta-decoration cta-decoration-two"></div>

    <div class="cta-content">

        <span class="section-label">
            YOUR CAREER STARTS HERE
        </span>

        <h2>
            Don't just apply.
            <br>
            <span class="gradient-text">
                Apply smarter.
            </span>
        </h2>

        <p>
            Turn your skills and projects into a stronger
            internship application.
        </p>

        <a href="analyzer.php" class="primary-btn">
            Start Free Analysis
            <span>→</span>
        </a>

        <div class="cta-note">
            ✦ Built especially for first and second-year students.
        </div>

    </div>

</section>

</main>

<!-- FOOTER -->
<footer class="footer">

    <div class="footer-top">

        <a href="index.php" class="logo">
            <span class="logo-icon">R</span>
            <span>Resumate<span class="logo-gradient">AI</span></span>
        </a>

        <p>
            Your resume deserves more than just a quick look.
        </p>

        <a href="#home" class="back-top">
            Back to top ↑
        </a>

    </div>

    <div class="footer-bottom">

        <span>
            © <?= $currentYear ?>
            <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>.
            All rights reserved.
        </span>

        <span class="footer-made">
            Designed for students. Built for opportunities. ✦
        </span>

    </div>

</footer>

<script src="js/main.js"></script>

</body>
</html>
