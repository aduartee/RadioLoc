function editItem(id) {
    $.ajax({
        type: "POST",
        url: "../app/controllers/completeFormController.php",
        data: {
            id: id
        },
        success: function (response) {
            if (response.error) {
                return;
            }
            $('#formId').val(id);
            $('#action').val('edit');
            $("#titleModal").html('Editar Equipamento');
            $("#itemName").val(response.itemName);
            $("#location").val(response.location);
            $("#model").val(response.model);
            $("#serialNumber").val(response.serialNumber);
            $("#status").val(response.status);
            $("#lastMovement").val(response.lastMovement);
            $("#additionalNotes").val(response.additionalNotes);
            populateCustomerDropdown(response.customers, response.customerID);

        },
        error: function () {
            console.log('Erro total');
        }
    });
}


function newItem() {
    $('.empty').each(function () {
        if ($(this).is('input, textarea, select')) {
            $(this).val('');
        } else {
            $(this).empty();
        }
    });

    $("#titleModal").html('Criar Equipamento');
    $('#action').val('create');

    $.ajax({
        type: 'POST',
        url: '../app/controllers/getCustomerController.php',
        success: function (response) {
            populateCustomerDropdown(response, null);
        }, error: function () {
            console.log(response);
        }
    });
}

function editCustomer(id) {
    $.ajax({
        type: "POST",
        url: "../app/controllers/completeCustomerController.php",
        data: {
            id: id
        },
        success: function (response) {
            if (response.error) {
                return;
            }
            $('#idCustomer').val(id);
            $('#actionCustomer').val('edit');
            $("#titleCustomer").html('Editar Cliente');
            $('#customerName').val(response.customerName);
            $('#address').val(response.address);
            $('#status').val(response.status);
            $('#phone').val(response.phone);
        }, error: function () {
            console.log('Erro total');
        }
    });
}

function newCustomer() {
    $('.empty').each(function () {
        if ($(this).is('input, textarea, select')) {
            $(this).val('');
        } else {
            $(this).empty();
        }
    });

    $('#actionCustomer').val('create');
    $("#titleCustomer").html('Criar Cliente');
}

function populateCustomerDropdown(customers, selectedCustomerID) {
    var select = $("#customerID");
    select.empty();

    customers.forEach(function (customer) {
        var option = $("<option>").val(customer.id).text(customer.customerName).appendTo(select);
    });

    var selectedOption = select.find('option[value="' + selectedCustomerID + '"]');

    if (selectedOption.length > 0) {
        select.val(selectedCustomerID);
    }
}

function modalHistory(itemId) {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/historyMovementController.php',
        data: {
            itemId: itemId
        },
        success: function (response) {
            if (response.message == '') {
                console.log(response);
                $('#list-modal ul').empty();
                var cardHtml;
                $.each(response.data, function (index, movementData) {
                    cardHtml = '<li class="py-3 sm:py-4" data-id="' + movementData.id + '">';
                    cardHtml += '<p class="text-2xl font-semibold text-blue-600/100 dark:text-blue-500/100 ms-4">';
                    cardHtml += (index + 1) + 'º Movimentação';
                    cardHtml += '</p>'
                    cardHtml += '<div class="flex items-center">';
                    cardHtml += '<div class="flex-1 min-w-0 ms-4">';
                    cardHtml += '<p class="text-sm font-medium text-gray-900 truncate dark:text-white mt-2"> Data: ';
                    cardHtml += movementData.date;
                    cardHtml += '</p>';
                    cardHtml += '<p class="text-sm font-medium text-gray-900 truncate dark:text-white"> Localização: ';
                    cardHtml += movementData.newLocation;
                    cardHtml += '</p>';
                    cardHtml += '</div>';
                    cardHtml += '<i id="remove" onclick="removeMovement(' + movementData.id + ')" class="bx bx-x text-2xl cursor-pointer mb-2 me-6 font-semibold text-red-600/100 dark:text-red-500/100"></i>';
                    cardHtml += '</div>';
                    cardHtml += '</li>';

                    tippy('#remove', {
                        content: 'Remover Movimentação',
                        placement: 'top',
                        animation: 'fade',
                    });

                    $('#list-modal ul').append(cardHtml);
                });
            } else {
                console.log(response);
                $('#list-modal ul').empty();
                let cardHtml2 = '<p class="text-sm dark:text-white ms-2 mb-2 mt-4 text-gray-900">' + response.message + '</p>';
                $('#list-modal ul').append(cardHtml2);
            }
        }, error: function (response) {
            console.log(response);

        }
    });
}

function removeMovement(movementId) {
    Swal.fire({
        title: 'Confirmação',
        text: 'Tem certeza de que deseja remover essa movimentação ?',
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
                url: '../app/controllers/removeMovementController.php',
                data: {
                    movementId: movementId
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $(`li[data-id="${movementId}"]`).addClass('fade-out');

                        setTimeout(function () {
                            $(`li[data-id="${movementId}"]`).remove();
                        }, 3000);

                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso',
                            text: response.message,
                        });
                    } else {
                        console.log(response);
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
