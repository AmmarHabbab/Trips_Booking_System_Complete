const hamborgar = document.querySelector("#toggle-btn");
hamborgar.addEventListener("click", function() {
  document.querySelector("#sidebar").classList.toggle("expand");
});