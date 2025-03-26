$(document).ready(function () {

    $('#tarifContainer').on('input change', '.valueInput, .tarifSelect', function () {
        const $inputGroup = $(this).closest('.input-group');
        const userInput = parseFloat($inputGroup.find('.valueInput').val());
        const userChoice = parseFloat($inputGroup.find('.tarifSelect option:selected').data('price'));

        if (!isNaN(userInput) && !isNaN(userChoice)) {
            $inputGroup.find(".output").val((userInput * userChoice).toFixed(2) + ' грн');
        } else {
            $inputGroup.find(".output").val("");
        }
    });

    $('#tarifContainer').on('click', '.removeBtn', function () {
        $(this).closest('.input-group').remove();
    });

    $('#submitBtn').on('click', function () {
        const formData = $('#tarifForm').serialize();

        $.ajax({
            url: "{{ route('tarifs.store') }}",
            method: 'POST',
            data: formData,
            success: function (response) {
                $('body').html(response);
            },
            error: function (xhr) {
                alert('Ошибка при отправке данных.');
                console.error(xhr.responseText);
            }
        });
    });

});
