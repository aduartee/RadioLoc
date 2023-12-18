<?php
require_once(__DIR__ . '/base.php');
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
                        <h1>Ações</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Google</td>
                    <td>9518</td>
                    <td>6369</td>
                    <td>01:32:50</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
                <tr>
                    <td>Twitter</td>
                    <td>7326</td>
                    <td>10437</td>
                    <td>00:51:22</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
                <tr>
                    <td>Amazon</td>
                    <td>4162</td>
                    <td>5327</td>
                    <td>00:24:34</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
                <tr>
                    <td>LinkedIn</td>
                    <td>3654</td>
                    <td>2961</td>
                    <td>00:12:10</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
                <tr>
                    <td>CodePen</td>
                    <td>2002</td>
                    <td>4135</td>
                    <td>00:46:19</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
                <tr>
                    <td>GitHub</td>
                    <td>4623</td>
                    <td>3486</td>
                    <td>00:31:52</td>
                    <td class="actions-cell">
                        <button class="edit-button">Editar</button>
                        <button class="remove-button">Remover</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>