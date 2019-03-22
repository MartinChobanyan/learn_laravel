//Declaring & init
    var 
    modal = $('#editorModal'), 
    formInputs = modal.find('#editor-form :input'),
    $post_id,
    post;
//--

// Open
modal.on('show.bs.modal', function (e) {
    //init
    $post_id = $(e.relatedTarget).data('id');
    post = $('div#' + $post_id);
    //--

    // putting data into Model inputs
    formInputs.map(function() {
        this.value = post.find('#post-' + this.name).text();
    });
    //--
});
//--

// // Close
$('#editorModal').on('hide.bs.modal', function () {
    formInputs.removeClass('is-valid').removeClass('is-invalid');
    modal.find('.alert').hide();
});
// //--

// Save
modal.find('.modal-footer button#Save').click(function(){ 
    $.ajax({
        type: 'PUT',
        url: ('/profile/my-posts/edit/' + $post_id),
        data: $('#editor-form').serialize(),
        success: function(result) {
            modal.find('.alert-danger').hide();
            formInputs.map(function(){
                if(this.value) $(this).addClass('is-valid');
            });

            modal.find('.alert-success').html(result.success + '!').show();

            // Updating post data in posts
            formInputs.map(function() {
                $('#post-' + this.name).text(this.value);
                this.name == 'photo' ? $('img').attr('src', this.value) : null; 
            });
        },
        error: function(result) {
            modal.find('.alert-success').hide();
            modal.find('.alert-danger').html(ErrorsHandler(result.responseJSON.errors)).show();                
        }
    });
});
//--


// Modal inputs logic
formInputs.map(function() {
    $(this).keydown(function(){
        InputsLogicOnKeydown(this);
    });
});
//--

// Functions
function InputsLogicOnKeydown(input){
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