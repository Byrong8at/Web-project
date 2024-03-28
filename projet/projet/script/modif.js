$(document).ready(function() {
    $("#Recherche").keyup(function() {
        let Recherche = $(this).val();});
        if (Recherche != "") {
            $.ajax({
                type:"Get",
                url: 'recherche.php',
                data: "recherche="+encodeURIComponent(Recherche),
                success: function(response) {
                    $("#resultat").html(response);
                }
            });}
    });