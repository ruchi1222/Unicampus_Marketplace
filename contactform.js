// contactForm.js

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const queryInput = document.getElementById("query");

  // Create modal container dynamically
  const modal = document.createElement("div");
  modal.id = "previewModal";
  modal.style.display = "none";
  modal.innerHTML = `
    <div class="modal-overlay"></div>
    <div class="modal-content">
      <h3>Preview Your Message</h3>
      <p><strong>Name:</strong> <span id="previewName"></span></p>
      <p><strong>Email:</strong> <span id="previewEmail"></span></p>
      <p><strong>Message:</strong> <span id="previewQuery"></span></p>
      <div class="modal-buttons">
        <button id="editBtn">Edit</button>
        <button id="confirmBtn">Confirm Send</button>
      </div>
    </div>
  `;
  document.body.appendChild(modal);

  // Form submission intercepted
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!validateForm()) {
      alert("Please fill all fields correctly before proceeding.");
      return;
    }

    document.getElementById("previewName").textContent = nameInput.value;
    document.getElementById("previewEmail").textContent = emailInput.value;
    document.getElementById("previewQuery").textContent = queryInput.value;

    showModal();
  });

function validateForm() {
  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  const query = queryInput.value.trim();
  const emailPattern = /^[a-zA-Z0-9._%+-]+@umail\.uom\.ac\.mu$/i; 

  console.log("Name:", name);
  console.log("Email:", email);
  console.log("Email matches?", emailPattern.test(email));
  console.log("Query:", query);

  if (name.length < 3) {
    console.log("Name too short");
    return false;
  }
  if (!emailPattern.test(email)) {
    console.log("Invalid email");
    return false;
  }
  if (query.length < 5) {
    console.log("Query too short");
    return false;
  }
  return true;
}


  // Modal controls
  function showModal() {
    modal.style.display = "flex";
  }

  function hideModal() {
    modal.style.display = "none";
  }

  // Handle modal buttons
  modal.addEventListener("click", function (e) {
    if (e.target.id === "editBtn" || e.target.classList.contains("modal-overlay")) {
      hideModal();
    } else if (e.target.id === "confirmBtn") {
      hideModal();
      showSuccessMessage();
    }
  });

  // Success animation
  function showSuccessMessage() {
    form.style.display = "none";

    const successBox = document.createElement("div");
    successBox.classList.add("success-box");
    successBox.innerHTML = `
      <h3>✅ Message Sent Successfully!</h3>
      <p>Thank you for reaching out. We'll get back to you soon.</p>
    `;

    document.querySelector(".uni-form").appendChild(successBox);

    setTimeout(() => {
      successBox.style.opacity = 1;
    }, 200);
  }
});
