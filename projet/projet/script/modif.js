$(document).ready(function() {
    $("#Recherche").keyup(function() {
        let Recherche = $(this).val();
        if (Recherche != "") {
            $.ajax({
                type: 'POST',
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


$(document).ready(function() {
    $(document).on('click', '.r', function() {
        const nom = $(this).data('Nom');
        const prenom = $(this).data('Prénom');

        $('#nom').val(nom);
        $('#prenom').val(prenom);
    });
});

