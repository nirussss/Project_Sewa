console.log('Request validation script loaded');

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form");

    const createErrorMessage = (field, message) => {
        let errorMessage = field.parentElement.querySelector(".error-message");

        if (errorMessage) {
            errorMessage.textContent = message;
        } else {
            errorMessage = document.createElement("p");
            errorMessage.classList.add("error-message");
            errorMessage.style.color = "red";
            errorMessage.textContent = message;
            field.parentElement.appendChild(errorMessage); // Append the error message below the field
        }
    };

    const validateField = (event) => {
        const field = event.target;
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = "";

        // Remove any existing error messages when typing
        const existingError = field.parentElement.querySelector(".error-message");
        if (existingError) {
            existingError.remove();
        }

        switch (field.id) {
            case "firstname-input":
                const namePattern = /^[A-Za-z\s]+$/;
                if (!value || !namePattern.test(value)) {
                    isValid = false;
                    errorMessage = "Name must only contain letters and spaces (no numbers).";
                }
                break;

            case "email-input":
                const emailPattern = /^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!value || !emailPattern.test(value)) {
                    isValid = false;
                    errorMessage = "Please enter a valid email address starting with a letter.";
                }
                break;

            case "password-input":
                const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!value || !passwordPattern.test(value)) {
                    isValid = false;
                    errorMessage = "Password must be at least 8 characters long, contain at least one letter, one number, and one special character.";
                }
                break;

            case "confirm-password-input":
                const passwordField = document.getElementById("password-input");
                if (!value || value !== passwordField.value) {
                    isValid = false;
                    errorMessage = "Passwords do not match.";
                }
                break;

            default:
                break;
        }

        if (!isValid) {
            createErrorMessage(field, errorMessage);
            field.style.borderColor = "red"; // Change border to red for invalid fields
        } else {
            field.style.borderColor = ""; // Reset border color when valid
        }

        return isValid;
    };

    // Attach real-time validation to each input field
    const fields = form.querySelectorAll("input");
    fields.forEach(field => {
        field.addEventListener("input", validateField); // Validate on every input change
        field.addEventListener("blur", validateField);   // Validate when the field loses focus
    });

    form.addEventListener("submit", (event) => {
        let valid = true;

        // Check each field again before submission
        fields.forEach(field => {
            if (!validateField({ target: field })) {
                valid = false;
            }
        });

        if (!valid) {
            // Prevent form submission if validation fails
            event.preventDefault();
            alert("Please correct the errors before submitting the form.");
        }
    });
});
