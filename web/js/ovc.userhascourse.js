$('#userhascourse-user_id').change(function () {
    var user_id = $(this).val();
    var url = user_has_course_form_url + '?url=' + user_id;

    $.ajax({
        method: "POST",
        url: url,
        data: {user_id: user_id}
    }).done(function (msg) {
        if (msg) {
            $('#userhascourse-course_id').replaceWith(msg);
        }
    });
});
