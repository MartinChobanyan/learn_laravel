;(function(){
// Declaring & init
let 
    modal = $('#editorModal'), 
    formInputs = modal.find('form :input'),
    $user_id;
//--

// Open
modal.on('show.bs.modal', function (e) {
    // init
    $user_id = $(e.relatedTarget).data('id');
    //--

    // putting data into Model inputs
    formInputs.map(function() {
        this.value = $('#' + this.name).text();
    });
    //--
});
//--

// Close
modal.on('hide.bs.modal', function () {
    modal.find('.modal-body form input').removeClass('is-valid').removeClass('is-invalid');
    modal.find('.modal-body .alert').hide();
});
//--

// Save
modal.find('.modal-footer button#Save').click(function(){ 
    $.ajax({
        type: 'PUT',
        url: ('/profile/edit/' + $user_id),
        data: modal.find('form').serialize(),
        success: function(result) {
            modal.find('.modal-body .alert-danger').hide();
            formInputs.map(function(){
                if(this.value) $(this).addClass('is-valid');
            });

            modal.find('.modal-body .alert-success').html(result.success + '!').show();

            // Updating user data in profile
            formInputs.map(function() {
                $('#' + this.name).text(this.value);
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