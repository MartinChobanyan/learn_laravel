// Declaring & init
let 
    emodal = $('#editorModal'), 
    formInputs = emodal.find('#editor-form :input'),
    $post_id,
    post;
//--

// Open
emodal.on('show.bs.modal', function (e) {
    // init
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
emodal.on('hide.bs.modal', function () {
    formInputs.removeClass('is-valid').removeClass('is-invalid');
    emodal.find('input[type=file]').val('');
    emodal.find('.alert').hide();
});
//--

// Save
emodal.find('.modal-footer button#Save').click(function(){ 
    $.ajax({
        type: 'POST',
        url: ('/profile/my-posts/edit/' + $post_id),
        data: new FormData(emodal.find('#editor-form')[0]),
        processData: false,
        contentType: false,
        success: function(result) {
            emodal.find('.alert-danger').hide();
            formInputs.map(function(){
                if(this.value) $(this).addClass('is-valid');
            });

            emodal.find('.alert-success').html(result.success + '!').show();

            // Updating post data in posts
            formInputs.map(function() {
                this.name == 'photo' ? $('#post-' + this.name).css('background-image', 'url(/post/image/' + $post_id + '?' + new Date().getTime() + ')') : $('#post-' + this.name).text(this.value); 
            });
        },
        error: function(result) {
            emodal.find('.alert-success').hide();
            emodal.find('.alert-danger').html(ErrorsHandler(result.responseJSON.errors)).show();                
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
    emodal.find('.alert-danger span[for="' + input.name + '"]').remove(); // removing errors of input
    if(emodal.find('.alert-danger').text() === '') emodal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert, if it's empty
    if(emodal.find('.alert-success').is(':visible')) emodal.find('.modal-body .alert-success').hide(); // Hidding Success alert, if it's visible
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