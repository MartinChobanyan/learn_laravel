//Declaring & init
    let 
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
    formInputs.not('input[type=file]').map(function() {
        this.value = post.find('#post-' + this.name).text();
    });
    //--
});
//--

// Close
modal.on('hide.bs.modal', function () {
    formInputs.removeClass('is-valid').removeClass('is-invalid');
    modal.find('input[type=file]').val('');
    modal.find('.alert').hide();
});
//--

// Save
modal.find('.modal-footer button#Save').click(function(){ 
    $.ajax({
        type: 'POST',
        url: ('/profile/my-posts/edit/' + $post_id),
        data: new FormData(modal.find('#editor-form')[0]),
        processData: false,
        contentType: false,
        success: function(result) {
            modal.find('.alert-danger').hide();
            formInputs.map(function(){
                if(this.value) $(this).addClass('is-valid');
            });

            modal.find('.alert-success').html(result.success + '!').show();

            // Updating post data in posts
            formInputs.map(function() {
                this.name == 'photo' ? $('#post-' + this.name).css('background-image', 'url(/post/image/' + $post_id + '?' + new Date().getTime() + ')') : $('#post-' + this.name).text(this.value); 
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
    $(this).mouseup(function(){
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