console.log('Donate validation script loaded');
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("donation-form");

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
      case "address":
      case "pickup-address":
        if (!/[A-Za-z]/.test(value)) {
          isValid = false;
          errorMessage = "Address cannot be empty and cannot be just numbers.";
        }
        break;
      case "phone":
        if (!/^(97|98)\d{8}$/.test(value)) {
          isValid = false;
          errorMessage = "Phone number must start with 97 or 98 and be 10 digits long.";
        }
        break;
        case "email-input":  // Corrected to match the id in the HTML
        const emailPattern = /^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!value || !emailPattern.test(value)) {
            isValid = false;
            errorMessage = "Please enter a valid email address starting with a letter.";
        }
        break;
      case "clothes-type":
        if (!/^[A-Za-z\s]+$/.test(value)) {
          isValid = false;
          errorMessage = "Clothes type must contain only letters and spaces.";
        }
        break;
      case "quantity":
        if (!/^[1-9]\d*$/.test(value)) {
          isValid = false;
          errorMessage = "Quantity must be a positive number.";
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

  // Attach event listeners for real-time validation on input fields
  const fields = form.querySelectorAll("input, select");
  fields.forEach(field => {
    field.addEventListener("input", validateField);
    field.addEventListener("blur", validateField);
  });

  // Prevent form submission if validation fails
  form.addEventListener("submit", (event) => {
    let valid = true;

    fields.forEach(field => {
      validateField({ target: field });
      if (field.style.borderColor === "red") {
        valid = false;
      }
    });

    if (!valid) {
      // event.preventDefault();  // Stop form submission if validation fails
      alert("Please correct the errors before submitting.");
    }
  });
});
