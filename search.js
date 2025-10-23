const items = [
  { name: "Happy After All", link: "Books.html" },
  { name: "National Geographic", link: "Books.html" },
  { name: "Reader's Digest", link: "Books.html" },
  { name: "Vogue", link: "Books.html" },
  { name: "Pride And Prejudice", link: "Books.html" },
  { name: "Les Adventures De Tintin", link: "Books.html" },
  { name: "Introduction To Algorithms", link: "Books.html" },
  { name: "Ensemble, C'est Tout", link: "Books.html" },
  { name: "Blue Pen", link: "Stationaries.html" },
  { name: "Black Pen", link: "Stationaries.html" },
  { name: "Ruler", link: "Stationaries.html" },
  { name: "Pencil", link: "Stationaries.html" },
  { name: "Scissor", link: "Stationaries.html" },
  { name: "Glue", link: "Stationaries.html" },
  { name: "Copybook", link: "Stationaries.html" },
  { name: "Eraser", link: "Stationaries.html" },
  { name: "Headphone", link: "Technologia.html" },
  { name: "Mouse", link: "Technologia.html" },
  { name: "Earphone", link: "Technologia.html" },
  { name: "USB Drives", link: "Technologia.html" },
  { name: "Laptop Bag", link: "Technologia.html" },
  { name: "Scissor", link: "Technologia.html" },
  { name: "LED Desk Lamp", link: "Technologia.html" },
  { name: "Powerbank", link: "Technologia.html" },
  { name: "Portable Fans", link: "Technologia.html" }
];

const input = document.getElementById("search");
const resultsBox = document.getElementById("results");

input.addEventListener("keyup", () => {
  const query = input.value.toLowerCase();
  resultsBox.innerHTML = "";

  if (query === "") {
    resultsBox.style.display = "none";
    return;
  }

  const filtered = items.filter(item =>
    item.name.toLowerCase().includes(query)
  );

  if (filtered.length === 0) {
    resultsBox.innerHTML = "<p style='padding:10px;'>No results found</p>";
  } else {
    filtered.forEach(item => {
      const a = document.createElement("a");
      a.textContent = item.name;
      a.href = item.link; // unique page per item
      a.classList.add("result-item");
      resultsBox.appendChild(a);
    });
  }

  resultsBox.style.display = "block";
});

// Hide dropdown when clicking outside
document.addEventListener("click", (e) => {
  if (!e.target.closest(".search-box")) {
    resultsBox.style.display = "none";
  }
});
