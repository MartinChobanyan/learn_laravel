var modal, button, $player_id, player, name, nick, input_name, input_nick;

$('#editorModal').on('show.bs.modal', function (e) {
    //init
    button = $(e.relatedTarget);
    $player_id = button.data('id');

    player = $('table tr#' + $player_id);
    name = player.find('td#name').text();
    nick = player.find('td#nick').text();

    modal = $(this);
    input_name = modal.find('.modal-body form input#player-name');
    input_nick = modal.find('.modal-body form input#player-nick');

    // putting data into Model inputs
    input_name.val(name); 
    input_nick.val(nick);
    //--
    
    // Save
    modal.find('.modal-footer button#Save').click(function(){ 
        name = input_name.val();
        nick = input_nick.val();
        $.ajax({
            type: 'PUT',
            url: ('/player/edit/' + $player_id),
            data: {
                'name': name,
                'nick': nick
            },
            success: function(result) {
                modal.find('.modal-body .alert-danger').hide();

                input_name.addClass('is-valid');
                input_nick.addClass('is-valid');
                modal.find('.modal-body .alert-success').html(result.success + '!').show();

                // Updating player data in team's players table
                player = $('table tr#' + $player_id);
                player.find('td#name').text(name);
                player.find('td#nick').text(nick);
            },
            error: function(result) {
                modal.find('.modal-body .alert-success').hide();

                modal.find('.modal-body .alert-danger').html(ErrorsHandler(result.responseJSON.errors, ['name', 'nick'])).show();                
            }
        });
    });
    //--
    
    // Inputs
    input_name.keypress(function(){
        InputsLogicOnKeypress('name');
    });

    input_nick.keypress(function(){
        InputsLogicOnKeypress('nick');
    });
    //--

    // Functions
    function InputsLogicOnKeypress(type){
        modal.find('.modal-body form input').removeClass('is-valid'); // Putting valid inputs indicators(If there are exist) to their initial state
        eval('input_' + type).removeClass('is-valid').removeClass('is-invalid'); // Putting input indicator to its initial state
        modal.find('.modal-body .alert-danger span[for="' + type + '"]').remove(); // removing errors of input
        if(modal.find('.modal-body .alert-danger').text() === '') modal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert, if it's empty
        if(modal.find('.modal-body .alert-success').is(':visible')) modal.find('.modal-body .alert-success').hide(); // Hidding Success alert, if it's visible
    }

    function ErrorsHandler(errors, types){
        var errors_msg = '';
        types.forEach(function(type){
            var errors_type = eval('errors.' + type); // errors.(type) -> Errors of type ...
            if(errors_type){
                eval('input_' + type).addClass('is-invalid');
                errors_type.forEach(function(error) { errors_msg += '<span for="' + type + '">' + '* ' + error + '<br></span>'; });
            } else {
                eval('input_' + type).addClass('is-valid');
            }
        });
        return errors_msg;
    }
    //--
});

$('#editorModal').on('hide.bs.modal', function () {
    modal.find('.modal-body form input').removeClass('is-valid').removeClass('is-invalid');
    modal.find('.modal-body .alert').hide();
});