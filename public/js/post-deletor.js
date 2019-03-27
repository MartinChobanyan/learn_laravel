$('#deletorModal').on('show.bs.modal', function (e) {
    //init
    let $post_id = $(e.relatedTarget).data('id');

    let post = $('div#' + $post_id);
    let title = post.find('h4').text();

    let modal = $(this);
    modal.find('#question').html('Are you sure you want to delete "<i>' + title + '</i>" post?');

    // Delete
    modal.find('.modal-footer button#Delete').click(function(){
        $.ajax({
            type: 'DELETE',
            url: ('/profile/my-posts/delete/' + $post_id),
            success: function(result) {
                modal.find('.modal-body .alert-success').show().text(result.success + '!');
                post.remove();
                $('div#buttons-' + $post_id).remove();
                if(!$.trim($('div#posts div.card-body').html())) $('div#posts div.card-body').html('<h4 class="display-4">There is no posts to show! :(</h4>');

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
});

$('#deletorModal').on('hide.bs.modal', function () {
    modal.find('.alert').hide();
});