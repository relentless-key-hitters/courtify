<?php 
session_start();

if (isset($_SESSION['id'])) {?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!--  Title -->
  <title>Courtify</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Mordenize" />
  <meta name="author" content="" />
  <meta name="keywords" content="Courtify" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/logo_icone.png" />
  <!-- Owl Carousel  -->

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">
  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese.json"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">


  <style>
    body {
      overflow-x: hidden;
    }

    #tabela.dataTables_wrapper {
      padding: 10px;
    }

    #tabela_wrapper .dataTables_filter input {
      width: 250px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    #tabela_length select {
      margin-bottom: 10px;
      border-radius: 5px;
    }


    #tabela.dataTable thead th {
      text-align: center;
      font-weight: 600;
    }


    #tabela.dataTables tbody tr:nth-child(odd) {
      background-color: #e6e6e6;
      text-align: center;
    }


    #tabela.dataTables tbody tr.selected {
      background-color: #c7d4e8;
      text-align: center;
    }



    #tabela_paginate .paginate_button.current {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }

    #tabela_paginate .paginate_button:hover {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }


    #tabela_paginate .paginate_button.previous.hover,
    #tabela_paginate .paginate_button.next:hover,
    #tabela_paginate .paginate_button:hover {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }
  </style>

</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="mt-2 d-flex align-items-center justify-content-center">
          <a href="./visao_dash.php" class="text-nowrap d-none d-xl-block">
            <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo img-fluid" width="180" alt="" />
          </a>

          
          <a href="./visao_dash.php" class="text-nowrap d-block d-xl-none">
            <img src="../../dist/images/logos/favicon_svg.svg" class="dark-logo img-fluid" width="60" alt="" />
          </a>

          <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8 text-muted"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <!-- ============================= -->
            <!-- Home -->
            <!-- ============================= -->
            <!-- =================== -->
            <!-- Dashboard -->
            <!-- =================== -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu fs-6">Dashboard</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./visao_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Visão Geral</span>
              </a>
            </li>
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-file-invoice"></i>
                </span>
                <span class="hide-menu">Reservas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./campos_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-soccer-field"></i>
                </span>
                <span class="hide-menu">Campos</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./membros_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Membros</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./equipas_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-shirt-sport"></i>
                </span>
                <span class="hide-menu">Equipas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./torneios_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-tournament"></i>
                </span>
                <span class="hide-menu">Torneios</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./pagamentos_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-report-money"></i>
                </span>
                <span class="hide-menu">Pagamentos</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./definicoes_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Definições</span>
              </a>
            </li>
            <li class="sidebar-item mt-4">
              <a class="sidebar-link fs-4" style="background-color: #45702d; color: white; cursor: pointer;" onclick="logout()" aria-expanded="false">
                <span>
                  <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
  </div>

  <div class="body-wrapper">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-6" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 65px">
            Clube de Padel de Évora</h1>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>



  <div class="row">
    <div class="col-lg-3">

    </div>

    <div class="col-lg-7">
      <div class="badge-container2">
        <div class="row mb-0 mt-5">
          <div class="col-12 text-center">
            <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-9">Reservas</h1>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-2"></div>

    <div class="col-lg-3"></div>
    <div class="col-lg-7">
      <div class="row mb-5">
        <div class="container mt-5">
          <table class="table text-center" id="tabela">
            <thead>
              <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Membro</th>
                <th scope="col">Dia</th>
                <th scope="col">Hora</th>
                <th scope="col">Campo</th>
                <th scope="col">Preço</th>
                <th scope="col">Pagamento</th>
                <th scope="col">Editar</th>
                <th scope="col">Cancelar</th>
              </tr>
            </thead>
            <tbody>

              <tr class="text-center">
                <td>000919</td>
                <td>Pedro Barros</td>
                <td>2024-02-18</td>
                <td>10:30</td>
                <td>P2</td>
                <td>20.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000920</td>
                <td>Rui Silva</td>
                <td>2024-02-18</td>
                <td>16:30</td>
                <td>P7</td>
                <td>25.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000921</td>
                <td>António Silva</td>
                <td>2024-02-18</td>
                <td>19:30</td>
                <td>P4</td>
                <td>30.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>
              <!-- Row 2 -->
              <tr class="text-center">
                <td>000922</td>
                <td>Ana Teixeira</td>
                <td>2024-02-18</td>
                <td>19:30</td>
                <td>P2</td>
                <td>30.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000923</td>
                <td>João Fonseca</td>
                <td>2024-02-19</td>
                <td>19:30</td>
                <td>P1</td>
                <td>30.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>
              <!-- Row 2 -->
              <tr class="text-center">
                <td>000924</td>
                <td>Clara Silva</td>
                <td>2024-02-19</td>
                <td>19:30</td>
                <td>P3</td>
                <td>30.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000925</td>
                <td>Félix Cunha</td>
                <td>2024-02-19</td>
                <td>21:30</td>
                <td>P8</td>
                <td>30.00</td>
                <td>Pendente <i class="ti ti-alert-circle-filled" style="color: firebrick;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>
              <!-- Row 2 -->
              <tr class="text-center">
                <td>000926</td>
                <td>Sandra Torres</td>
                <td>2024-02-19</td>
                <td>21:30</td>
                <td>P1</td>
                <td>30.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000927</td>
                <td>Fábio Costello</td>
                <td>2024-02-20</td>
                <td>09:30</td>
                <td>P6</td>
                <td>20.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>
              <!-- Row 2 -->
              <tr class="text-center">
                <td>000928</td>
                <td>Tiago André</td>
                <td>2024-02-20</td>
                <td>17:30</td>
                <td>P5</td>
                <td>20.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000929</td>
                <td>Liliana Barros</td>
                <td>2024-02-20</td>
                <td>18:30</td>
                <td>P8</td>
                <td>20.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>
              <!-- Row 2 -->
              <tr class="text-center">
                <td>000930</td>
                <td>Filipe Serra</td>
                <td>2024-02-20</td>
                <td>19:30</td>
                <td>P4</td>
                <td>25.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>000931</td>
                <td>Joaquim Pereira</td>
                <td>2024-02-20</td>
                <td>19:30</td>
                <td>P7</td>
                <td>25.00</td>
                <td>Efetuado <i class="ti ti-circle-check" style="color: forestgreen;"></i></td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editReservaModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>


  <div class="modal modal-lg fade" id="editReservaModal" tabindex="-1" role="dialog"
    aria-labelledby="editReservaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-7" id="editReservaModalLabel">Editar Reserva</h5>
          <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
            aria-label="Close">
            <span> <i class="ti ti-x text-white"></i></span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="idEditRes">ID</label>
                <input type="number" disabled class="form-control" id="idEditRes">
              </div>
            </div>

            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="dataEditRes">Data</label>
                <input type="date" class="form-control" id="dataEditRes">
              </div>
            </div>

            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="HoraEditRes">Hora</label>
                <input type="time" class="form-control" id="HoraEditRes">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="campoEditRes">Campo</label>
                <select name="nivel" class="form-select" id="campoEditRes">
                  <option class="text-muted" value="" selected disabled>Escolha o campo</option>
                  <option value="editP1">P1</option>
                  <option value="editP2">P2</option>
                  <option value="editP3">P3</option>
                  <option value="editP4">P4</option>
                  <option value="editP5">P5</option>
                  <option value="editP6">P6</option>
                  <option value="editP7">P7</option>
                  <option value="editP8">P8</option>
                </select>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-2 pt-4">
              <label for="obsEditRes">Observações</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <textarea id="obsEditRes" cols="6" rows="3" class="form-control"></textarea>
            </div>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-success">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-9">
      <div style="margin-left: 60px; margin-right: 60px;">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">Copyright © 2023 Courtify</p>

          <a href="#"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <img src="../../../landingpage/dist/images/logos/logo_icone.png" width="50">
          </a>
          <div>
            <p class="mb-0 text-muted">Todos os direitos reservados.</p>
          </div>

        </footer>
      </div>
    </div>
    <div class="col-lg-1"></div>
  </div>




  


  <!--  Import Js Files -->
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>
  <script src="../../dist/js/custom.js"></script>
  <!--  current page js files -->

  <script src="../../dist/js/js_courtify/clube/clubeLogout.js"></script>
    <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#tabela').DataTable({
        responsive: true,
        ordering: false,
        "language": {
          "sEmptyTable": "Nenhum registo encontrado",
          "sInfo": "Mostrando _END_ de _TOTAL_ registos",
          "sInfoEmpty": "Mostrando 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registo encontrado",
          "sSearch": "Pesquisar (nome, dia, hora, etc...)",
          "oPaginate": {
            "sNext": ">",
            "sPrevious": "<",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
            "rows": {
              "_": "Selecionado %d linhas",
              "0": "Nenhuma linha selecionada",
              "1": "Selecionado 1 linha"
            }
          }
        }
      });
    });
  </script>


</body>

</html>
<?php
} else {
  header("Location: ../horizontal/authentication-error.html");
  exit();
}


?>