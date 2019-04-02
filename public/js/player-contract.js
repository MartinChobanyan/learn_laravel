;(function(){
// Declaring & init
let 
    modal = jQuery('#contractModal'),
    modal_body = modal.find('.modal-body #additional'),
    modal_footer = modal.find('.modal-footer'),
    $palayer_id;
//--

modal.on('show.bs.modal', function (e) {
    // init
    $palayer_id = $(e.relatedTarget).data('id');
    //--
    $(e.relatedTarget).text() === 'Show' ? designShow() : designUpload();
});

// Show
function designShow(){
    modal_body.show().html('<div class="row justify-content-around"><button type="button" class="col-3-sm btn btn-primary" id="s">Show Contract</button><button type="button" class="col-3-sm btn btn-primary" id="u">Upload Contract</button><button type="button" class="col-3-sm btn btn-primary" id="d">Delete Contract</button></div>');
    modal_footer.hide().html('');

    modal_body.find('button#s').click(function(){
        window.open(('/player/contracts/' + $palayer_id), '_blank');
    });
    modal_body.find('button#u').click(function(){
        designUpload();
    });
    modal_body.find('button#d').click(function(){
        designDelete();
    });
}
//--

// Upload
function designUpload(){
    modal_body.show().html('<form enctype="multipart/form-data"><input type="file" name="contract"></form>');
    modal_footer.show().html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="Upload">Upload</button>');

    modal_footer.find('button#Upload').click(function(){
        $.ajax({
            type: 'POST',
            url: ('/player/contracts/upload/' + $palayer_id),
            data: new FormData(modal.find('form')[0]),
            processData: false,
            contentType: false,
            success: function(result) {
                modal.find('.modal-body .alert-success').show().text(result.success + '!');
                $('table tr#' + $palayer_id).removeAttr('style').find('td button[data-target="#contractModal"]').text('Show');

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
}
//--

// Delete
function designDelete(){
    modal_body.show().html('<h5 style="word-wrap:break-word">Do you really want to delete ' + $('table tr#' + $palayer_id).find('td#name').text() + '`s contract?</div>');
    modal_footer.show().html('<button type="button" class="btn btn-secondary" id="Close" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="Delete">Delete</button>');
    
    modal_footer.find('button#Delete').click(function(){
        $.ajax({
            type: 'DELETE',
            url: ('/player/contracts/delete/' + $palayer_id),
            success: function(result) {
                modal.find('.modal-body .alert-success').show().text(result.success + '!');
                $('table tr#' + $palayer_id).css('background-color', 'lightgrey').find('td button[data-target="#contractModal"]').text('Upload');
    
                setTimeout(function(){
                    modal.modal('hide');
                }, 1300);
            },
            error: function(result) {
                modal.find('.modal-body .alert-danger').show().text('Something had gone wrong!');             
            }
        });
    });
}
//--

// Close
modal.on('hide.bs.modal', function () {
    modal.find('.alert').hide();
});
//--

}());