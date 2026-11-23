alert("ATS JavaScript Loaded Successfully!");
console.log("ATS Engine Started");

document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM Loaded Successfully");
});
/* ==========================================
   RESUMATE AI - ATS ANALYSIS ENGINE
   Rule-Based Resume Analyzer
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const resumeInput = document.getElementById("resumeText");
    const jobInput = document.getElementById("jobDescription");
    const resumeForm = document.getElementById("resumeForm");

    const resultsSection = document.getElementById("resultsSection");
    const analyzeBtn = document.getElementById("analyzeBtn");
    const reanalyzeBtn = document.getElementById("reanalyzeBtn");
    const printBtn = document.getElementById("printReportBtn");

    if (!resumeInput || !jobInput || !resumeForm) {
        console.error("ATS Engine: Required form elements not found.");
        return;
    }

    // Skill dictionary with common aliases
    const skillDictionary = {
        "HTML": ["html", "html5"],
        "CSS": ["css", "css3"],
        "JavaScript": ["javascript", "js", "ecmascript"],
        "React": ["react", "react.js", "reactjs"],
        "PHP": ["php"],
        "MySQL": ["mysql"],
        "SQL": ["sql"],
        "Python": ["python"],
        "Java": ["java"],
        "C++": ["c++"],
        "C Programming": ["c programming", "language c"],
        "Node.js": ["node.js", "nodejs"],
        "Express.js": ["express.js", "expressjs"],
        "REST API": ["rest api", "restful api", "restful services"],
        "Git": ["git"],
        "GitHub": ["github"],
        "Bootstrap": ["bootstrap"],
        "Tailwind CSS": ["tailwind css", "tailwind"],
        "MongoDB": ["mongodb"],
        "Firebase": ["firebase"],
        "AWS": ["aws", "amazon web services"],
        "Docker": ["docker"],
        "Figma": ["figma"],
        "UI/UX": ["ui/ux", "user interface", "user experience"],
        "Problem Solving": ["problem solving", "problem-solving"],
        "Communication": ["communication", "communication skills"],
        "Teamwork": ["teamwork", "team work", "collaboration"],
        "Data Structures": ["data structures", "data structure"],
        "OOP": ["oop", "object oriented programming", "object-oriented programming"],
        "Machine Learning": ["machine learning", "ml"],
        "Artificial Intelligence": ["artificial intelligence", "ai"],
        "Excel": ["excel", "microsoft excel"],
        "Power BI": ["power bi"],
        "Tableau": ["tableau"],
        "Linux": ["linux"],
        "WordPress": ["wordpress"],
        "SEO": ["seo", "search engine optimization"]
    };

    // Weak phrases and stronger alternatives
    const weakPhrases = {
        "worked on": "Developed / Executed",
        "helped": "Supported / Collaborated",
        "helped with": "Contributed to / Assisted in",
        "did": "Executed / Completed",
        "made": "Designed / Created",
        "responsible for": "Managed / Led",
        "assisted with": "Supported / Contributed to",
        "participated in": "Contributed to / Collaborated on",
        "used": "Implemented / Applied",
        "involved in": "Contributed to / Executed"
    };

    // Safely find an element
    function getElement(id) {
        return document.getElementById(id);
    }

    // Check whether a phrase exists as a whole phrase
    function containsPhrase(text, phrase) {
        const escaped = phrase.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        const pattern = new RegExp(
            "(^|[^a-z0-9])" + escaped + "($|[^a-z0-9])",
            "i"
        );
        return pattern.test(text);
    }

    // Get skills mentioned in text
    function extractSkills(text) {
        const normalizedText = text.toLowerCase();
        const found = [];

        Object.entries(skillDictionary).forEach(([skill, aliases]) => {
            const matched = aliases.some(alias =>
                containsPhrase(normalizedText, alias.toLowerCase())
            );

            if (matched) {
                found.push(skill);
            }
        });

        return found;
    }

    // Find weak phrases in resume
    function detectWeakPhrases(text) {
        const normalizedText = text.toLowerCase();
        const found = [];

        Object.keys(weakPhrases).forEach(phrase => {
            if (containsPhrase(normalizedText, phrase)) {
                found.push({
                    phrase: phrase,
                    suggestion: weakPhrases[phrase]
                });
            }
        });

        return found;
    }

    // Display keyword tags
    function renderTags(containerId, items, emptyMessage) {
        const container = getElement(containerId);
        if (!container) return;

        container.innerHTML = "";

        if (items.length === 0) {
            const message = document.createElement("span");
            message.textContent = emptyMessage;
            container.appendChild(message);
            return;
        }

        items.forEach(item => {
            const tag = document.createElement("span");
            tag.textContent = item;
            container.appendChild(tag);
        });
    }

    // Show recommendations
    function renderRecommendations(items) {
        const container = getElement("recommendations");
        if (!container) return;

        container.innerHTML = "";

        items.forEach(item => {
            const li = document.createElement("li");
            li.textContent = item;
            container.appendChild(li);
        });
    }

    // Show weak phrases
    function renderWeakPhrases(items) {
        const container = getElement("weakVerbs");
        if (!container) return;

        container.innerHTML = "";

        if (items.length === 0) {
            container.textContent =
                "No common weak phrases detected. Keep your bullet points specific and measurable.";
            return;
        }

        items.forEach(item => {
            const line = document.createElement("p");
            line.textContent =
                '"' + item.phrase + '" → Try: ' + item.suggestion;
            container.appendChild(line);
        });
    }

    // Calculate ATS score
    function calculateScore(resumeSkills, jobSkills, resumeText) {
        if (jobSkills.length > 0) {
            const matched = jobSkills.filter(skill =>
                resumeSkills.includes(skill)
            );

            return Math.round(
                (matched.length / jobSkills.length) * 100
            );
        }

        // Fallback when no dictionary skills are detected in JD
        const resumeWords = new Set(
            resumeText.toLowerCase().match(/[a-z0-9+#.]+/g) || []
        );

        const jobWords = new Set(
            jobInput.value.toLowerCase().match(/[a-z0-9+#.]+/g) || []
        );

        const ignoredWords = new Set([
            "the", "and", "for", "with", "you", "your",
            "are", "our", "this", "that", "will", "have",
            "has", "from", "who", "what", "can", "should",
            "must", "about", "into", "their", "they",
            "job", "role", "work", "skills", "experience"
        ]);

        const usefulWords = [...jobWords].filter(word =>
            word.length > 2 && !ignoredWords.has(word)
        );

        if (usefulWords.length === 0) return 0;

        const matchedWords = usefulWords.filter(word =>
            resumeWords.has(word)
        );

        return Math.round(
            (matchedWords.length / usefulWords.length) * 100
        );
    }

    function getScoreMessage(score) {
        if (score >= 80) {
            return "Excellent! Your resume matches many of the job requirements.";
        }

        if (score >= 60) {
            return "Good match! Add a few missing skills to strengthen your resume.";
        }

        if (score >= 40) {
            return "Moderate match. Improve your resume with more relevant skills.";
        }

        return "Your resume needs improvement for this job description.";
    }

    function analyzeResume() {
        const resume = resumeInput.value.trim();
        const job = jobInput.value.trim();

        if (resume.length < 30) {
            alert("Please enter more resume content before analysis.");
            resumeInput.focus();
            return;
        }

        if (job.length < 20) {
            alert("Please enter a complete job description.");
            jobInput.focus();
            return;
        }

        const resumeSkills = extractSkills(resume);
        const jobSkills = extractSkills(job);

        const matchedSkills = jobSkills.filter(skill =>
            resumeSkills.includes(skill)
        );

        const missingSkills = jobSkills.filter(skill =>
            !resumeSkills.includes(skill)
        );

        const weakMatches = detectWeakPhrases(resume);
        const score = calculateScore(resumeSkills, jobSkills, resume);

        // Update ATS score
        const scoreElement = getElement("atsScore");
        if (scoreElement) {
            scoreElement.textContent = score + "%";
        }

        // Update progress bar
        const progress = getElement("scoreProgress");
        if (progress) {
            progress.style.width = score + "%";
        }

        // Update score message
        const scoreMessage = getElement("scoreMessage");
        if (scoreMessage) {
            scoreMessage.textContent = getScoreMessage(score);
        }

        // Update keyword counts
        const matchedCount = getElement("matchedCount");
        const missingCount = getElement("missingCount");

        if (matchedCount) {
            matchedCount.textContent = matchedSkills.length;
        }

        if (missingCount) {
            missingCount.textContent = missingSkills.length;
        }

        // Display matched and missing skills
        renderTags(
            "matchedKeywords",
            matchedSkills,
            "No matching skills found"
        );

        renderTags(
            "missingKeywords",
            missingSkills,
            "No missing skills detected"
        );

        // Display weak phrases
        renderWeakPhrases(weakMatches);

        // Build recommendations
        const recommendations = [];

        if (missingSkills.length > 0) {
            recommendations.push(
                "If you genuinely have these skills, add them naturally to your resume: " +
                missingSkills.join(", ") + "."
            );
        } else {
            recommendations.push(
                "Your resume includes all detected job-description skills. Keep the information accurate."
            );
        }

        if (weakMatches.length > 0) {
            recommendations.push(
                "Replace weak phrases with stronger action verbs and describe your contribution."
            );
        }

        if (!/\d+%|\d+\+|\b\d+\s*(users|customers|projects|members|hours|days)\b/i.test(resume)) {
            recommendations.push(
                "Add genuine numbers or measurable results wherever possible, such as time saved, users reached or project outcomes."
            );
        }

        if (!/education|degree|university|college|bachelor|b\.tech|bca/i.test(resume)) {
            recommendations.push(
                "Consider adding your education details if they are relevant to the application."
            );
        }

        recommendations.push(
            "Tailor your project descriptions to the responsibilities mentioned in the job description."
        );

        renderRecommendations(recommendations);

        // Show results
        if (resultsSection) {
            resultsSection.hidden = false;

            setTimeout(() => {
                resultsSection.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }, 100);
        }
    }

    // Analyze button / form submission
    
    resumeForm.addEventListener("submit", function(event) {
    event.preventDefault();

    analyzeResume();

    setTimeout(function() {
        saveAnalysisToDatabase();
    }, 100);
});

    

    // Analyze again
    if (reanalyzeBtn) {
        reanalyzeBtn.addEventListener("click", function () {
            if (resultsSection) {
                resultsSection.hidden = true;
            }

            resumeForm.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        });
    }

    // Print report
    if (printBtn) {
        printBtn.addEventListener("click", function () {
            window.print();
        });
    }

    // Optional live character counters
    function updateCounter(input, possibleIds) {
        const update = () => {
            possibleIds.forEach(id => {
                const counter = getElement(id);
                if (counter) {
                    counter.textContent = input.value.length + " characters";
                }
            });
        };

        input.addEventListener("input", update);
        update();
    }

    updateCounter(resumeInput, ["resumeCount", "resumeCharCount"]);
    updateCounter(jobInput, ["jobCount", "jobCharCount"]);

    console.log("Resumate AI ATS Engine loaded successfully.");
});



/* ==========================================
   SAVE ATS ANALYSIS TO DATABASE
========================================== */

async function saveAnalysisToDatabase() {

    const resume = document.getElementById("resumeText")?.value || "";
    const job = document.getElementById("jobDescription")?.value || "";

    const scoreText = document.getElementById("atsScore")?.textContent || "0";
    const matchedText = document.getElementById("matchedCount")?.textContent || "0";
    const missingText = document.getElementById("missingCount")?.textContent || "0";

    const score = parseInt(scoreText.replace("%", ""), 10);
    const matched = parseInt(matchedText, 10);
    const missing = parseInt(missingText, 10);

    if (!resume.trim() || !job.trim() || Number.isNaN(score)) {
        return;
    }

    try {
        const response = await fetch("save-analysis.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                score: score,
                matched: Number.isNaN(matched) ? 0 : matched,
                missing: Number.isNaN(missing) ? 0 : missing,
                resume: resume,
                job: job
            })
        });

        const result = await response.json();

        if (result.success) {
            console.log("ATS analysis saved to database.");
        } else {
            console.error(result.message);
        }

    } catch (error) {
        console.error("Analysis history error:", error);
    }
}
