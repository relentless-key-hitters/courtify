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

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />


  <style>
    body {
      overflow-x: hidden;
    }

    #tabela2.dataTables_wrapper,
    #tabela.dataTables_wrapper {
      padding: 10px;
    }

    #tabela2_wrapper .dataTables_filter input,
    #tabela_wrapper .dataTables_filter input {
      width: 250px;
      margin-bottom: 10px;
    }

    #tabela2_length select,
    #tabela_length select {
      margin-bottom: 10px;
    }


    #tabela2.dataTable thead th,
    #tabela.dataTable thead th {
      text-align: center;
      font-weight: 600;
    }


    #tabela2.dataTables tbody tr:nth-child(odd),
    #tabela.dataTables tbody tr:nth-child(odd) {
      background-color: #e6e6e6;
      text-align: center;
    }


    #tabela2.dataTables tbody tr.selected,
    #tabela.dataTables tbody tr.selected {
      background-color: #c7d4e8;
      text-align: center;
    }



    #tabela2_paginate .paginate_button.current,
    #tabela_paginate .paginate_button.current {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }

    #tabela2_paginate .paginate_button.hover,
    #tabela_paginate .paginate_button:hover {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }


    #tabela2_paginate .paginate_button.next:hover,
    #tabela2_paginate .paginate_button.previous.hover,
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
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo" width="180" alt="" />
            <img src="../../dist/images/logos/logo_courtify.png" class="light-logo" width="180" alt="" />
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
              <a class="sidebar-link fs-4" href="./calendario_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendário</span>
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
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
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
              <a class="sidebar-link fs-4" href="./historico_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Histórico</span>
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
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
          <div class="hstack gap-3">
            <div class="john-img">
              <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
            </div>
            <div class="john-title">
              <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
              <span class="fs-2 text-dark">Designer</span>
            </div>
            <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout"
              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
              <i class="ti ti-power fs-6"></i>
            </button>
          </div>
        </div>
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
            <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-9">Equipas</h1>
          </div>
        </div>

      </div>
    </div>

    <div class="col-lg-2"></div>
  </div>



  <div class="row">
    <div class="col-lg-3"></div>


    <div class="col-lg-7">
      <div class="badge-container2">
        <div class="row mb-5">
          <div class="container mt-5">
            <table class="table" id="tabelaEquipa">
              <thead>
                <tr class="text-center">
                  <th scope="col">ID</th>
                  <th scope="col">Logo</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Ranking</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>

                </tr>
              </thead>
              <tbody id="listaEquipa">
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
      <h2 class="text-muted fs-5">Criar Equipa <button data-toggle="modal" data-target="#teamModal" type="button"
          class="btn btn-sm fs-4 btn-success"><i class="ti ti-circle-plus"></i></button></h2>
    </div>
  </div>


  <div class="modal modal-lg fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-7" id="teamModalLabel">Criar Equipa</h5>
          <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
            aria-label="Close">
            <span> <i class="ti ti-x text-white"></i></span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-5 pt-4">
              <div class="form-group">
                <label for="nomeEq">Nome</label>
                <input type="text" class="form-control" id="nomeEq">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="imagemEq">Imagem</label>
                <input type="file" class="form-control" id="imagemEq" accept="image/*">
                <small class="form-text text-muted">Selecione uma imagem para a equipa</small>
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="modEq">Modalidade</label>
                <select class="form-select" id="modEq">
                  <option class="text-muted" value="" selected disabled>Escolha a modalidade</option>
                  <option value="3">Padel</option>
                  <option value="4">Ténis</option>
                  <option value="1">Basquetebol</option>
                  <option value="2">Futsal</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 pt-4">
              <label for="descEq">Descrição</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <textarea id="descEq" cols="6" rows="3" class="form-control"></textarea>
            </div>
          </div>

          <div class="col-md-4 pt-4">
            <div class="form-group">
              <label for="rankEq">Ranking</label>
              <select class="form-select" id="rankEq">
                <option class="text-muted" value="" selected disabled>Escolha o ranking da equipa</option>
                <option value="sc">Sem Classificação</option>
                <option value="n5">N5</option>
                <option value="n4">N4</option>
                <option value="n3">N3</option>
                <option value="n2">N2</option>
                <option value="n1">N1</option>
              </select>
            </div>
          </div>

          <div class="col-md-4 pt-4">
            <div class="form-group">
              <label for="estadoEq">Estado</label>
              <select class="form-select" id="estadoEq">
                <option class="text-muted" value="" selected disabled>Escolha o estado da equipa</option>
                <option value="aberto">Aberto</option>
                <option value="fechado">Fechado</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>

  <div class="modal modal-lg fade" id="teamEditModal" tabindex="-1" role="dialog" aria-labelledby="teamEditModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-7" id="teamEditModalLabel">Editar Equipa</h5>
        <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
          aria-label="Close">
          <span> <i class="ti ti-x text-white"></i></span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">

          <div class="col-md-5 pt-4">
            <div class="form-group">
              <label for="idEq">ID</label>
              <input type="text" class="form-control" id="idEq">
            </div>
          </div>

          <div class="col-md-5 pt-4">
            <div class="form-group">
              <label for="nomeEq">Nome</label>
              <input type="text" class="form-control" id="nomeEq">
            </div>
          </div>

          <div class="col-md-4 pt-4">
            <div class="form-group">
              <label for="imagemEq">Imagem</label>
              <input type="file" class="form-control" id="imagemEq" accept="image/*">
              <small class="form-text text-muted">Selecione uma imagem para a equipa</small>
            </div>
          </div>

          <div class="col-md-4 pt-4">
            <div class="form-group">
              <label for="modEq">Modalidade</label>
              <select class="form-select" id="modEq">
                <option class="text-muted" value="" selected disabled>Escolha a modalidade</option>
                <option value="sc">Padel</option>
                <option value="n5">Ténis</option>
                <option value="n4">Basquetebol</option>
                <option value="n3">Futsal</option>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-2 pt-4">
            <label for="descEq">Descrição</label>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <textarea id="descEq" cols="6" rows="3" class="form-control"></textarea>
          </div>
        </div>

        <div class="col-md-4 pt-4">
          <div class="form-group">
            <label for="rankEq">Ranking</label>
            <select class="form-select" id="rankEq">
              <option class="text-muted" value="" selected disabled>Escolha o ranking da equipa</option>
              <option value="sc">Sem Classificação</option>
              <option value="n5">N5</option>
              <option value="n4">N4</option>
              <option value="n3">N3</option>
              <option value="n2">N2</option>
              <option value="n1">N1</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 pt-4">
          <div class="form-group">
            <label for="estadoEq">Estado</label>
            <select class="form-select" id="estadoEq">
              <option class="text-muted" value="" selected disabled>Escolha o estado da equipa</option>
              <option value="sc">Aberto</option>
              <option value="n5">Fechado</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-success">Guardar</button>
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

  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>
  <script src="../../dist/js/custom.js"></script>
  <script src="../../dist/js/js_courtify/equipa.js"></script>



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

    $(document).ready(function () {
      $('#tabela2').DataTable({
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
          "sSearch": "Pesquisar (data, hora, etc...)",
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
  header("Location: authentication-error.html");
  exit();
}


?>