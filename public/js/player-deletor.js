;(function(){
// Declaring & init
let 
    modal = $('#deletorModal'),
    $player_id,
    player;
//--

modal.on('show.bs.modal', function (e) {
    // init
    $player_id = $(e.relatedTarget).data('id');
    player = $('table tr#' + $player_id);
    //--

    // putting data into Model body
    modal.find('#question').text('Do you really want to delete player ' + player.find('td#name').text() + '?');
    //--
});

//Close
modal.on('hide.bs.modal', function () {
    modal.find('.alert').hide();
});
//--

// Delete
modal.find('.modal-footer button#Delete').click(function(){
    $.ajax({
        type: 'DELETE',
        url: ('/player/delete/' + $player_id),
        success: function(result) {
            modal.find('.modal-body .alert-success').show().text(result.success + '!');
            player.remove();

            setTimeout(function(){
                modal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            modal.find('.modal-body .alert-danger').show().text('Something had gone wrong!');
            console.error(result);                
        }
    });
}); 
//--
}());