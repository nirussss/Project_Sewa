document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");
    const emailInput = document.getElementById("email-input");
    const passwordInput = document.getElementById("password-input");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", (event) => {
        // Prevent form submission
        event.preventDefault();
        errorMessage.textContent = "";
        errorMessage.style.color = "red";

        // Email validation
        const email = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email === "" || !emailPattern.test(email)) {
            errorMessage.textContent = "Please enter a valid email address.";
            return false;
        }

        // Password validation
        const password = passwordInput.value;
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordPattern.test(password)) {
            errorMessage.textContent =
                "Password must be at least 8 characters long, and include at least one letter, one number, and one special character.";
            return false;
        }

        // If both validations pass
        // errorMessage.style.color = "green";
        // errorMessage.textContent = "Login successful!";
        form.reset();
    });
});
