console.log('contact validation script loaded');

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contact-form");
    const nameInput = form.querySelector('#name');
    const emailInput = form.querySelector('#email');
    const messageInput = form.querySelector('#message');

    const createErrorMessage = (field, message) => {
        let errorMessage = field.parentElement.querySelector(".error-message");
        if (errorMessage) {
            errorMessage.textContent = message;
        } else {
            errorMessage = document.createElement("p");
            errorMessage.classList.add("error-message");
            errorMessage.style.color = "red";
            errorMessage.textContent = message;
            field.parentElement.appendChild(errorMessage);
        }
    };

    const validateField = (event) => {
        const field = event.target;
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = "";
        const existingError = field.parentElement.querySelector(".error-message");
        if (existingError) {
            existingError.remove();
        }

        switch (field.id) {
            case "name":
                if (!/^[A-Za-z\s]+$/.test(value)) {
                    isValid = false;
                    errorMessage = "Name must contain only letters and spaces.";
                }
                break;
            case "email":
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    isValid = false;
                    errorMessage = "Invalid email address.";
                }
                break;
            case "message":
                if (!value) {
                    isValid = false;
                    errorMessage = "Message cannot be empty.";
                }
                break;
            default:
                break;
        }

        if (!isValid) {
            createErrorMessage(field, errorMessage);
            field.style.borderColor = "red";
        } else {
            field.style.borderColor = "green";  // Indicate valid fields
        }
        return isValid;
    };

    const fields = form.querySelectorAll("input, textarea");
    fields.forEach(field => {
        field.addEventListener("input", validateField);
        field.addEventListener("blur", validateField);
    });

    form.addEventListener("submit", (event) => {
        let valid = true;
        fields.forEach(field => {
            if (!validateField({ target: field })) {
                valid = false;
            }
        });

        if (!valid) {
            event.preventDefault();  // Stop form submission if validation fails
            alert("Please correct the errors before submitting.");
        }
    });
});
