$('#deletorModal').on('show.bs.modal', function (e) {
    //init
    var $player_id = $(e.relatedTarget).data('id');

    var player = $('table tr#' + $player_id);
    var nick = player.find('td#nick').text();

    var modal = $(this);
    modal.find('#question').text('Do you really want to delete player ' + nick + '?');

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
});