document.getElementById('form').addEventListener("submit", function (event) {
    event.preventDefault();
    processForm(this);
});

function showErrorToast(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: message,
    });
}

function processForm(form) {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/itemController.php',
        data: $(form).serialize(),
        success: function (response) {
            var result = response;

            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    cancelButtonText: 'Fechar',
                    confirmButtonText: 'Ir para pagina de listagem',
                    showCancelButton: true,

                    text: result.message,
                }).then(result => {
                    if (result.isConfirmed) {
                        Swal.fire("Redirecionando para a pagina principal", "", "success");
                        setTimeout(function () {
                            window.location.href = 'index.php';
                        }, 2000);
                    }
                });
            } else {
                showErrorToast(result.message);
            }
        },
        error: function () {
            showErrorToast('Erro interno no servidor');
        }
    });
}

