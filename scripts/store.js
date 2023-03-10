$(document).ready(function () {
    $('#departmentForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);
            },
        });
    });
    $('#department').on('change', function () {
        $('#Filter').click();
    });
    // $('.item').on('click', function () {
    //     let id = $(this).attr('id');
    //     $('#' + id).children('#'.id).click();
    // })
});
