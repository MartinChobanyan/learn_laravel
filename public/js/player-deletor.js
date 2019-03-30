;(function(){
// Declaring & init
let 
    dmodal = jQuery('#deletorModal'),
    $player_id,
    player;
//--

dmodal.on('show.bs.modal', function (e) {
    // init
    $player_id = $(e.relatedTarget).data('id');
    player = $('table tr#' + $player_id);
    //--

    // putting data into Model body
    dmodal.find('#question').text('Do you really want to delete player ' + player.find('td#name').text() + '?');
    //--
});

//Close
dmodal.on('hide.bs.modal', function () {
    dmodal.find('.alert').hide();
});
//--

// Delete
dmodal.find('.modal-footer button#Delete').click(function(){
    $.ajax({
        type: 'DELETE',
        url: ('/player/delete/' + $player_id),
        success: function(result) {
            dmodal.find('.modal-body .alert-success').show().text(result.success + '!');
            player.remove();

            setTimeout(function(){
                dmodal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            dmodal.find('.modal-body .alert-danger').show().text('Something had gone wrong!');
            console.error(result);                
        }
    });
}); 
//--
}());