const input = document.getElementById("search");
const resultsBox = document.getElementById("results");

input.addEventListener("keyup", () => {
  const query = input.value.trim();
  resultsBox.innerHTML = "";

  if (query === "") {
    resultsBox.style.display = "none";
    return;
  }

  fetch(`search_api.php?q=${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(data => {
      resultsBox.innerHTML = "";
      if (data.length === 0) {
        resultsBox.innerHTML = "<p style='padding:10px;'>No results found</p>";
      } else {
        data.forEach(item => {
          const a = document.createElement("a");
          a.textContent = item.name;
          a.href = item.link;
          a.classList.add("result-item");
          resultsBox.appendChild(a);
        });
      }
      resultsBox.style.display = "block";
    })
    .catch(err => {
      console.error("Search fetch failed:", err);
    });
});

document.addEventListener("click", (e) => {
  if (!e.target.closest(".search-box")) {
    resultsBox.style.display = "none";
  }
});