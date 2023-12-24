function showSuccessToast(message) {
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: message,
    });
}

function showErrorToast(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: message,
    });
}

function processForm(form) {
    console.log('Formulário enviado!');
    console.log('Dados do formulário:', form.serialize());
    console.log(response);
    $.ajax({
        type: 'POST',
        url: '../../../app/controllers/itemController.php',
        data: form.serialize(),
        success: function (response) {
            var result = JSON.parse(response);

            if (result.status === 'success') {
                showSuccessToast(result.message);

                window.location.href = '../index.php';
            } else {
                showErrorToast(result.message);
            }
        },
        error: function () {
            showErrorToast('Erro interno no servidor');
        }
    });
}

