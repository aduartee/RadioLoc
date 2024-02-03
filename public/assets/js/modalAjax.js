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

document.querySelector(".list-history").addEventListener('click', function () {
    completeCustomerMovement();
});

function completeCustomerMovement() {
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    };

    fetch('../app/controllers/getCustomerController.php', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(response => {
            if (response.error) {
                return;
            }
            populateCustomerMovement(response);
        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

function populateCustomerMovement(customers) {
    var selectFrom = $("#fromCustomerID");
    var selectTo = $("#toCustomerID");
    selectFrom.empty();
    selectTo.empty();

    customers.forEach(function (customer) {
        var option1 = $("<option>").val(customer.id).text(customer.customerName).appendTo(selectFrom);
        var option2 = $("<option>").val(customer.id).text(customer.customerName).appendTo(selectTo);
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
    var xhr = new XMLHttpRequest();

    xhr.open('POST', '../app/controllers/historyMovementController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.message == '') {
                    var listModal = document.getElementById('list-modal');
                    var ul = listModal.querySelector('ul');
                    ul.innerHTML = '';

                    response.data.forEach(function (movementData, index) {
                        console.log(movementData);
                        console.log(index);

                        var li = document.createElement('li');
                        li.setAttribute('class', 'py-3 sm:py-4');
                        li.setAttribute('data-id', movementData['id']);
                        var p = document.createElement('p');
                        p.setAttribute('class', 'text-2xl font-semibold text-blue-600/100 dark:text-blue-500/100 ms-4');
                        p.textContent = (index + 1) + 'º Movimentação';
                        var div = document.createElement('div');
                        div.setAttribute('class', 'flex items-center');
                        var innerDiv = document.createElement('div');
                        innerDiv.setAttribute('class', 'flex-1 min-w-0 ms-4');
                        var dateP = document.createElement('p');
                        dateP.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mt-2');
                        var locationP = document.createElement('p');
                        locationP.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white');
                        var typeP = document.createElement('p');
                        typeP.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white');
                        var locationF = document.createElement('p');
                        locationF.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white');

                        switch (movementData['movementType']) {
                            case 'location':
                                dateP.textContent = 'Data: ' + movementData['date'];
                                locationP.textContent = 'Localização: ' + movementData['newLocation'];
                                typeP.textContent = 'Tipo da Movimentação: Troca de Localização ';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(locationP);
                                innerDiv.appendChild(typeP);


                            case 'transfer':
                                dateP.textContent = 'Data: ' + movementData['date'];
                                locationP.textContent = 'De: ' + movementData['fromCustomerName'];
                                locationF.textContent = 'Para: ' + movementData['toCustomerName'];
                                typeP.textContent = 'Tipo: Transferência de cliente para Cliente';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(locationP);
                                innerDiv.appendChild(locationF);
                                innerDiv.appendChild(typeP);


                            case 'maintenance':
                                dateP.textContent = 'Data: ' + movementData['date'];
                                locationP.textContent = 'De: ' + movementData['fromCustomerName'];
                                (movementData['equipamentSituation'] == 'going') ? typeP.textContent = 'Tipo: Item Foi Para Manutenção' :  typeP.textContent = 'Tipo: Item Voltou da Manutenção';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(locationP);
                                innerDiv.appendChild(locationF);
                                innerDiv.appendChild(typeP);
                                break;

                            case 'lost':
                                break;

                        }


                        div.appendChild(innerDiv);

                        var removeIcon = document.createElement('i');
                        removeIcon.setAttribute('id', 'remove');
                        removeIcon.setAttribute('class', 'bx bx-x text-2xl cursor-pointer mb-2 me-6 font-semibold text-red-600/100 dark:text-red-500/100');
                        removeIcon.setAttribute('onclick', 'removeMovement(' + movementData.id + ')');

                        div.appendChild(removeIcon);

                        li.appendChild(p);
                        li.appendChild(div);

                        ul.appendChild(li);

                        tippy('#remove', {
                            content: 'Remover Movimentação',
                            placement: 'top',
                            animation: 'fade',
                        });
                    });
                } else {
                    console.log(response);
                    var listModal = document.getElementById('list-modal');
                    var ul = listModal.querySelector('ul');
                    ul.innerHTML = '';

                    var cardHtml2 = '<p class="text-sm dark:text-white ms-2 mb-2 mt-4 text-gray-900">' + response.message + '</p>';
                    ul.innerHTML = cardHtml2;
                }
            } else {
                console.log(xhr.status);
            }
        }
    };

    var data = 'itemId=' + encodeURIComponent(itemId);
    xhr.send(data);
}

function changeModalMovement(typeMovement) {
    const inputLocationDiv = document.querySelector('#inputLocation');
    const inputDateLabel = document.querySelector('#inputDate label');
    const containerMaintenance = document.querySelector('#containerMaintenance');
    const fromCustomer = document.querySelector('#fromCustomer');
    const toCustomer = document.querySelector('#toCustomer');
    const lostMisplacement = document.querySelector('#lostMisplacement');

    document.querySelectorAll('.emptyMovement').forEach(function (element) {
        element.value = '';
    })

    switch (typeMovement) {
        case 'location':
            document.getElementById('movementType').value = 'location';
            inputDateLabel.innerHTML = 'Data da Movimentação';
            inputLocationDiv.style.display = 'block';
            containerMaintenance.style.display = 'none';
            fromCustomer.style.display = 'none';
            toCustomer.style.display = 'none';
            lostMisplacement.style.display = 'none';
            break;

        case 'transfer':
            document.getElementById('movementType').value = 'transfer';
            inputDateLabel.innerHTML = 'Data da Movimentação';
            fromCustomer.style.display = 'block';
            toCustomer.style.display = 'block';
            containerMaintenance.style.display = 'none';
            inputLocationDiv.style.display = 'none';
            lostMisplacement.style.display = 'none';
            break;

        case 'maintenance':
            document.getElementById('movementType').value = 'maintenance';
            inputDateLabel.innerHTML = 'Data';
            containerMaintenance.style.display = 'block';
            inputLocationDiv.style.display = 'none';
            fromCustomer.style.display = 'none';
            toCustomer.style.display = 'none';
            lostMisplacement.style.display = 'none';
            break;

        case 'lost':
            document.getElementById('movementType').value = 'lost';
            inputDateLabel.innerHTML = 'Data do Ocorrido';
            lostMisplacement.style.display = 'block';
            inputLocationDiv.style.display = 'none';
            fromCustomer.style.display = 'none';
            toCustomer.style.display = 'none';
            containerMaintenance.style.display = 'none';
    }
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
