<?php
require_once('../vendor/autoload.php');
require_once(__DIR__ . '/base.php');

use app\classes\Item;

$equipments = new Item();
?>

<head>
    <link rel="stylesheet" href="assets/css/table.css">
    <link rel="stylesheet" href="assets/css/general_containers.css">
    <title>RadioLoc | Visualizar Equipamentos</title>
</head>


<section class="home-section">
    <div class="container-search">
        <h2 class="search-text">Buscar Equipamentos</h2>
    </div>

    <div class="container-table">
        <h2 class="title-table">Visualizar Equipamentos</h2>
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
                        <h1>Ações</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipments as $equipment) :
                    if (empty($equipment)) : ?>
                        <tr>
                            <td colspan="5">Inserir Registro</td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td><?= $equipment->getItemName() ?></td>
                            <td><?= $equipment->getLocation() ?></td>
                            <td><?= $equipment->getItemName() ?></td>
                            <td>01:<?= $equipment->getItemName() ?>:50</td>
                            <td class="actions-cell">
                                <button class="edit-button">Editar</button>
                                <button class="remove-button">Remover</button>
                            </td>
                        </tr>
                <?php
                    endif;
                endforeach; ?>
            </tbody>

        </table>
    </div>
</section>