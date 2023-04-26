

$(document).ready(function () {
    let maxChars = 200;
    $('#reveiwData').on('input', function () {
        let currentChars = $(this).val().length;
        let remainingChars = maxChars - currentChars;
        $('#charCount').text(remainingChars + ' characters remaining');
        if ($('#reveiwData').val().length >= maxChars) {
            $('#reveiwData').css('border', '1px solid red');
            $this.val($(this.val()).substring(0, maxChars));
        } else {
            $('#reveiwData').css('border', '1px solid black');
        }
    });

    $('#quantity').on ("input", function () {
        $("#priceField").text('Price: $' + Math.ceil(($('#originalPrice').val() * $('#quantity').val()) *100)/100);
    });
});
