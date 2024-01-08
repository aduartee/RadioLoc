<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\database\CustomerModel;

$customerModel = new CustomerModel;
$customers = $customerModel->getAllCustomers();
?>

<head>
    <title>RadioLoc | Visualizar Clientes</title>
    <script src="assets/js/toast.js"></script>
    <script src="assets/js/removeItem.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<section class="home-section">
    <div class="container-search">
        <h2 class="search-text">Buscar Clientes</h2>
    </div>

    <div class="container-table">
        <div class="d-flex flex-row">
            <h2 class="title-table">Visualizar Clientes</h2>
            <button class="add-button" onclick="window.location.href='formCustomer.php'">
                <i class='bx bx-plus'></i> Adicionar Cliente
            </button>
        </div>

        <table class="container">
            <thead>
                <tr>
                    <th>
                        <h1>Nome do Cliente</h1>
                    </th>
                    <th>
                        <h1>Numero de Equipamentos</h1>
                    </th>
                    <th>
                        <h1>Endereço</h1>
                    </th>
                    <th>
                        <h1>Ultima Movimentação</h1>
                    </th>
                    <th>
                        <h1>Ações</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer) :
                ?>
                    <?php
                    if (empty($customer)) : ?>
                        <tr>
                            <td colspan="8">Nenhum Registro</td>
                        </tr>
                    <?php else :
                        $customerId = $customer->getId();
                        $editUrl = "formCustomer.php?id=$customerId";
                    ?>
                        <tr data-id="<?= $customerId ?>">
                            <td><?= $customer->getCustomerName(); ?></td>
                            <td><?= $customer->getTotalEquipment(); ?></td>
                            <td><?= $customer->getAddress(); ?></td>
                            <td><?= $customer->getLastMovement(); ?></td>
                            <td class="actions-cell">
                                <button onclick="window.location.href='<?= $editUrl; ?>'" class="edit-button">Editar</button>
                                <button class="remove-button" onclick="">Remover</button>
                            </td>
                        </tr>
                <?php
                    endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</section>