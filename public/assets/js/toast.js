function showErrorToast(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: message,
    });
}

function processForm(form, itemControllerUrl, successRedirect) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: itemControllerUrl,
        data: $(form).serialize(),
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    cancelButtonText: 'Voltar',
                    confirmButtonText: 'Ir para pagina de listagem',
                    showCancelButton: true,
                    text: response.message,
                }).then(response => {
                    if (response.isConfirmed) {
                        Swal.fire("Redirecionando para a pagina de listagem", "", "success");
                        setTimeout(function () {
                            window.location.href = successRedirect;
                        }, 1000);
                    }
                });
            } else {
                showErrorToast(response.message);
            }
        },
        error: function (response) {
            console.log(response);
            showErrorToast('Erro interno no servidor');
        }
    });
}


