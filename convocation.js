document.querySelectorAll(".accordion-btn").forEach(button => {
  button.addEventListener("click", () => {
    const panel = button.nextElementSibling;
    
    // Toggle panel
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      document.querySelectorAll(".panel").forEach(p => p.style.display = "none");
      panel.style.display = "block";
    }
  });
});
