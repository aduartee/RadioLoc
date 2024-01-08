<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\database\CustomerModel;

$customerModel = new CustomerModel;
$getCustomerById = (isset($_GET['id']) && $_GET['id'] !== '') ? $customerModel->getCustomerById($_GET['id']) : null;
$titleForm = (empty($getCustomerById)) ? 'Cadastrar Clientes' : 'Editar Clientes';
?>

<head>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>RadioLoc | <?= $titleForm ?></title>
    <!-- FLATPICKR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
</head>

<form id="form" action="../app/controllers/customerController.php" method="post" onsubmit="return processForm(this, '../app/controllers/customerController.php', 'customers.php')">
    <div class="container-form">
        <h2 class="title-form"><?= $titleForm ?><i class='bx bx bxs-user ml-2 text-white' type='solid'></i></h2>

        <input type="hidden" name="action" value="<?= (isset($_GET['id']) && $_GET['id'] !== '') ? "edit" : "create" ?>">
        <input type="hidden" name="id" value="<?= (isset($_GET['id']) && $_GET['id'] !== '') ? $_GET['id'] : '' ?>">


        <div class="col-md-6">
            <div class="d-flex flex-column mb-3">
                <label for="customerName" class="form-label label-form fw-bold mb-2">Nome do Cliente</label>
                <input type="text" name="customerName" value="<?= $getCustomerById && !(empty($getCustomerById->getCustomerName())) ? $getCustomerById->getCustomerName() : '' ?>" placeholder="Ex: Cliente Exemplo" class="form-style">
            </div>

            <div class="d-flex flex-column mb-3">
                <label for="address" class="form-label label-form fw-bold mb-2">Endereço</label>
                <input type="text" name="address" value="<?= $getCustomerById && !(empty($getCustomerById->getAddress())) ? $getCustomerById->getAddress() : '' ?>" placeholder="Ex: Rua Coronel Aldo" class="form-style">
            </div>
        </div>

        <button type="submit" class="form-button">Salvar</button>
    </div>
</form>
<!-- Toast Function -->
<script src="assets/js/toast.js"></script>
<!-- FLATPICKR -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="assets/js/datePicker.js"></script>