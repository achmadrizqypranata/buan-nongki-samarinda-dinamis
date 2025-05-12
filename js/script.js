// Sticky Navbar on Scroll
window.addEventListener("load", handleScroll);
window.addEventListener("scroll", handleScroll);

function handleScroll() {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
}

// Loading Spinner
window.addEventListener("load", function () {
    const loader = document.getElementById("loader");
    if (loader) loader.style.display = "none";
});

// Toggle Password Visibility
document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    if (togglePassword && passwordField) {
        togglePassword.addEventListener("click", function () {
        const type =
            passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
        });
    }
});

// General Toggle Password Function
function togglePassword(fieldId, icon) {
    const field = document.getElementById(fieldId);
    if (!field || !icon) return;

    const type = field.getAttribute("type") === "password" ? "text" : "password";
    field.setAttribute("type", type);
    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
}

// Password Strength Validator
document.addEventListener("DOMContentLoaded", function () {
    const passwordField = document.getElementById("password");

    if (passwordField) {
        passwordField.addEventListener("input", function () {
        const value = passwordField.value;

        const uppercase = document.getElementById("uppercase");
        const number = document.getElementById("number");
        const symbol = document.getElementById("symbol");

        if (uppercase) {
            const isValid = /[A-Z]/.test(value);
            uppercase.style.color = isValid ? "green" : "red";
            uppercase.textContent = isValid ? "✅ 1 huruf kapital" : "❌ 1 huruf kapital";
        }

        if (number) {
            const isValid = /\d/.test(value);
            number.style.color = isValid ? "green" : "red";
            number.textContent = isValid ? "✅ 1 angka" : "❌ 1 angka";
        }

        if (symbol) {
            const isValid = /[^A-Za-z0-9]/.test(value);
            symbol.style.color = isValid ? "green" : "red";
            symbol.textContent = isValid ? "✅ 1 karakter spesial" : "❌ 1 karakter spesial";
        }
        });
    }
});

// Show review success modal (only if URL has ?review=success)
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("reviewModal");
    const closeBtn = document.getElementById("closeModal");

    if (modal && window.location.search.includes("review=success")) {
        modal.style.display = "flex";

        closeBtn.onclick = () => {
            window.location.href = 'review.php';
        };
    }
});

<script>
document.addEventListener("DOMContentLoaded", function () {
    const section = document.getElementById("sectionContent");

    function handleScrollReveal() {
        const rect = section.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            section.classList.add("visible");
        }
    }

    window.addEventListener("scroll", handleScrollReveal);
    handleScrollReveal(); // run on load
});
</script>
