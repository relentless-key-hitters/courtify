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

  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../dist/js/js_courtify/clube/torneio.js"></script>

  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />




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

  <style>
    body {
      overflow-x: hidden;
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
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./reserva_dash.php" aria-expanded="false">
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
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
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
            <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-9">Torneios</h1>
          </div>
        </div>

        <div class="row mb-5">
          <div class="container mt-5">
            <table class="table" id="tabelaTorneio">
              <thead>
                <tr class="text-center">
                  <th scope="col">ID</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Nível</th>
                  <th scope="col">Gênero</th>
                  <th scope="col">Data</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Entradas</th>
                  <th scope="col">Preço(por pax)</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Cancelar</th>
                </tr>
              </thead>
              <tbody id="listaTorneio">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>


  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6"></div>
    <div class="col-lg-3">
      <h2 class="text-muted fs-5">Criar Torneio <button data-toggle="modal" data-target="#tournamentModal" type="button"
          class="btn btn-sm fs-4 btn-success"><i class="ti ti-circle-plus text-white"></i></button></h2>
    </div>
  </div>


  <div class="modal modal-lg fade" id="tournamentModal" tabindex="-1" role="dialog"
    aria-labelledby="tournamentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-7" id="tournamentModalLabel">Criar Torneio</h5>
          <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
            aria-label="Close">
            <span> <i class="ti ti-x text-white"></i></span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-7 pt-4">
              <div class="form-group">
                <label for="trDesc">Nome</label>
                <input type="text" class="form-control" id="trDesc" placeholder="Digite o nome do torneio">
              </div>
            </div>

            <div class="col-md-5 pt-4">
              <div class="form-group">
                <label for="trImagem">Imagem</label>
                <input type="file" class="form-control" id="trImagem" accept="image/*">
                <small class="form-text text-muted">Selecione uma imagem para o torneio</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNmr">Nº Máx participantes</label>
                <input type="text" class="form-control" id="trNmr" placeholder="Digite o nº máx participantes">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNivel">Nível</label>
                <select name="nivel" class="form-select" id="trNivel">
                  <option class="text-muted" value="" selected disabled>Escolha o nível</option>
                  <option value="Principiante">Principiante</option>
                  <option value="Intermediário">Intermediário</option>
                  <option value="Avançado">Avançado</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trGen">Gênero</label>
                <select name="nivel" class="form-select" id="trGen">
                  <option class="text-muted" value="" selected disabled>Escolha o gênero</option>
                  <option value="genM;">Masculino</option>
                  <option value="genF">Feminino</option>
                  <option value="genMisto">Misto</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" class="form-control" id="trData">
              </div>
            </div>


            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trHora">Hora:</label>
                <input type="time" class="form-control" id="trHora">
              </div>
            </div>

            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trPreco">Preço:</label>
                <input type="text" class="form-control" id="trPreco" placeholder="Digite o preço">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 pt-4">
              <label for="trObs">Observações</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <textarea id="trObs" cols="6" rows="3" class="form-control"></textarea>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="regTorneio()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal modal-lg fade" id="trEditModal" tabindex="-1" role="dialog" aria-labelledby="trEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-7" id="trEditModalLabel">Editar Torneio</h5>
          <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
            aria-label="Close">
            <span> <i class="ti ti-x text-white"></i></span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="idEditTour">ID</label>
                <input type="number" disabled class="form-control" id="idEditTour">
              </div>
            </div>

            <div class="col-md-8 pt-4">
              <div class="form-group">
                <label for="nomeEditTour">Nome</label>
                <input type="text" class="form-control" id="descEditTour">
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 pt-4">
                <div class="form-group">
                  <label for="nivelEditTour">Nível</label>
                  <select name="nivel" class="form-select" id="nivelEditTour">
                    <option class="text-muted" value="" selected disabled>Escolha o nível</option>
                    <option value="Principiante">Principiante</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4 pt-4">
                <div class="form-group">
                  <label for="genEditTour">Gênero</label>
                  <select name="genEditTour" class="form-select" id="genEditTour">
                    <option class="text-muted" value="" selected disabled>Escolha o gênero</option>
                    <option value="genM;">Masculino</option>
                    <option value="genF">Feminino</option>
                    <option value="genMisto">Misto</option>
                  </select>
                </div>
              </div>

              <div class="col-md-3 pt-4">
                <div class="form-group">
                  <label for="dataEditTour">Data</label>
                  <input type="date" class="form-control" id="dataEditTour">
                </div>
              </div>

              <div class="col-md-3 pt-4">
                <div class="form-group">
                  <label for="timeEditTour">Hora</label>
                  <input type="time" class="form-control" id="horaEditTour">
                </div>
              </div>

              <div class="col-md-3 pt-4">
                <div class="form-group">
                  <label for="precoEditTour">Preço</label>
                  <input type="number" class="form-control" id="precoEditTour">
                </div>
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="estadoEditTour">Estado</label>
                <select name="genEditTour" class="form-select" id="estadoEditTour">
                  <option class="text-muted" value="" selected disabled>Escolha o estado do Torneio</option>
                  <option value="c">Concluído</option>
                  <option value="nc">Não concluído</option>
                </select>
              </div>
            </div>

            <div class="col-md-5 pt-4">
              <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagemEditTour" accept="image/*">
                <small class="form-text text-muted">Selecione uma imagem para o torneio</small>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2 pt-4">
                <label for="obsEditTour">Observações</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <textarea id="obsEditTour" cols="6" rows="3" class="form-control"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-success">Guardar</button>
            </div>
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
  <!--  Shopping Cart -->





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
          "sSearch": "Pesquisar (nome, nível, etc...)",
          "oPaginate": {
            "sNext": "Próximo",
            "sNext": ">",
            "sPrevious": "<",
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