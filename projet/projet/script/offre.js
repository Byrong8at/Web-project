document.addEventListener('DOMContentLoaded', function() {
    let niveau = document.getElementById("niveau");
    let localisation = document.getElementById("localisation");
    let domaine = document.getElementById("domaine");
    let contrat = document.getElementById("contrat");
    let trier = document.getElementById("trier");
    let filtrermobile = document.getElementById("filtrermobile");
    let triermobile = document.getElementById("triermobile");
    let L = [filtrermobile, triermobile, trier, niveau, localisation, domaine, contrat];

    for (let i = 0; i < L.length; i++) {
        if (L[i]) {
            L[i].addEventListener("click", function() {
                console.log("ok");
                document.getElementsByClassName("allfiltri")[i].classList.toggle("hidden");
            });
        } else {
            console.log("Erreur");
        }
    }

    let selectdate = document.getElementsByClassName("selectdate");
    let selectoffre = document.getElementsByClassName("selectoffre");
    let selectentreprise = document.getElementsByClassName("selectentreprise");
    let selectcontrat = document.getElementsByClassName("selectcontrat");
    let selectdureecontrat = document.getElementsByClassName("selectdureecontrat");
    let bac0 = document.getElementsByClassName("bac0");
    let bac1 = document.getElementsByClassName("bac1");
    let bac2 = document.getElementsByClassName("bac2");
    let bac3 = document.getElementsByClassName("bac3");
    let bac4 = document.getElementsByClassName("bac4");
    let bac5 = document.getElementsByClassName("bac5");
    let inputville = document.getElementsByClassName("inputville");
    let remuneration = document.getElementsByClassName("remuneration");
    let teletravail = document.getElementsByClassName("teletravail");
    let generaliste = document.getElementsByClassName("generaliste");
    let informatique = document.getElementsByClassName("informatique");
    let btp = document.getElementsByClassName("btp");
    let s3e = document.getElementsByClassName("selectdureecontrat");

    Lselect = [selectdate,selectoffre,selectentreprise,selectcontrat,selectdureecontrat];
    Lbox = [bac0,bac1,bac2,bac3,bac4,bac5,remuneration,teletravail,generaliste,informatique,btp,s3e];

    for(let i = 0; i < Lselect.length; i++){
        L[i].addEventListener('change', (event) => {
            select2.value = event.target.value;
          });
    }
    selectdate.addEventListener('change', (event) => {
        select2.value = event.target.value;
      });

    input1.addEventListener('input', (event) => {
        input2.value = event.target.value;
      });
});