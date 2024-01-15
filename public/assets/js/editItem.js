function editItem(id) {
    $.ajax({
        type: "POST",
        url: "../app/controllers/completeFormController.php",
        data: {
            id: id
        },
        success: function (response) {
            if (response.error) {
                console.log('Erro: ' + response.error);
                return;
            }
            console.log(response);
            console.log(id);
            console.log(response.location);
            $("#itemName").val(response.itemName);
            $("#location").val(response.location);
        },
        error: function () {
            console.log('Erro total');
        }
    });
}