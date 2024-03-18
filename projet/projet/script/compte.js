document.getElementById("hamburger").addEventListener("click", function() {
    let burger = document.querySelector("#hamburger");
    let menu = document.getElementById("menu");

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    } else {
        menu.classList.remove("hidden");
        show();
    }
});

document.getElementById("croix").addEventListener("click", function() {
    let burger = document.querySelector("#hamburger");
    let menu = document.getElementById("menu");

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
        show();
    } else {
        menu.classList.remove("hidden");
    }
});

function show() {
    
}
