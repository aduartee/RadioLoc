<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\database\ItemModel;

$itemsModel = new ItemModel();
$items = $itemsModel->getAllItems();
?>

<head>
    <title>RadioLoc | Visualizar Equipamentos Ativos</title>
    <script src="assets/js/toast.js"></script>
    <script src="assets/js/remove.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<section class="home-section mb-10">
    <div class="h-60 max-w-full me-20 mb-20 mt-10 p-4 bg-gray-800 rounded-lg shadow-xl dark:shadow-dark-800 sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-3xl text-start text-gray-900 dark:text-white">Buscar Equipamentos</h2>
        <div class="d-flex flex-row">
            <div class="d-flex flex-column">
                <label for="itemName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Equipamento</label>
                <input type="text" name="itemName" id="itemName" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Radio Intelbras">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Endereço do Cliente</label>
                <input type="text" id="location" name="location" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rua Alberto Bins">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="customerName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Cliente</label>
                <input type="text" id="customerName" name="customerName" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jonas">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="serialNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serial</label>
                <input type="text" id="serialNumber" name="serialNumber" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="RF0LS-230">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="countries" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Ativos</option>
                    <option>Inativos</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <h2 class="text-3xl mt-3 text-start font-medium text-gray-900 dark:text-white">Visualizar Equipamentos</h2>
        <button data-modal-target="modal-item" data-modal-toggle="modal-item" onclick="newItem();" class="text-white h-20 ml-auto w-30 mr-20 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-base px-4 py-2 me-2 mb-2">
            <i class="bx bx-plus"></i>
            Adicionar Equipamento
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg me-20 ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" onchange="checkedAll()" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Equipamento
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Localização
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Nome do Cliente
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Ultima Movimentação
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Serial
                    </th>
                    <th scope="col" class=" text-lg">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) :
                    $itemId = $item->getId();
                    $customerId = $item->getCustomerID();
                ?>
                    <tr class="bg-dark border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" data-id="<?= $itemId ?>">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 myCheckbox text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </td>
                        <?php if (empty($item)) : ?>
                    <tr>
                        <td colspan="8">Inserir Registro</td>
                    </tr>
                <?php else : ?>
                    <th scope="row" class="px-6 py-4">
                        <?= $item->getItemName() ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $item->getLocation() ?>
                    </td>
                    <td class="px-6 py-4" id="totalEquipment" onclick="window.location.href='filterItem.php?id=<?= $customerId ?>'">
                        <?= $item->getCustomerName() ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $item->getLastMovement() ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $item->getSerialNumber() ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= ($item->getStatus() == 1) ? 'Ativo' : (($item->getStatus() == 2) ? 'Inativo' : 'Manutenção') ?>
                    </td>
                    <td class="flex items-center px-6 py-4 ms-20">
                        <button data-modal-target="modal-item" data-modal-toggle="modal-item" class="text-white w-auto mr-4 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" onclick="editItem(<?= $itemId ?>)">Editar</button>
                        <button id="open-movement-modal" data-modal-target="modal-type" data-modal-toggle="modal-type" class="text-white w-auto bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" onclick="getItemId(<?= $itemId ?>)">Adicionar Movimentação</button>
                        <button class="text-white w-auto bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 ms-2 mb-2" onclick="remove(<?= $item->getId(); ?>, '../app/controllers/removeItemController.php', 'este item')">Remover</button>
                    </td>
                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script src="assets/js/modalAjax.js"></script>
<script src="assets/js/tooltips.js"></script>
<script src="assets/js/getIdBtn.js"></script>