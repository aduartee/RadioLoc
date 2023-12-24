<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\database\ItemModel;

$itemsModel = new ItemModel();
$items = $itemsModel->getAllItems();
?>

<head>
    <title>RadioLoc | Visualizar Equipamentos</title>
    <script src="assets/js/toast.js"></script>
</head>

<section class="home-section">
    <div class="container-search">
        <h2 class="search-text">Buscar Equipamentos</h2>
    </div>

    <div class="container-table">
        <h2 class="title-table">Visualizar Equipamentos</h2>
        <button class="add-button" onclick="window.location.href='formItem.php'">
            <i class='bx bx-plus'></i> Adicionar Equipamento
        </button>

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
                    <?php else : ?>
                        <tr>
                            <td><?= $item->getItemName() ?></td>
                            <td><?= $item->getLocation() ?></td>
                            <td><?= $item->getClientName() ?></td>
                            <td><?= $item->getLastMovement() ?></td>
                            <td><?= $item->getSerialNumber() ?></td>
                            <td><?= ($item->getStatus() == 1) ? 'Ativo' : (($item->getStatus() == 2) ? 'Inativo' : 'Manutenção') ?></td>
                            <td class="actions-cell">
                                <button href="#" class="edit-button">Editar</button>
                                <button href="#" class="remove-button">Remover</button>
                            </td>
                        </tr>
                <?php
                    endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</section>