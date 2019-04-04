;(function(){
// Declaring & init
let 
    modal = $('#deletorModal'),
    $user_id,
    user;
//--

modal.on('show.bs.modal', function (e) {
    // init
    $user_id = $(e.relatedTarget).data('id');
    user = $('table tr#' + $user_id);
    //--

    // putting data into Model body
    modal.find('#question').text('Do you really want to delete user ' + user.find('td#name').text() + '?');
    //--
});

//Close
modal.on('hide.bs.modal', function () {
    modal.find('.alert').hide();
});
//--

// Delete
modal.find('.modal-footer button#Delete').click(function(){
    $.ajax({
        type: 'DELETE',
        url: ('/users/delete/' + $user_id),
        success: function(result) {
            modal.find('.modal-body .alert-success').show().text(result.success + '!');
            user.remove();

            setTimeout(function(){
                modal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            modal.find('.modal-body .alert-danger').show().text('Something had gone wrong!');
            console.error(result);                
        }
    });
}); 
//--
}());