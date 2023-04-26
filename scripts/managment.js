$(document).ready(function () {
    $('input[type="submit"]').prop('disabled', true);

    $('#managmentInput').keyup(function () {
        var allFilled = true;
        $('#managmentInput').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });
        $('#managmentSubmit').prop('disabled', !allFilled);
    });
});