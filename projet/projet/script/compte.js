let burger = document.querySelector("#hamburger");
let menu = document.getElementById("menu");

document.getElementById("hamburger").addEventListener("click", function() {

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    } else {
        menu.classList.remove("hidden");
        show();
    }
});

document.getElementById("croix").addEventListener("click", function() {
    

    burger.classList.toggle("hidden");

    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
        show();
    } else {
        menu.classList.remove("hidden");
    }
});

let CV = document.getElementById("cv");
let candidature = document.getElementById("candidatures");
let calendrier = document.getElementById("Calendrier");
let favori = document.getElementById("favori");
let modele = document.getElementById("modele");
let events = document.getElementById("Evenement");
let offre = document.getElementById("offre");

let elements = [
    CV,candidature,calendrier,favori,modele,events,offre
];

function resetElements(currentElement) {
    elements.forEach(element => {
        element.className = element === currentElement ? "bg-blue-700 bg-opacity-50 rounded-md px-10" : "";
    });
}

//fonction pour afficher au millieu
function show(currentElement) {
    elements.forEach(element => {
        element.className = element !== currentElement ? "hidden" : "";
    });
}


elements.forEach(element => {
    element.addEventListener('click', () => {
        resetElements(element);
    });
});


