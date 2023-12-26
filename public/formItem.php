<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\classes\Item;
use app\database\ItemModel;

$item = new Item;
$itemModel = new ItemModel;
$getById = $itemModel->getById($_GET['id']);
$titleForm = (empty($getById)) ? 'Cadastrar Equipamento' : 'Editar Equipamento';
?>


<head>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<form id="form" action="../app/controllers/itemController.php" method="post">
    <div class="container-form">
        <h2 class="title-form"><?= $titleForm ?><i class='bx bx-devices ml-2 text-white' type='solid'></i></h2>

        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column mb-3">
                    <label for="itemName" class="form-label label-form fw-bold mb-2">Nome do Equipamento</label>
                    <input type="text" name="itemName" value="<?= !(empty($getById->getItemName())) ? $getById->getItemName() : '' ?>" placeholder="Ex: Radio" class="form-style w-75">
                </div>

                <div class="d-flex flex-column mb-3">
                    <label for="location" class="form-label label-form fw-bold mb-2">Localização do Equipamento</label>
                    <input type="text" name="location" value="<?= !(empty($getById->getLocation())) ? $getById->getLocation() : '' ?>" placeholder="Ex: Rua São João" class="form-style w-75">
                </div>

                <div class="d-flex flex-column mb-3">
                    <label for="clientName" class="form-label label-form fw-bold mb-2">Nome do Cliente</label>
                    <input type="text" name="clientName" value="<?= !(empty($getById->getClientName())) ? $getById->getClientName() : '' ?>" placeholder="Ex: João Ribas" class="form-style w-75">
                </div>

                <div class="d-flex flex-column">
                    <label for="model" class="form-label label-form fw-bold mb-2">Modelo do Equipamento</label>
                    <input type="text" name="model" value="<?= !(empty($getById->getModel())) ? $getById->getModel() : '' ?>" placeholder="Ex: RC 3002 S2" class="form-style w-75">
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex flex-column mb-3">
                    <label for="serialNumber" class="form-label label-form fw-bold mb-2">Numero de Serial</label>
                    <input type="text" name="serialNumber" value="<?= !(empty($getById->getSerialNumber())) ? $getById->getSerialNumber() : '' ?>" placeholder="Ex: RX00-xwqe-tiew" class="form-style w-75">
                </div>

                <div class="d-flex flex-column mb-3">
                    <label for="status" class="form-label label-form fw-bold mb-2">Status</label>
                    <select name="status" id="status" class="form-style w-75">
                        <option value='1' <?= $getById->getStatus() == 1 ? 'selected' : '' ?> class="text-success">Ativo</option>
                        <option value='3' <?= $getById->getStatus() == 3 ? 'selected' : '' ?> class="text-warning">Manutenção</option>
                        <option value='2' <?= $getById->getStatus() == 2 ? 'selected' : '' ?> class="text-danger">Inativo</option>
                    </select>
                </div>

                <div class="d-flex flex-column mb-3">
                    <label for="lastMovement" class="form-label label-form fw-bold mb-2">Ultima Movimentação</label>
                    <input type="text" name="lastMovement" value="<?= !(empty($getById->getLastMovement())) ? $getById->getLastMovement() : '' ?>" placeholder="Ex: <?= date('d/m/Y') ?>" class="form-style w-75">
                </div>

                <div class="d-flex flex-column mb-3">
                    <label for="additionalNotes" class="form-label label-form fw-bold mb-2">Observações</label>
                    <textarea name="additionalNotes" value="<?= !(empty($getById->getAdditionalNotes())) ? $getById->getAdditionalNotes() : '' ?>" class="form-style w-75" placeholder="Ex: Campo para informações importantes sobre o equipamento" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="form-button">Salvar</button>
    </div>
</form>
<!-- Toast Function -->
<script src="assets/js/toast.js"></script>