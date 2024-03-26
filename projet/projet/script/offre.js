document.addEventListener('DOMContentLoaded', function() {
    let niveau = document.getElementById("niveau");
    let localisation = document.getElementById("localisation");
    let domaine = document.getElementById("domaine");
    let contrat = document.getElementById("contrat");
    let date = document.getElementById("date");
    let trier = document.getElementById("trier");
    let filtrermobile = document.getElementById("filtrermobile");
    let triermobile = document.getElementById("triermobile");
    let L = [niveau, localisation, domaine, contrat, date, trier, filtrermobile, triermobile];

    for (let i = 0; i < L.length; i++) { // Il faut initialiser i à 0 et utiliser < au lieu de <=
        if (L[i]) {
            L[i].addEventListener("click", function() {
                console.log("ok");
                document.getElementsByClassName("allfiltri")[i].hidden = true; // Il faut spécifier un index pour getElementsByClassName
            }, false);
        } else {
            console.log("Erreur"); // Il faut spécifier quel élément n'a pas été trouvé
        }
    }
});