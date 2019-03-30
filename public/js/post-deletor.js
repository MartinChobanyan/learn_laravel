// Declaring & init
let
    dmodal = $('#deletorModal'),
    $post_id,
    post;
//--

$('#deletorModal').on('show.bs.modal', function (e) {
    // init
    $post_id = $(e.relatedTarget).data('id');
    post = $('div#' + $post_id);
    //--

    // putting data into Model body
    dmodal.find('#question').html('Are you sure you want to delete "<i>' + post.find('h4').text() + '</i>" post?');
    //--
});

// Delete
dmodal.find('.modal-footer button#Delete').click(function(){
    $.ajax({
        type: 'DELETE',
        url: ('/profile/my-posts/delete/' + $post_id),
        success: function(result) {
            dmodal.find('.modal-body .alert-success').show().text(result.success + '!');
            post.remove();
            $('div#buttons-' + $post_id).remove();
            if(!$.trim($('div#posts div.card-body').html())) $('div#posts div.card-body').html('<h4 class="display-4">There is no posts to show! :(</h4>');

            setTimeout(function(){
                dmodal.modal('hide');
            }, 1300);
        },
        error: function(result) {
            dmodal.find('.modal-body .alert-danger').show().text('Something had gone wrong!');
            console.error(result);                
        }
    });
});
//--

//Close
dmodal.on('hide.bs.modal', function () {
    dmodal.find('.alert').hide();
});
//--