function searchData(value) {
    const searchType = $('#search').data('searchtype');
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { search: value,type: searchType },
        success: function(response) {
            $('#result').html(response);
        }
    });
}

$(document).on('click', '.user-item', function() {
    let userId = $(this).data('id');
    $.ajax({
        url: 'json_conv.php',
        type: 'GET',
        data: { userId: userId},
        dataType: 'json', 
        success: function(entDetails ) {
            $('#id_user').val(entDetails.ID_user);
            $('#statut').val(entDetails.Statut);
            $('#nom').val(entDetails.Nom);
            $('#prenom').val(entDetails.Prénom);
            $('#Centre').val(entDetails.Centre);
            $('#Login').val(entDetails.Login);
            $('#password').val(entDetails.Mot_de_passe);
            $('#promo').val(entDetails.Id_Promo);
        } ,
        
    });
});

$(document).on('click', '.ent-item', function() {
    let entId = $(this).data('id');
    $.ajax({
        url: 'json_conv.php',
        type: 'GET',
        data: { entId: entId },
        dataType: 'json', 
        success: function(entDetails) {
            console.log("Je suis arrivé ici")
            $('#id_user').val(entDetails.ID_entreprise);
            $('#img').attr("src", entDetails.logo);
            $('#nom').val(entDetails.Nom);
            $('#secteur').val(entDetails.secteur_d_activité);
            $('#adr_1').val(entDetails.Adresse);
            $('#adr_2').val(entDetails.Adresse_2);
            $('#adr_3').val(entDetails.Adresse_3);
            if (entDetails.Voir === 1) {
                $('#visible').prop('checked', true);
            } else {
                $('#visible').prop('checked', false);
            }
        } ,
        
    });
});