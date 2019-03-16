let modal, formInputs;

$('#editorModal').on('show.bs.modal', function (e) {
    //init
    modal = $(this);
    formInputs = $('#editor-form :input'); // modal form inputs

    // putting data into Model inputs
    formInputs.map(function() {
        this.value = $('#' + this.name).text();
    });
    //--
    
    // Save
    modal.find('.modal-footer button#Save').click(function(){ 
        $.ajax({
            type: 'PUT',
            url: ('/profile/edit/' + $(e.relatedTarget).data('id')),
            data: $('#editor-form').serialize(),
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
    
    // Inputs
    formInputs.map(function() {
        $(this).keydown(function(){
            InputsLogicOnKeydown(this);
        });
    });
    //--

    // Functions
    function InputsLogicOnKeydown(input){
        modal.find('.modal-body form input').removeClass('is-valid'); // Putting valid inputs indicators(If there are exist) to their initial state
        $(input).removeClass('is-valid').removeClass('is-invalid'); // Putting input indicator to its initial state
        modal.find('.modal-body .alert-danger span[for="' + input.name + '"]').remove(); // removing errors of input
        if(modal.find('.modal-body .alert-danger').text() === '') modal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert, if it's empty
        if(modal.find('.modal-body .alert-success').is(':visible')) modal.find('.modal-body .alert-success').hide(); // Hidding Success alert, if it's visible
    }

    function ErrorsHandler(errors){
        let errors_msg = '';
        formInputs.map(function() {
            if(errors[this.name]){
                $(this).addClass('is-invalid');
                errors[this.name].forEach(function(error) { errors_msg += '<span for="' + this.name + '">' + '* ' + error + '<br></span>'; });
            } else {
                $(this).addClass('is-valid');
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