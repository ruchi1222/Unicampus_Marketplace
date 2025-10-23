// Get the cart from localStorage or start a new one
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Add item to cart
function addToCart(name, price) {
  const item = cart.find(p => p.name === name);
  if (item) {
    item.quantity++;
    item.total = item.price * item.quantity;
  } else {
    cart.push({ name, price, quantity: 1, total: price });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  alert(`${name} added to cart!`);
}

// Display cart items (runs on cart.html)
function displayCart() {
  const cartTable = document.querySelector("#cartTable tbody");
  const totalPrice = document.getElementById("totalPrice");

  if (!cartTable || !totalPrice) return;

  cartTable.innerHTML = "";
  let grandTotal = 0;

  cart.forEach((item, index) => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${item.name}</td>
      <td>${item.price}</td>
      <td>${item.quantity}</td>
      <td>${item.total}</td>
      <td><button class="remove-btn" onclick="removeFromCart(${index})">Remove</button></td>
    `;
    cartTable.appendChild(row);
    grandTotal += item.total;
  });

  totalPrice.textContent = "Total: Rs " + grandTotal;
}

function removeFromCart(index) {
  cart.splice(index, 1); 
  localStorage.setItem("cart", JSON.stringify(cart)); // Update localStorage
  displayCart(); // Refresh table
}

// Clear entire cart
function clearCart() {
  localStorage.removeItem("cart");
  cart = [];
  displayCart();
}
