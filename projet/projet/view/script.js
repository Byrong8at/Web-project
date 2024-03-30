function searchData(value) {
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { search: value },
        success: function(response) {
            $('#result').html(response);
        }
    });
}

$(document).on('click', '.user-item', function() {
    let userId = $(this).data('id');

    $.ajax({
        url: 'get_user.php',
        type: 'GET',
        data: { userId: userId },
        dataType: 'json', 
        success: function(userDetails) {
            $id_user.val(userDetails.ID_user)
            $('#statut').val(userDetails.Statut);
            $('#nom').val(userDetails.Nom);
            $('#prenom').val(userDetails.Prénom);
            $('#Centre').val(userDetails.Centre);
            $('#Login').val(userDetails.Login);
            $('#password').val(userDetails.Mot_de_passe);
        },
        
    });
});