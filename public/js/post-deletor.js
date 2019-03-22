$('#deletorModal').on('show.bs.modal', function (e) {
    //init
    var $post_id = $(e.relatedTarget).data('id');

    var post = $('div#' + $post_id);
    var title = post.find('h4').text();

    var modal = $(this);
    modal.find('#question').html('Do you really want to delete post <br>"<i>' + title + '</i>&nbsp;"&nbsp;?');

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