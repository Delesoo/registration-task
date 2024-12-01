$(document).ready(function () {
    $('#regForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'register.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
            },
            error: function () {
                alert('Error!');
            }
        });
    });
});