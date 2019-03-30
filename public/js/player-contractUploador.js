;(function(){
// Declaring & init
let 
    modal = jQuery('#contractUploadorModal'),
    $palayer_id;
//--

modal.on('show.bs.modal', function (e) {
    // init
    $palayer_id = $(e.relatedTarget).data('id');
    //--
});

// Close
modal.on('hide.bs.modal', function () {
    modal.find('.alert').hide();
});
//--

// Delete
modal.find('.modal-footer button#Upload').click(function(){
    $.ajax({
        type: 'POST',
        url: ('/player/activate/' + $palayer_id),
        data: new FormData(modal.find('form')[0]),
        processData: false,
        contentType: false,
        success: function(result) {
            modal.find('.modal-body .alert-success').show().text(result.success + '!');
            $('table tr#' + $palayer_id).removeAttr('style').find('td button[data-target="#contractUploadorModal"]').closest('td').remove();

            setTimeout(function(){
                modal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            let errors = '';
            result.responseJSON.errors['contract'].forEach(error => {
                errors += error;
            });
            modal.find('.modal-body .alert-danger').show().text(errors);             
        }
    });
}); 
//--
}());