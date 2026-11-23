
<?php
session_start();
$siteName = "Resumate AI";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATS Resume Analyzer | Resumate AI</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/analyzer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<!-- Background Animation -->
<div class="bg-orb orb-1"></div>
<div class="bg-orb orb-2"></div>
<div class="bg-orb orb-3"></div>

<!-- Navbar -->
<nav class="navbar analyzer-navbar">
    <a href="index.php" class="logo">
        <span class="logo-icon">✦</span>
        Resumate <span class="purple">AI</span>
    </a>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="#analyzer">Analyzer</a>
        <a href="#how-to-use">How It Works</a>
    </div>

    <div class="nav-actions">
        <a href="index.php" class="login-btn">Back to Home</a>
    </div>
</nav>

<!-- Page Heading -->
<section class="analyzer-hero">
    <div class="announcement">
        <span class="live-dot"></span>
        AI-Powered Resume Evaluation
    </div>

    <h1>Make Your Resume <span class="gradient-text">ATS Ready.</span></h1>

    <p>
        Compare your resume with your target job description.
        Discover missing keywords, evaluate your skills and improve your resume.
    </p>
</section>

<!-- Analyzer Main Section -->
<main class="analyzer-container" id="analyzer">

    <div class="analyzer-heading">
        <div>
            <span class="section-label">RESUME ANALYSIS TOOL</span>
            <h2>Start Your Resume Analysis</h2>
            <p>Enter your resume and the job description below.</p>
        </div>

        <div class="secure-label">
            <span>✦</span> Instant Analysis
        </div>
    </div>

    <form id="resumeForm">

        <div class="analyzer-grid">

            <!-- Resume Input -->
            <div class="input-card">
                <div class="input-card-header">
                    <div class="input-icon purple-icon">📄</div>
                    <div>
                        <h3>Your Resume</h3>
                        <p>Paste your resume content here</p>
                    </div>
                </div>

                <textarea
                    id="resumeText"
                    placeholder="Paste your resume here...

Example:

Harshal Rathod
Computer Science Student

Skills:
HTML, CSS, JavaScript, PHP, MySQL

Projects:
Developed a banking management system using PHP and MySQL.
Created a responsive website using HTML, CSS and JavaScript.

Education:
Bachelor of Technology in Computer Science"
                    required
                ></textarea>

                <div class="textarea-footer">
                    <span id="resumeCount">0 characters</span>
                    <span>Resume Content</span>
                </div>
            </div>

            <!-- Job Description Input -->
            <div class="input-card">
                <div class="input-card-header">
                    <div class="input-icon blue-icon">💼</div>
                    <div>
                        <h3>Job Description</h3>
                        <p>Paste your target internship description</p>
                    </div>
                </div>

                <textarea
                    id="jobDescription"
                    placeholder="Paste the internship/job description here...

Example:

We are looking for a Web Development Intern.

Required Skills:
HTML, CSS, JavaScript, React.js, PHP and MySQL.

Responsibilities:
Develop responsive websites.
Work with REST APIs.
Build interactive user interfaces.
Collaborate with the development team.

Requirements:
Problem-solving skills and knowledge of web development."
                    required
                ></textarea>

                <div class="textarea-footer">
                    <span id="jdCount">0 characters</span>
                    <span>Job Requirements</span>
                </div>
            </div>

        </div>

        <div class="analyze-action">
            <p>✦ Your analysis will be generated instantly.</p>

            <button type="submit" class="analyze-btn" id="analyzeBtn">
                <span>Analyze My Resume</span>
                <span>→</span>
            </button>
        </div>

    </form>


<!-- BULLET POINT IMPROVER -->
<section class="bullet-improver-section" id="bulletImprover">

    <div class="bullet-heading">
        <span class="section-label">✦ RESUMATE AI WRITING ASSISTANT</span>
        <h2>Bullet Point Improver</h2>
        <p>Transform weak resume sentences into powerful professional statements.</p>
    </div>

    <div class="bullet-input-card">

        <label for="bulletInput">Enter Your Resume Bullet Points</label>

        <textarea
            id="bulletInput"
            rows="6"
            placeholder="Example:&#10;Worked on a banking management system.&#10;Helped with website development.&#10;Used PHP and MySQL."
        ></textarea>

        <p class="bullet-hint">
            ✦ Enter one or more bullet points, each on a new line.
        </p>

        <button type="button" id="improveBtn" class="improve-btn">
            <span>✦ Improve My Bullet Points</span>
            <span>→</span>
        </button>

    </div>

    <!-- IMPROVED RESULTS -->
    <div class="improved-results" id="improvedSection" hidden>

        <div class="comparison-grid">

            <div class="comparison-card original-card">
                <h3>Original Version</h3>
                <p id="originalText"></p>
            </div>

            <div class="comparison-card improved-card">
                <h3>✦ Improved Version</h3>
                <p id="improvedText"></p>
            </div>

        </div>

        <button type="button" id="copyImprovedBtn" class="copy-improved-btn">
            Copy Improved Text ↗
        </button>

    </div>

</section>


    <!-- Analysis Results -->
    <section class="results-section" id="resultsSection" hidden>

        <div class="results-heading">
            <span class="section-label">YOUR ANALYSIS REPORT</span>
            <h2>Resume Analysis Results</h2>
            <p>Here is how your resume matches the target job description.</p>
        </div>

        <!-- Score Cards -->
        <div class="results-grid">

            <div class="result-card score-result">
                <span class="result-label">ATS MATCH SCORE</span>

                <div class="result-score" id="atsScore">0%</div>

                <div class="progress-track">
                    <div class="progress-fill" id="scoreProgress"></div>
                </div>

                <p id="scoreMessage">Your resume match score</p>
            </div>

            <div class="result-card">
                <span class="result-label">MATCHED KEYWORDS</span>
                <div class="result-number matched-number" id="matchedCount">0</div>
                <p>Relevant skills found in your resume</p>
            </div>

            <div class="result-card">
                <span class="result-label">MISSING KEYWORDS</span>
                <div class="result-number missing-number" id="missingCount">0</div>
                <p>Skills you may need to highlight</p>
            </div>

        </div>

        <!-- Keyword Analysis -->
        <div class="keyword-results-grid">

            <div class="keyword-card">
                <h3>✓ Matched Keywords</h3>
                <p>Skills found in both your resume and job description.</p>
                <div class="keyword-tags" id="matchedKeywords"></div>
            </div>

            <div class="keyword-card">
                <h3>! Missing Keywords</h3>
                <p>Relevant job-description skills not found in your resume.</p>
                <div class="keyword-tags" id="missingKeywords"></div>
            </div>

        </div>

        <!-- Weak Verbs -->
        <div class="keyword-card weak-card">
            <h3>Action Verb Suggestions</h3>
            <p>Consider replacing weak words with stronger action verbs.</p>
            <div class="keyword-tags" id="weakVerbs"></div>
        </div>

        <!-- Recommendations -->
        <div class="recommendation-card">
            <h3>✦ Improvement Suggestions</h3>
            <ul id="recommendations"></ul>
        </div>

        <div class="results-actions">
            <button type="button" class="secondary-btn" id="reanalyzeBtn">
                Analyze Again
            </button>

            <button type="button" class="primary-btn" id="printReportBtn">
                Print Report →
            </button>
        </div>

        <p class="disclaimer">
            Note: This is a rule-based resume matching estimate, not a guarantee
            of selection or a score from a specific employer's ATS.
        </p>

    </section>

</main>

<!-- How it works -->
<section class="section how-section" id="how-to-use">
    <div class="section-heading">
        <span class="section-label">SIMPLE PROCESS</span>
        <h2>How It <span class="gradient-text">Works</span></h2>
        <p>Three simple steps to improve your resume.</p>
    </div>

    <div class="steps-grid container">

        <div class="step-card">
            <div class="step-number">1</div>
            <div class="step-icon">📄</div>
            <h3>Paste Your Resume</h3>
            <p>Enter your current resume content in the resume section.</p>
        </div>

        <div class="step-card">
            <div class="step-number">2</div>
            <div class="step-icon">🎯</div>
            <h3>Add Job Description</h3>
            <p>Paste the internship requirements you want to target.</p>
        </div>

        <div class="step-card">
            <div class="step-number">3</div>
            <div class="step-icon">🚀</div>
            <h3>Get Your Report</h3>
            <p>Discover keyword gaps and suggestions to improve your resume.</p>
        </div>

    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <a href="index.php" class="logo">
            <span class="logo-icon">✦</span>
            Resumate <span class="purple">AI</span>
        </a>

        <p>Build better resumes. Unlock better opportunities.</p>

        <p class="copyright">
            © <?php echo date("Y"); ?> Resumate AI. All rights reserved.
        </p>
    </div>
</footer>

<script src="js/ats-engine.js"></script>
<script src="js/bullet-improver.js"></script>

</body>
</html>
