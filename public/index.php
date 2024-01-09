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
    <div class="container-search">
        <h2 class="search-text">Buscar Equipamentos</h2>
    </div>

    <div class="container-table">
        <div class="d-flex flex-row">
            <h2 class="title-table">Visualizar Equipamentos</h2>
            <button class="add-button" onclick="window.location.href='formItem.php'">
                <i class='bx bx-plus'></i> Adicionar Equipamento
            </button>
        </div>

        <table class="container">
            <thead>
                <tr>
                    <th>
                        <h1>Equipamento</h1>
                    </th>
                    <th>
                        <h1>Localização</h1>
                    </th>
                    <th>
                        <h1>Nome do Cliente</h1>
                    </th>
                    <th>
                        <h1>Ultima Movimentação</h1>
                    </th>
                    <th>
                        <h1>Serial</h1>
                    </th>
                    <th>
                        <h1>Status</h1>
                    </th>
                    <th>
                        <h1>Ações</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) :
                ?>
                    <?php
                    if (empty($item)) : ?>
                        <tr>
                            <td colspan="8">Inserir Registro</td>
                        </tr>
                    <?php else :
                        $itemId = $item->getId();
                        $editUrl = "formItem.php?id=$itemId";
                    ?>
                        <tr data-id="<?= $itemId ?>">
                            <td><?= $item->getItemName() ?></td>
                            <td><?= $item->getLocation() ?></td>
                            <td><?= $item->getClientName() ?></td>
                            <td><?= $item->getLastMovement() ?></td>
                            <td><?= $item->getSerialNumber() ?></td>
                            <td><?= ($item->getStatus() == 1) ? 'Ativo' : (($item->getStatus() == 2) ? 'Inativo' : 'Manutenção') ?></td>
                            <td class="actions-cell">
                                <button onclick="window.location.href='<?= $editUrl; ?>'" class="edit-button">Editar</button>
                                <button class="remove-button" onclick="remove(<?= $item->getId(); ?>, '../app/controllers/removeItemController.php', 'item')">Remover</button>
                            </td>
                        </tr>
                <?php
                    endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</section>