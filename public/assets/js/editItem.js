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
            $("#titleModal").html('Editar Equipamento')
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