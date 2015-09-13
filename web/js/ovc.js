$('document').ready(function () {


    $('.cancel-comment').click(function () {
        $('.text-comment').val('');
    });


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





    $("time.timeago").timeago();
});