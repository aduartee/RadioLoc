function showErrorToast(message) {
    Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: message,
    });
}

function processForm(form, itemControllerUrl, successRedirect) {
    event.preventDefault();
    console.log(form);
    $.ajax({
        type: "POST",
        url: itemControllerUrl,
        data: $(form).serialize(),
        success: function (response) {
            if (response.status === 'success') {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    confirmButtonText: 'Ok',
                    showCancelButton: false,
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
                console.log(response);
                showErrorToast(response.message);
            }
        },
        error: function (response) {
            console.log(response);
            showErrorToast('Erro interno no servidor');
        }
    });
}


