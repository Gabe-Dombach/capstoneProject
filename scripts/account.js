$(document).ready(function () {
    $('#deleteCards').click(function () {
        var selectedCards = $('input[type="checkbox"]:checked')
            .map(function () {
                return $(this).val();
            })
            .get()
            .join(',');

        $.ajax({
            type: 'POST',
            url: '../scripts/account.php',
            data: { selectedCards: selectedCards },
            success: function () {
                $('input[type="checkbox"]:checked').closest('li').remove();
            },
            error: function () {
                alert('Error deleting cards');
            },
        });
    });
});

