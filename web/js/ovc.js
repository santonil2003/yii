/**
 * OVC ajax
 * @param {type} url
 * @param {type} data
 * @param {type} output
 * @returns {undefined}
 */
var ovc_ajax = function (url, data, output) {
    $.ajax({
        method: "POST",
        url: url,
        data: data
    }).done(function (msg) {
        if (msg) {
            $(output).html(msg);
        }
    });
};
