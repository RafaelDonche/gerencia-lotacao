$(document).ready(function () {
    $('.submit-button').click(function() {
        $(this).prop('disabled', true);
        $(this).text('Enviando...');
        $(this).closest('form').submit();
    });
});
