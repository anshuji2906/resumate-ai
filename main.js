
/* =================================================
   RESUMATE AI - PREMIUM INTERACTION ENGINE
================================================= */

document.addEventListener("DOMContentLoaded", function () {

    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;

    // 1. MOBILE NAVIGATION

    const menuBtn = document.getElementById("menuBtn");
    const navLinks = document.getElementById("navLinks");

    if (menuBtn && navLinks) {

        menuBtn.addEventListener("click", function () {

            const isOpen = navLinks.classList.toggle("active");

            menuBtn.textContent = isOpen ? "✕" : "☰";
            menuBtn.setAttribute("aria-expanded", String(isOpen));

        });

        navLinks.querySelectorAll("a").forEach(function (link) {

            link.addEventListener("click", function () {

                navLinks.classList.remove("active");

                menuBtn.textContent = "☰";
                menuBtn.setAttribute("aria-expanded", "false");

            });

        });

        document.addEventListener("click", function (event) {

            if (
                !navLinks.contains(event.target) &&
                !menuBtn.contains(event.target)
            ) {

                navLinks.classList.remove("active");
                menuBtn.textContent = "☰";
                menuBtn.setAttribute("aria-expanded", "false");

            }

        });
    }


    // 2. SCROLL REVEAL ANIMATION

    const revealElements = document.querySelectorAll(
        ".reveal"
    );

    if (reduceMotion || !("IntersectionObserver" in window)) {

        revealElements.forEach(function (element) {
            element.classList.add("visible");
        });

    } else {

        const observer = new IntersectionObserver(
            function (entries, currentObserver) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add("visible");

                        currentObserver.unobserve(entry.target);

                    }

                });

            },
            {
                threshold: 0.12,
                rootMargin: "0px 0px -35px 0px"
            }
        );

        revealElements.forEach(function (element) {
            observer.observe(element);
        });

    }


    // 3. MOUSE FOLLOWING GLASS GLOW

    const glassCards = document.querySelectorAll(
        ".feature-card, .step-card"
    );

    if (window.matchMedia("(hover: hover)").matches) {

        glassCards.forEach(function (card) {

            card.addEventListener("pointermove", function (event) {

                const rect = card.getBoundingClientRect();

                const mouseX = event.clientX - rect.left;
                const mouseY = event.clientY - rect.top;

                card.style.setProperty(
                    "--mouse-x",
                    mouseX + "px"
                );

                card.style.setProperty(
                    "--mouse-y",
                    mouseY + "px"
                );

            });

        });

    }


    // 4. NAVBAR SCROLL EFFECT

    const navbar = document.getElementById("navbar");

    function updateNavbar() {

        if (!navbar) return;

        if (window.scrollY > 35) {

            navbar.style.background = "rgba(16,8,23,0.92)";

            navbar.style.boxShadow =
                "0 8px 35px rgba(0,0,0,0.30)";

        } else {

            navbar.style.background = "rgba(16,8,23,0.62)";

            navbar.style.boxShadow = "none";

        }

    }

    window.addEventListener(
        "scroll",
        updateNavbar,
        { passive: true }
    );

    updateNavbar();


    // 5. SMOOTH INTERNAL NAVIGATION

    document.querySelectorAll('a[href^="#"]').forEach(function (link) {

        link.addEventListener("click", function (event) {

            const targetId = link.getAttribute("href");

            if (!targetId || targetId === "#") return;

            const target = document.querySelector(targetId);

            if (target) {

                event.preventDefault();

                target.scrollIntoView({
                    behavior: reduceMotion ? "auto" : "smooth",
                    block: "start"
                });

            }

        });

    });


    // 6. BUTTON PRESS EFFECT

    const buttons = document.querySelectorAll(
        ".primary-btn, .nav-cta, .secondary-btn"
    );

    buttons.forEach(function (button) {

        button.addEventListener("pointerdown", function () {

            button.style.transform = "scale(0.97)";

        });

        function resetButton() {

            button.style.transform = "";

        }

        button.addEventListener("pointerup", resetButton);
        button.addEventListener("pointerleave", resetButton);
        button.addEventListener("pointercancel", resetButton);

    });


    // 7. AMBIENT ORB PARALLAX EFFECT

    const orbs = document.querySelectorAll(".ambient-orb");

    if (!reduceMotion && window.matchMedia("(hover: hover)").matches) {

        let mouseX = 0;
        let mouseY = 0;

        window.addEventListener("pointermove", function (event) {

            mouseX = (event.clientX / window.innerWidth - 0.5);
            mouseY = (event.clientY / window.innerHeight - 0.5);

        }, { passive: true });

        let ticking = false;

        function moveOrbs() {

            orbs.forEach(function (orb, index) {

                const factor = (index + 1) * 12;

                orb.style.setProperty(
                    "--parallax-x",
                    mouseX * factor + "px"
                );

                orb.style.setProperty(
                    "--parallax-y",
                    mouseY * factor + "px"
                );

            });

            ticking = false;

        }

        window.addEventListener("pointermove", function () {

            if (!ticking) {

                window.requestAnimationFrame(moveOrbs);
                ticking = true;

            }

        }, { passive: true });

    }


    // 8. PAGE READY

    document.body.classList.add("page-ready");

    console.log(
        "%c RESUMATE AI ",
        "background: linear-gradient(90deg,#A855F7,#EC4899); color:white; padding:8px 15px; border-radius:5px; font-weight:bold;"
    );

    console.log("Aurora Glass UI initialized successfully.");

});
