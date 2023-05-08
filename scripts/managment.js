$(document).ready(function () {
    if ($('#comments ul div').length === 0) {
        // console.log("hiding cards");
        $('#comments').hide(); // hide the section if there are no li elements
    }

    
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