<!doctype html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="assets/css/general.css">
  <link rel="stylesheet" href="assets/css/table.css">
  <link rel="stylesheet" href="assets/css/general_containers.css">
  <!-- FLATPICKR -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
  <!-- BOX-ICONS -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <!-- JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Sweet Alert -->
  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js "></script>
  <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css " rel="stylesheet">
  <!-- FLOWBITE   -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>


<body>
  <!-- MODAL EDIT/CREATE ITEM -->
  <div id="modal-item" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="titleModal"></h3>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-item">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <form id="form" class="p-4 md:p-5" action="../app/controllers/itemController.php" method="post" onsubmit="return processForm(this, '../app/controllers/itemController.php', 'index.php')">
          <input type="hidden" id="action" name="action" value="">
          <input type="hidden" id="formId" name="id" value="">
          <div class="grid gap-4 mb-4 grid-cols-2">
            <div class="col-span-2">
              <label for="itemName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Equipamento</label>
              <input type="text" name="itemName" id="itemName" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Radio Intelbras" required="">
            </div>
            <div class="col-span-2">
              <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localização</label>
              <input type="text" name="location" id="location" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Rua Alberto Bins" required="">
            </div>
            <div class="col-span-2">
              <label for="model" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Modelo do Equipamento</label>
              <input type="text" name="model" id="model" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Intelbras" required="">
            </div>
            <div class="col-span-2 sm:col-span-1">
              <label for="serialNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serial</label>
              <input type="text" name="serialNumber" id="serialNumber" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="RLP231232" required="">
            </div>
            <div class="col-span-2 sm:col-span-1">
              <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
              <select id="status" name="status" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option class="text-green-600" value="1">Ativo</option>
                <option class="text-orange-600" value="3">Manutenção</option>
                <option class="text-red-600" value="2">Inativo</option>
              </select>
            </div>
            <div class="col-span-2">
              <label for="lastMovement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ultima Movimentação</label>
              <input type="text" name="lastMovement" id="lastMovement" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="<?= date('d/m/Y') ?>" required="">
            </div>
            <div class="col-span-2">
              <label for="customerID" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Cliente</label>
              <select id="customerID" name="customerID" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option></option>
              </select>
            </div>
            <div class="col-span-2">
              <label for="additionalNotes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
              <textarea id="additionalNotes" name="additionalNotes" rows="4" class="block p-2.5 w-full empty text-sm text-gray-900 bg-gray-50 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escreva as observações sobre esse equipamento"></textarea>
            </div>
          </div>
          <button type="submit" class="text-white inline-flex ms-12 items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <svg class="me-1  w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
            </svg>
            Salvar Alterações
          </button>
        </form>
      </div>
    </div>
  </div>

  <body>
    <!-- MODAL ADD MOVEMENT -->
    <div id="modal-movement" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Nova Movimentação</h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-movement">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <form id="form" class="p-4 md:p-5" action="../app/controllers/itemController.php" method="post" onsubmit="return processForm(this, '../app/controllers/movementController.php', 'index.php')">
            <input type="hidden" id="idItem" name="idItem" value="">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="dateMovement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data da Movimentação</label>
                <input type="text" name="dateMovement" id="dateMovement" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="<?= date('d/m/Y') ?>" required="">
              </div>
              <div class="col-span-2">
                <label for="newLocation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nova Localização</label>
                <input type="text" name="newLocation" id="newLocation" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Apenas se ocorreu mudança na localização">
              </div>
            </div>
            <button type="submit" class="text-white inline-flex ms-12 items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
              <svg class="me-1  w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
              </svg>
              Salvar Alterações
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- MODAL EDIT/CREATE CUSTOMER -->
    <div id="modal-customer" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="titleCustomer"></h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-customer">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <form id="form" class="p-4 md:p-5" action="../app/controllers/customerController.php" method="post" onsubmit="return processForm(this, '../app/controllers/customerController.php', 'customers.php')">
            <input type="hidden" id="actionCustomer" name="action" value="">
            <input type="hidden" id="idCustomer" name="id" value="">
            <div class="grid gap-4 mb-4 grid-cols-2">
              <div class="col-span-2">
                <label for="customerName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Cliente</label>
                <input type="text" name="customerName" id="customerName" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cliente Y" required="">
              </div>
              <div class="col-span-2">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Endereço</label>
                <input type="text" name="address" id="address" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Rua Alberto Bins" required="">
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                <input type="text" name="phone" id="phone" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="(XX) XXXX-XXXX">
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status" class="bg-gray-50 empty text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  <option class="text-green-600" value="1">Ativo</option>
                  <option class="text-orange-600" value="3">Devedor</option>
                  <option class="text-red-600" value="2">Inativo</option>
                </select>
              </div>
            </div>
            <button type="submit" class="text-white inline-flex ms-12 items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
              <svg class="me-1  w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
              </svg>
              Salvar Alterações
            </button>
          </form>
        </div>
      </div>
    </div>

    <div id="list-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-dark rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
              Movimentações
            </h3>
            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="list-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <div class="p-4 md:p-5">
            <p class="text-white dark:text-gray-400 mb-4">Historico de Movimentaçãoes</p>
            <ul class="space-y-4 mb-4">
              <li>
                <input type="radio" id="job-1" name="job" value="job-1" class="hidden peer" required>
                <label for="job-1" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-gray border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                  <div class="block">
                    <div class="w-full text-lg font-semibold" id="infoDateMovement"></div>
                    <div class="w-full text-gray-500 dark:text-gray-400" id="infoNewLocation"></div>
                  </div>
                  <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                  </svg>
                </label>
              </li>
            </ul>
            <!-- <button class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Next step
            </button> -->
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar">
      <div class="logo-details">
        <div class="logo_name">RadioLoc</div>
        <i class='bx bx-menu' id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
          <a href="index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Página inicial</span>
          </a>
          <span class="tooltip">Página inicial</span>
        </li>
        <li>
          <a href="customers.php">
            <i class='bx bx-user'></i>
            <span class="links_name">Clientes</span>
          </a>
          <span class="tooltip">Clientes</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-chat'></i>
            <span class="links_name">Serviços</span>
          </a>
          <span class="tooltip">Serviços</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-folder'></i>
            <span class="links_name">Agenda</span>
          </a>
          <span class="tooltip">Agenda</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="links_name">Histórico</span>
          </a>
          <span class="tooltip">Histórico</span>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <script src="assets/js/base.js"></script>
      <!-- Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Tooltip -->
      <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
      <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
      <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/animations/scale.css" />
      <!-- TAILWIND -->
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- FLOWBITE -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
      <script src="assets/js/checkedAll.js"></script>
      <!-- AJAX REQUEST -->
      <script src="assets/js/modalAjax.js"></script>
      <!-- FLATPICKR -->
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script src="assets/js/datePicker.js"></script>
      <script src="assets/js/getIdBtn.js"></script>
  </body>

</html>