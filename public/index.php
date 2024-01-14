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

<section class="home-section">
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
                <input type="text" id="customerName" name="customerName" class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rua Alberto Bins">
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

    <!-- <div class="w-full p-4 text-center bg-gray-800 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
         -->
    <div class="d-flex flex-row">
        <h2 class="text-3xl text-start font-medium text-gray-900 dark:text-white">Visualizar Equipamentos</h2>
        <button class="text-white flex-end w-30 mr-4 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2" onclick="window.location.href='formItem.php'">
            <i class='bx bx-plus'></i>Adicionar Equipamento</span>
        </button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg me-20">
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
                    <th scope="col" class="px-6 py-3 text-lg">
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
                <?php else :
                            $editUrl = "formItem.php?id=$itemId";
                ?>
                    <th scope="row" class="px-6 py-4">
                        <?= $item->getItemName() ?>
                    </th>
                    <td class="px-6 py-4">
                        <?= $item->getLocation() ?>
                    </td>
                    <td class="px-6 py-4">
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
                        <button class="text-white w-30 mr-4 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" onclick="window.location.href='<?= $editUrl; ?>'">Editar</button>
                        <button class="text-white w-30 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" onclick="remove(<?= $item->getId(); ?>, '../app/controllers/removeItemController.php', 'item')">Remover</button>
                    </td>
                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>