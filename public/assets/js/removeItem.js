function removeItem(id_item) {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/removeItemController.php',
        data: {
            id: id_item
        },
        success: function (response) {
            if (response.status == 'success') {
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