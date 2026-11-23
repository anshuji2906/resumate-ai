
/* ==========================================
   RESUMATE AI - BULLET POINT IMPROVER
========================================== */

document.addEventListener("DOMContentLoaded", function () {

    const improveBtn = document.getElementById("improveBtn");
    const bulletInput = document.getElementById("bulletInput");
    const improvedSection = document.getElementById("improvedSection");
    const originalText = document.getElementById("originalText");
    const improvedText = document.getElementById("improvedText");
    const copyImprovedBtn = document.getElementById("copyImprovedBtn");

    if (!improveBtn || !bulletInput) {
        console.log("Bullet Improver: HTML elements not added yet.");
        return;
    }

    const replacements = {
        "worked on": "Developed",
        "helped": "Supported",
        "helped with": "Contributed to",
        "made": "Created",
        "did": "Executed",
        "used": "Implemented",
        "responsible for": "Managed",
        "participated in": "Collaborated on",
        "assisted with": "Supported",
        "involved in": "Contributed to"
    };

    function improveBullet(text) {
        let result = text.trim();

        Object.keys(replacements).forEach(function (phrase) {
            const regex = new RegExp("\\b" + phrase + "\\b", "gi");
            result = result.replace(regex, replacements[phrase]);
        });

        if (result && !/[.!?]$/.test(result)) {
            result += ".";
        }

        return result;
    }

    improveBtn.addEventListener("click", function () {

        const text = bulletInput.value.trim();

        if (!text) {
            alert("Please enter a resume bullet point first.");
            bulletInput.focus();
            return;
        }

        const improved = text
            .split(/\n+/)
            .filter(line => line.trim() !== "")
            .map(improveBullet)
            .join("\n");

        if (originalText) originalText.textContent = text;
        if (improvedText) improvedText.textContent = improved;

        if (improvedSection) {
            improvedSection.hidden = false;
            improvedSection.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }

        console.log("Bullet points improved successfully.");
    });

    if (copyImprovedBtn) {
        copyImprovedBtn.addEventListener("click", async function () {
            const text = improvedText?.textContent || "";

            try {
                await navigator.clipboard.writeText(text);
                alert("Improved bullet points copied!");
            } catch (error) {
                alert("Copy failed. Please select and copy the text manually.");
            }
        });
    }

    console.log("Resumate AI Bullet Improver loaded successfully.");
});
