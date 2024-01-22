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

function modalHistory(idItem) {
    $.ajax({
        type: 'POST',
        url: '../app/controllers/historyMovementController.php',
        data: {
            idItem: idItem,
        },
        success: function () {

        }, error: function () {

        }
    });
}