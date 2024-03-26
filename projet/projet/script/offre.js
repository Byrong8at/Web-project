document.addEventListener('DOMContentLoaded', function() {
    let niveau = document.getElementById("niveau");
    let localisation = document.getElementById("localisation");
    let domaine = document.getElementById("domaine");
    let contrat = document.getElementById("contrat");
    let date = document.getElementById("date");
    let trier = document.getElementById("trier");
    let filtrermobile = document.getElementById("filtrermobile");
    let triermobile = document.getElementById("triermobile");
    let L = [filtrermobile, triermobile, trier, niveau, localisation, domaine, contrat];

    for (let i = 0; i < L.length; i++) {
        if (L[i]) {
            L[i].addEventListener("click", function() {
                console.log("ok");
                if (document.getElementsByClassName("allfiltri")[i].hidden == true){
                    document.getElementsByClassName("allfiltri")[i].hidden = false;
                }else{
                    document.getElementsByClassName("allfiltri")[i].hidden = true;
                    
                }
                
            });
        } else {
            console.log("Erreur");
        }
    }
});