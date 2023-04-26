$(document).ready(function () {
    $('input[type="submit"]').prop('disabled', true);

    $('.managmentInput').keyup(function () {
        // console.log("working");
        var allFilled = true;
        $('.managmentInput').each(function () {
            // console.log($(this).val());
            if ($(this).val() == '') {
                allFilled = false;
                // console.log(allFilled);
            }
        });
        
        $('#managmentSubmit').prop('disabled', !allFilled);
    });
});