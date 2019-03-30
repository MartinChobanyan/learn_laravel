// Declaring & init
let 
    amodal = jQuery('#contractUploadorModal'),
    $palayer_id;
//--

amodal.on('show.bs.modal', function (e) {
    // init
    $palayer_id = $(e.relatedTarget).data('id');
    //--
});

// Close
amodal.on('hide.bs.modal', function () {
    amodal.find('.alert').hide();
});
//--

// Delete
amodal.find('.modal-footer button#Upload').click(function(){
    $.ajax({
        type: 'POST',
        url: ('/player/activate/' + $palayer_id),
        data: new FormData(amodal.find('form')[0]),
        processData: false,
        contentType: false,
        success: function(result) {
            amodal.find('.modal-body .alert-success').show().text(result.success + '!');
            $('table tr#' + $palayer_id).removeAttr('style').find('td button[data-target="#contractUploadorModal"]').closest('td').remove();

            setTimeout(function(){
                amodal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            let errors = '';
            result.responseJSON.errors['contract'].forEach(error => {
                errors += error;
            });
            amodal.find('.modal-body .alert-danger').show().text(errors);             
        }
    });
}); 
//--