const html = document.documentElement;
const themeBtns = {
    light: document.getElementById("theme-toggle-light"),
    dark: document.getElementById("theme-toggle-dark"),
    system: document.getElementById("theme-toggle-system"),
};

function setTheme(theme) {
    localStorage.setItem("theme", theme);

    if (theme === "light") {
        html.classList.remove("dark");
    } else if (theme === "dark") {
        html.classList.add("dark");
    } else if (theme === "system") {
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        html.classList.toggle("dark", prefersDark);
    }
    updateUI(theme);
}

function updateUI(theme) {
    Object.keys(themeBtns).forEach((key) => {
        themeBtns[key].classList.add("hidden");
    });
    themeBtns[theme].classList.remove("hidden");
}

// Initialize theme
const savedTheme = localStorage.getItem("theme") || "system";
setTheme(savedTheme);

// Add listeners
themeBtns.light.addEventListener("click", () => setTheme("dark"));
themeBtns.dark.addEventListener("click", () => setTheme("system"));
themeBtns.system.addEventListener("click", () => setTheme("light"));

// Watch system preference
window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", (e) => {
        if (localStorage.getItem("theme") === "system") {
            html.classList.toggle("dark", e.matches);
        }
    });
