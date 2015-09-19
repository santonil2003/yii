$('document').ready(function () {

    $("time.timeago").timeago();

    /*-------------------------------------------------------------------------
     - comments
     -------------------------------------------------------------------------*/
    $('.cancel-comment').click(function () {
        $('.text-comment').val('');
    });

    /**
     * add comment
     */

    $('.post-comment').click(function () {
        var text = $('.text-comment').val();
        var video_id = $('.text-comment').data("vidoId");
        var url = $('#post-comment-action').val();

        $.ajax({
            method: "POST",
            url: url,
            data: {video_id: video_id, text: text}
        }).done(function (msg) {
            if (msg) {
                $('.new-comment').prepend(msg);
                $('.text-comment').val('');
                $('.ovc-comment-box').fadeIn('slow');
                $("time.timeago").timeago();
            }
        });

    });

    /**
     * load-edit comment
     */
    $(document).on('click', '.comment-edit', function () {
        var comment_id = $(this).data('commentId');
        var url = $(this).data('url');

        $.ajax({
            method: "POST",
            url: url
        }).done(function (msg) {
            $('#comment-' + comment_id).html(msg);
        });

    });


    /**
     * delete comment
     */
    $(document).on('click', '.comment-delete', function () {
        if (!confirm("Delete a comment?")) {
            return;
        }
        var comment_id = $(this).data('commentId');
        var url = $(this).data('url');

        $.ajax({
            method: "POST",
            url: url
        }).done(function (msg) {
            if (msg) {
                $('#comment-' + comment_id).fadeOut(1000).delay(1000).remove();
            }
        });
    });


    /**
     * update comment
     */
    $(document).on('click', '.save-comment', function () {
        var comment_id = $(this).data('commentId');
        var text = $('#edit-comment-' + comment_id + ' .text-comment').val();
        var url = $('#edit-comment-' + comment_id + ' .inline-save-comment').val();

        $.ajax({
            method: "POST",
            url: url,
            data: {id: comment_id, text: text}
        }).done(function (msg) {
            if (msg) {
                $('#comment-' + comment_id).replaceWith(msg);
                $('.ovc-comment-box').fadeIn('slow');
                $("time.timeago").timeago();
            }
        });
    });
});
