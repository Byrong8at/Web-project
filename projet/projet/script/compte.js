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

let Cv_see=document.getElementById('cv_affichage');
let candi_see=document.getElementById('candidatures_affichage');
let cal_see=document.getElementById('calendrier_affichage');
let fav_see=document.getElementById('Favori_affichage');
let mod_see=document.getElementById('modele_affichage');
let event_see=document.getElementById('event_affichage');
let offre_see=document.getElementById('offre_affichage');

let looker =[
    Cv_see,candi_see,cal_see,fav_see,mod_see,event_see,offre_see
];

function show(currentElement, seem) {
    elements.forEach((element, index) => {
        element.className = element === currentElement ? "bg-blue-700 bg-opacity-50 rounded-md px-10" : "";
        if (element === currentElement) {
            seem[index].classList.remove("hidden"); // Ajouter la classe
        } else {
            seem[index].classList.add("hidden"); // Supprimer la classe
        }
    });
}



elements.forEach(element => {
    element.addEventListener('click', () => {
        show(element,looker)
    });
});


