;(function(){
// Declaring & init
let 
    modal = $('#editorModal'),
    formInputs = modal.find('form :input'),
    $player_id,
    player;
//--

modal.on('show.bs.modal', function (e) {
    // init
    $player_id = $(e.relatedTarget).data('id');
    player = $('table tr#' + $player_id);
    //--

    // putting data into Model inputs
    formInputs.map(function() {
        if(this.name === 'role_id'){
            $(this).val($(this).find('option:contains("' + player.find('td#role').text() + '")').val());
        }else this.value = this.name === 'salary' ? parseInt(player.find('td#' + this.name).text()) : player.find('td#' + this.name).text();
    });
    //--
});

modal.on('hide.bs.modal', function () {
    modal.find('.modal-body form input').removeClass('is-valid').removeClass('is-invalid');
    modal.find('.modal-body .alert').hide();
});

// Save
modal.find('.modal-footer button#Save').click(function(){ 
    $.ajax({
        type: 'PUT',
        url: ('/player/edit/' + $player_id),
        data: modal.find('form').serialize(),
        success: function(result) {
            modal.find('.alert-danger').hide();
            formInputs.map(function(){
                if(this.value) $(this).addClass('is-valid');
            });

            modal.find('.modal-body .alert-success').html(result.success + '!').show();

            // Updating player data == ===sd-=in team's players table
            formInputs.map(function() {
                if(this.name === 'role_id'){
                    player.find('td#role').text($(this).find('option[value=' + this.value + ']').text());
                }else player.find('td#' + this.name).text(this.value + (this.name === 'salary' ? '.00$' : ''));
            });
        },
        error: function(result) {
            modal.find('.modal-body .alert-success').hide();

            modal.find('.modal-body .alert-danger').html(ErrorsHandler(result.responseJSON.errors)).show();                
        }
    });
});
//--

// Modal inputs logic
formInputs.map(function() {
    $(this).mouseup(function(){
        InputsLogicOnMouseup(this);
    });
});
//--

// Functions
function InputsLogicOnMouseup(input){
    formInputs.removeClass('is-valid'); // Putting valid inputs indicators(If there are exist) to their initial state
    $(input).removeClass('is-invalid'); // Putting input indicator to its initial state
    modal.find('.alert-danger span[for="' + input.name + '"]').remove(); // removing errors of input
    if(modal.find('.alert-danger').text() === '') modal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert, if it's empty
    if(modal.find('.alert-success').is(':visible')) modal.find('.modal-body .alert-success').hide(); // Hidding Success alert, if it's visible
}

function ErrorsHandler(errors){
    let errors_msg = '';
    formInputs.map((_index, input) => {
        if(errors[input.name]){
            $(input).addClass('is-invalid');
            errors[input.name].forEach(function(error) { errors_msg += '<span for="' + input.name + '">' + '* ' + error + '<br></span>'; });
        } else {
            $(input).addClass('is-valid');
        }
    });
    return errors_msg;
}
//--
}());