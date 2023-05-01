$(document).ready(function () {
    $('input[type="submit"]').prop('disabled', true);

    $('.cardVals').keyup(function () {
        var allFilled = true;
        $('.cardVals').each(function () {
            if (
                $(this).val() == '' ||
                $('#addYY').val() == 'NOT_SET' ||
                $('#addMM').val() == 'NOT_SET'
            ) {
                allFilled = false;
            }
        });
        $('#newCardSubmit').prop('disabled', !allFilled);
    });

    $('.passField').keyup(function () {
        var allFilled = true;
        $('.passField').each(function () {
            if ($(this).val() == '') {
                allFilled = false;
            }
        });
        $('#passFieldSubmit').prop('disabled', !allFilled);
    });

    // check if there are any li elements in the ul inside the section
    if ($('.showCards ul li').length === 0) {
        // console.log("hiding cards");
        $('.showCards').hide(); // hide the section if there are no li elements
    }
});
