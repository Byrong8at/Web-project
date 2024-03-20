let width;
let height;
let trierfiltrer = document.getElementById("filtretri");
let trierfiltrermobile = document.getElementById("filtretrimobile");
let offre = document.getElementById("offre");
let contentoffre = document.getElementById("content-offre");

function resize(){
    width = window.innerWidth;
    height = window.innerHeight;
    console.log(width);
    console.log(height);
    if(width < 480){
        trierfiltrer.style.display = "none";
        trierfiltrermobile.style.display = "block";
        offre.classList.remove("w-3/4");
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

    }
}



window.addEventListener('resize', function(){
    resize();
});

function init(){
    resize()
}

resize();