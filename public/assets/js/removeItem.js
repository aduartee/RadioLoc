function removeItem(id_item) {
    Swal.fire({
        title: 'Confirmação',
        text: 'Tem certeza de que deseja remover este item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../app/controllers/removeItemController.php',
                data: {
                    id: id_item
                },
                success: function (response) {
                    if (response.status == 'success') {
                        $(`tr[data-id="${id_item}"]`).addClass('fade-out');

                        setTimeout(function () {
                            $(`tr[data-id="${id_item}"]`).remove();
                        }, 1000);

                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });
        }
    });
}
