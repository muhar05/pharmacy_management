document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const html = document.documentElement;

    // Periksa apakah ada preferensi di localStorage
    const darkMode = localStorage.getItem("darkMode");
    if (darkMode === "enabled") {
        html.classList.add("dark");
    }

    // Fungsi untuk toggle dark mode
    themeToggle.addEventListener("click", function () {
        if (html.classList.contains("dark")) {
            html.classList.remove("dark");
            localStorage.setItem("darkMode", "disabled");
        } else {
            html.classList.add("dark");
            localStorage.setItem("darkMode", "enabled");
        }
    });
});
