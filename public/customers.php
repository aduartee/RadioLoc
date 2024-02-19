<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\database\CustomerModel;

$customerModel = new CustomerModel;
$customers = $customerModel->getAllCustomers();
?>

<head>
    <title>RadioLoc | Visualizar Clientes</title>
    <!-- Tooltips -->
    <script src="assets/js/toast.js"></script>
    <script src="assets/js/remove.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<section class="home-section">
    <div data-dial-init class="fixed end-6 bottom-6 group">
        <div id="speed-dial-menu-default" class="flex flex-col items-center hidden mb-4 space-y-2">
            <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.419 10.581a3.564 3.564 0 0 0-2.574 1.1l-4.756-2.49a3.54 3.54 0 0 0 .072-.71 3.55 3.55 0 0 0-.043-.428L11.67 6.1a3.56 3.56 0 1 0-.831-2.265c.006.143.02.286.043.428L6.33 6.218a3.573 3.573 0 1 0-.175 4.743l4.756 2.491a3.58 3.58 0 1 0 3.508-2.871Z" />
                </svg>
                <span class="sr-only">Share</span>
            </button>
            <div id="tooltip-share" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Share
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-print" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z" />
                    <path
                        d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z" />
                </svg>
                <span class="sr-only">Print</span>
            </button>
            <div id="tooltip-print" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Print
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                    <path
                        d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Download</span>
            </button>
            <div id="tooltip-download" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Download
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
            <button type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left"
                class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 20">
                    <path
                        d="M5 9V4.13a2.96 2.96 0 0 0-1.293.749L.879 7.707A2.96 2.96 0 0 0 .13 9H5Zm11.066-9H9.829a2.98 2.98 0 0 0-2.122.879L7 1.584A.987.987 0 0 0 6.766 2h4.3A3.972 3.972 0 0 1 15 6v10h1.066A1.97 1.97 0 0 0 18 14V2a1.97 1.97 0 0 0-1.934-2Z" />
                    <path
                        d="M11.066 4H7v5a2 2 0 0 1-2 2H0v7a1.969 1.969 0 0 0 1.933 2h9.133A1.97 1.97 0 0 0 13 18V6a1.97 1.97 0 0 0-1.934-2Z" />
                </svg>
                <span class="sr-only">Copy</span>
            </button>
            <div id="tooltip-copy" role="tooltip"
                class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                Copy
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
        <button type="button" data-dial-toggle="speed-dial-menu-default" aria-controls="speed-dial-menu-default"
            aria-expanded="false"
            class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
            <span class="sr-only">Open actions menu</span>
        </button>
    </div>
    <div
        class="h-60 max-w-full me-20 mb-20 mt-10 p-4 bg-gray-800 rounded-lg shadow-xl dark:shadow-dark-800 sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h2 class="text-3xl text-start text-gray-900 dark:text-white">Buscar Clientes</h2>
        <div class="d-flex flex-row">
            <div class="d-flex flex-column">
                <label for="itemName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do
                    Cliente</label>
                <input type="text" name="customerName" id="customerName"
                    class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cliente X">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Endereço do
                    Cliente</label>
                <input type="text" id="location" name="location"
                    class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Rua Alberto Bins">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="lastMovement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ultima
                    Movimentação</label>
                <input type="text" id="lastMovement" name="lastMovement"
                    class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datePicker"
                    placeholder="<?= date('d/m/Y') ?>">
            </div>

            <div class="d-flex flex-column ms-12">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="countries"
                    class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-100 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option>Ativos</option>
                    <option>Devedor</option>
                    <option>Inativo</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <h2 class="text-3xl mt-3 text-start font-medium text-gray-900 dark:text-white">Visualizar Cliente</h2>
        <button data-modal-target="modal-customer" data-modal-toggle="modal-customer" onclick="newCustomer();"
            class="text-white h-20 w-30 mr-20 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-base px-4 py-2 me-2 mb-2">
            <i class="bx bx-plus"></i>
            Adicionar Cliente
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg me-20 ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-center">
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" onchange="checkedAll()" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg w-300">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Numero Total de Equipamentos
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Endereço
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Ultima Movimentação do Item
                    </th>
                    <th scope="col" class="px-6 py-3 text-lg">
                        Telefone
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
                <?php foreach ($customers as $customer):
                    $customerId = $customer->getId();
                    $totalEquipaments = $customer->getTotalEquipment();
                    ?>
                    <tr class="bg-dark border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                        data-id="<?= $customerId ?>">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                    class="w-4 h-4 myCheckbox text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </td>
                        <?php if (empty($customer)): ?>
                        <tr>
                            <td colspan="8">Inserir Registro</td>
                        </tr>
                    <?php else: ?>
                        <th scope="row" class="px-6 py-4">
                            <?= $customer->getCustomerName(); ?>
                        </th>
                        <td class="px-6 py-4" <?= ($totalEquipaments != 'Nenhum Equipamento Cadastrado') ? 'id="totalEquipment" onclick="window.location.href=\'filterItem.php?id=' . $customerId . "'\"" : ''; ?>>
                            <?= $totalEquipaments ?>
                        </td>

                        <td class="px-6 py-4">
                            <?= $customer->getAddress(); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $customer->getLastMovement(); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= $customer->getPhone(); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?= ($customer->getStatus() == 1) ? 'Ativo' : (($customer->getStatus() == 2) ? 'Inativo' : 'Manutenção') ?>
                        </td>
                        <td class="flex items-center px-6 py-4 ms-20">
                            <button data-modal-target="modal-customer" data-modal-toggle="modal-customer"
                                class="text-white w-30 mr-4 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                onclick="editCustomer(<?= $customerId ?>)">Editar</button>
                            <button
                                class="text-white w-30 bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                onclick="remove(<?= $customer->getId(); ?>, '../app/controllers/removeCustomerController.php', 'esse cliente')">Remover</button>
                        </td>
                    <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<script src="assets/js/tooltips.js"></script>
<script src="assets/js/modalAjax.js"></script>