
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

$(document).on('click', '.offre-item', function() {
    let post_id = $(this).data('id');
    console.log("je début")
    $.ajax({
        url: 'json_conv.php',
        type: 'GET',
        data: { post_id: post_id},
        success: function(response ) {
            $('#candi').html(response);
        } ,
        
    });
});


$(document).on('click', '.valide', function() {
    let candi_id = $(this).data('id');
    console.log("je début")
    let answer = window.confirm("Etes vous sure de valider le Stage?");
    if (answer) {
        $.ajax({
            url: 'json_conv.php',
            type: 'GET',
            data: { candi_id: candi_id},
            success: function(response ) {
                $('#candi').html(response);
                console.log("i'm here")
            } ,
            
        });
    }
    else {
        
    }
});