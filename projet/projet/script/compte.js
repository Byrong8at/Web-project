document.getElementById("hamburger").addEventListener("click", function() {
    let burger = document.querySelector("#hamburger");
    let menu = document.getElementById("menu");

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    } else {
        menu.classList.remove("hidden");
    }
});

document.getElementById("croix").addEventListener("click", function() {
    let burger = document.querySelector("#hamburger");
    let menu = document.getElementById("menu");

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    } else {
        menu.classList.remove("hidden");
    }
});