let width;
let height;
let trierfiltrer = document.getElementById("filtretri");
let trierfiltrermobile = document.getElementById("filtretrimobile");
let offre = document.getElementById("offre");
let contentoffre = document.getElementsByClassName("content-offre");
let limit;

function reductext(){
    limit = 200;
    for (let i = 0; i < contentoffre.length; i++) {
        let text = contentoffre[i].textContent;
        if (text.length > limit) {
          contentoffre[i].textContent = text.substring(0, limit) + "...";
        }
    }
}

function save(){
    for (let i = 0; i < contentoffre.length; i++) {
        let text = contentoffre[i].textContent;
        contentoffre[i].setAttribute('data-original', text);
    }
}

function restoretext() {
    for (let i = 0; i < contentoffre.length; i++) {
      contentoffre[i].textContent = contentoffre[i].getAttribute('data-original');
    }
  }


function resize(){
    width = window.innerWidth;
    height = window.innerHeight;
    if(width <= 700){
        reductext();
    }else{
        restoretext();
    }
    if(width < 992){
        trierfiltrer.style.display = "none";
        trierfiltrermobile.style.display = "block";
        offre.classList.remove("w-3/4");
    }
    else {
        trierfiltrermobile.style.display = "none";
        trierfiltrer.style.display = "block";
        offre.classList.add("w-3/4");
        restoretext();

    }
}



window.addEventListener('resize', function(){
    resize();
});

function init(){
    save();
    resize();
}

init();