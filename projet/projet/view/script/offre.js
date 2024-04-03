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
            L[i].addEventListener("click", (event) => {
                if (event.target == filtrermobile){
                    filtrermobile.classList.toggle("on");
                    triermobile.classList.remove("on");
                    document.getElementsByClassName("allfiltri")[0].classList.toggle("hidden");
                    document.getElementsByClassName("allfiltri")[1].classList.add("hidden");
                }
                else if (event.target == triermobile){
                    triermobile.classList.toggle("on");
                    filtrermobile.classList.remove("on");
                    document.getElementsByClassName("allfiltri")[1].classList.toggle("hidden");
                    document.getElementsByClassName("allfiltri")[0].classList.add("hidden");
                }
                else{
                    document.getElementsByClassName("allfiltri")[i].classList.toggle("hidden");
                }
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

    let Lselect = [selectdate,selectoffre,selectentreprise,selectcontrat,selectdureecontrat];
    let Lbox = [bac0,bac1,bac2,bac3,bac4,bac5,remuneration,teletravail,generaliste,informatique,btp,s3e];
    let Linput = [inputville];

    for (let i = 0; i < Lselect.length; i++) {
        let selectElements = Lselect[i];
        for (let j = 0; j < selectElements.length; j++) {
            selectElements[j].addEventListener('change', (event) => {
                if (Lselect[i][0] && Lselect[i][0].value !== event.target.value){
                    Lselect[i][0].value = event.target.value;
                }
                if (Lselect[i][1] && Lselect[i][1].value !== event.target.value){
                    Lselect[i][1].value = event.target.value;
                }
            });
        }
    }

    for (let i = 0; i < Lbox.length; i++) {
        let selectElements = Lbox[i];
        for (let j = 0; j < selectElements.length; j++) {
            selectElements[j].addEventListener('click', (event) => {
                if (Lbox[i][0] && Lbox[i][0].checked !== event.target.checked){
                    Lbox[i][0].checked = event.target.checked;
                }
                if (Lbox[i][1] && Lbox[i][1].checked !== event.target.checked){
                    Lbox[i][1].checked = event.target.checked;
                }
            });
        }
    }

    for (let i = 0; i < Linput.length; i++) {
        let selectElements = Linput[i];
        for (let j = 0; j < selectElements.length; j++) {
            selectElements[j].addEventListener('input', (event) => {
                if (Linput[i][0] && Linput[i][0].value !== event.target.value){
                    Linput[i][0].value = event.target.value;
                }
                if (Linput[i][1] && Linput[i][1].value !== event.target.value){
                    Linput[i][1].value = event.target.value;
                }
            });
        }
    }
    love()

});

function love(){
    let coeur = document.getElementsByClassName("coeur");

    for (let i = 0; i < coeur.length ; i++){
        coeur[i].addEventListener('click', (event) => {
            if (event.target.classList.contains("favorite")){
                event.target.setAttribute("src", "src/coeur.png");
            }else{
                event.target.setAttribute("src", "src/coeurrempli.png");
            }
            event.target.classList.toggle("favorite");
        });
    }
}


$(document).on('click', '.fav-add', function() {
    let favID = $(this).data('id');
    $.ajax({
        url: 'fav_add.php',
        type: 'GET',
        data: { favID: favID},
        success: function( ) {
            console.log("je suis ici");
        } ,
        
    });
});