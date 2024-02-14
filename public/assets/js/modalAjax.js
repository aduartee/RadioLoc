function showToastSuccess(message) {
    Swal.fire({
        icon: 'success',
        title: 'Sucesso',
        text: message,
    });
}

function showToastError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
    });
}

function editItem(id) {
    fetch('../app/controllers/completeFormController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(id),
    })
        .then(response => {
            if (!response.ok) {
                showToastError('Erro ao realizar a requisição, tente novamente 😀');
                throw new Error('Erro na requisição');
            }
            return response.json();
        })
        .then(response => {
            document.getElementById('formId').value = id;
            document.getElementById('action').value = 'edit';
            document.getElementById('titleModal').textContent = 'Editar Equipamento';
            document.getElementById('itemName').value = response.itemName;
            document.getElementById('location').value = response.location;
            document.getElementById('model').value = response.model;
            document.getElementById('serialNumber').value = response.serialNumber;
            document.getElementById('status').value = response.status;
            document.getElementById('lastMovement').value = response.lastMovement;
            document.getElementById('additionalNotes').value = response.additionalNotes;
            populateCustomerDropdown(response.customers, response.customerID);
        })
        .catch(error => {
            showToastError('Erro ao processar a requisição. Por favor, tente novamente.')
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
        }
    });
}

const firstListHistory = document.querySelectorAll(".list-history")[0];
if (firstListHistory) {
    firstListHistory.addEventListener('click', function () {
        const equipamentId = document.getElementById('idItem');
        completeCustomerMovement(equipamentId.value);
    });
}

function completeCustomerMovement(equipamentId) {
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'equipmentId=' + encodeURIComponent(equipamentId)
    };

    fetch('../app/controllers/getCustomerHistoryController.php', options)
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
            showToastError(error);
        });
}

function populateCustomerMovement(customers) {
    var selectFrom = $("#fromCustomerID");
    var selectTo = $("#toCustomerID");
    selectFrom.empty();
    selectTo.empty();

    customers[0].forEach(function (customer) {
        var option2 = $("<option>").val(customer['id']).text(customer['customerName']).appendTo(selectTo);
    });

    var option1 = $("<option>").val(customers[1]['customerID']).text(customers[1]['CustomerName']).appendTo(selectFrom);

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
        }, error: function (response) {
            showToastError(response.message);
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
                        dateP.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mt-2 mb-2');
                        var locationP = document.createElement('p');
                        locationP.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mb-2');
                        var occurred = document.createElement('p');
                        occurred.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mb-2');
                        var locationF = document.createElement('p');
                        locationF.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mb-2');
                        var locationF = document.createElement('p');
                        locationF.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white mb-2');
                        var type = document.createElement('p');
                        type.setAttribute('class', 'text-sm font-medium text-gray-900 truncate dark:text-white');


                        switch (movementData['movementType']) {
                            case 'location':
                                dateP.textContent = '📅 Data: ' + formatDateToBrazil(movementData['date']);
                                locationP.textContent = '🌎 Localização: ' + movementData['newLocation'];
                                occurred.textContent = '⚠️ Ocorrido: Item Foi Para Um Novo Endereço';
                                type.textContent = '📋 Tipo: Troca de Localização  ';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(locationP);
                                innerDiv.appendChild(occurred);
                                innerDiv.appendChild(type);
                                break;


                            case 'transfer':
                                dateP.textContent = '📅 Data: ' + formatDateToBrazil(movementData['date']);
                                locationP.textContent = '⬅️ De: ' + movementData['fromCustomerName'];
                                locationF.textContent = '➡️ Para: ' + movementData['toCustomerName'];
                                occurred.textContent = '⚠️ Ocorrido: Transferência de cliente para Cliente';
                                type.textContent = '📋 Tipo: Tranferencia';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(locationP);
                                innerDiv.appendChild(locationF);
                                innerDiv.appendChild(occurred);
                                innerDiv.appendChild(type);
                                break;


                            case 'maintenance':
                                dateP.textContent = '📅 Data: ' + formatDateToBrazil(movementData['date']);
                                (movementData['equipamentSituation'] == 'going') ? occurred.textContent = '⚠️ Ocorrido: Item Foi Para Manutenção' : occurred.textContent = 'Tipo: ⚠️ Item Voltou da Manutenção';
                                type.textContent = '📋 Tipo: Manutenção';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(occurred);
                                innerDiv.appendChild(type);
                                break;

                            case 'lost':
                                dateP.textContent = '📅 Data: ' + formatDateToBrazil(movementData['date']);
                                occurred.textContent = (movementData['equipamentSituation'] === 'lost') ? '❓ Ocorrido: Equipamento Foi Perdido' : '🚚 Ocorrido: Equipamento Foi Extraviado';
                                type.textContent = '📋 Tipo: Perda ou Extravio';
                                innerDiv.appendChild(dateP);
                                innerDiv.appendChild(occurred);
                                innerDiv.appendChild(type);
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
                        }, 2000);

                        showToastSuccess(response.message);
                    } else {
                        showToastError(response.message);
                    }
                }
            });
        }
    });
}

function formatDateToBrazil(date) {
    if(date != undefined){
        const [year, month, day] = date.split('-');
        return `${day}/${month}/${year}`;    
    } else{
        return 'Data Inválida 🤔';
    }
}