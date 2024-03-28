$(document).ready(function() {
    $("#Recherche").keyup(function() {
        let Recherche = $(this).val();
        if (Recherche != "") {
            $.ajax({
                type: 'GET',
                url: '../modif.php',
                data: 'Recherche=' + encodeURIComponent(Recherche),
                success: function(data){
                    $('.Resultat').html(data);
                }
            });
        } else {
            $('.Resultat').html('');
        }
    });
});
