document.getElementById("btn-plus").addEventListener("click", function() {
    let additionalItems = document.querySelectorAll(".additional-items");
    let btnPlus = document.getElementById("btn-plus");

    let test=additionalItems.forEach(function(item) {
        item.classList.toggle("hidden");
    });

    if (!test) {
        btnPlus.classList.toggle("hidden");
    }
});

document.getElementById("see-offre").addEventListener("click", function() {
    window.location.href = "offre.html";
});
