const form = document.querySelector("form");

form.addEventListener("submit", function(event) {
  event.preventDefault(); // Stop form from reloading the page

  const name = document.getElementById("name").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;
  const emailPattern = /^[a-zA-Z0-9._%+-]+\.uom\.ac\.mu$/;
  const phone = document.getElementById("phone").value;

  //validation
  if (password !== confirmPassword) {
    alert("Passwords do not match!");
    return;
  }

  if (phone.length !== 8 || isNaN(phone)) {
    alert("Please enter a valid 8-digit phone number!");
    return;
  }

  if (!/^\d{7}$/.test(studentid)) {
  alert("Student ID must be 7 digits.");
}
if (!emailPattern.test(email)) {
  alert("Please enter a valid University of Mauritius email (e.g. name@umail.uom.ac.mu)");
  return;
}
  // If all good
  alert(`Welcome, ${name}! Your registration was successful.`);
  form.reset();
});