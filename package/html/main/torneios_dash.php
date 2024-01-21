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


  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />




  <!--<style>
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
  </style>-->

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
    <div class="row pe-5 mb-3">
        <div class="col-lg-3">

        </div>
        <div class="col-lg-7">
          <div class="container">
            <div>
              <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 65px" id="nomeClube"></h1>
            </div>
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
        <div class="row mb-4 mt-3">
          <div class="col-lg-12">
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
              <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                  <div class="col-9">
                    <h3 class="fw-semibold mb-8"><i class="ti ti-tournament me-2"></i>Torneios</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="./visao_dash.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Torneios</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-3">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card shadow">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="me-2 mt-1">
              <h1 class="mb-2 fw-semibold fs-9 card-title me-auto">Os seus Torneios</h1>
              <button class="btn btn-primary btn-sm" style="height: 40px;" data-toggle='tooltip' data-placement='top' title='Adicione um novo Torneio' data-bs-toggle="modal" data-bs-target="#tournamentModal"><i class=" ti ti-plus me-2"></i>Novo Torneio</button>
            </div>
            <span class="card-subtitle">Consulte e administre informação sobre os seus torneios nesta tabela.</span>
            <div class="card-text">
              <div class="row">
                <div class="container mt-5">
                  <table class="table" id="tabelaTorneio">
                    <thead>
                      <tr class="">
                        <th scope="col">ID</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Gênero</th>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Nº Entradas</th>
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


  <div class="modal modal-lg fade" id="tournamentModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class='d-flex'>
            <img src='../../dist/images/logos/favicon.ico' alt='' height='40' width='40' class='mt-2 ms-2'>
            <h1 class='mb-0 mt-2 ms-2 fs-6 p-1' id='teamModalLabel'>Novo Torneio</h1>
          </div>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img src="../../dist/images/backgrounds/demonclass.png" class="d-none w-25 img-fluid" id="trImgElem" alt="Imagem">
          </div>

          <div class="row">
            <div class="col-md-7 pt-4">
              <div class="form-group">
                <label for="trDesc" class="form-label">Nome</label>
                <input type="text" class="form-control" id="trDesc" placeholder="Digite o nome do torneio" >
              </div>
            </div>

            <div class="col-md-5 pt-4">
              <div class="form-group">
                <label for="trImagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="trImagem" accept="image/*" onchange="previewImagemNovoTorneio()">
                <small class="form-text text-muted">Selecione uma imagem para o torneio</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNmr" class="form-label">Nº Máx participantes</label>
                <input type="text" class="form-control" id="trNmr" placeholder="Digite o nº máx participantes">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNivel" class="form-label">Nível</label>
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
                <label for="trGen" class="form-label">Gênero</label>
                <select name="nivel" class="form-select" id="trGen">
                  <option class="text-muted" value="" selected disabled>Escolha o gênero</option>
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                  <option value="misto">Misto</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="data" class="form-label">Data:</label>
                <input type="date" class="form-control" id="trData">
              </div>
            </div>


            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trHora" class="form-label">Hora:</label>
                <input type="time" class="form-control" id="trHora">
              </div>
            </div>

            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trPreco" class="form-label">Preço:</label>
                <input type="text" class="form-control" id="trPreco" placeholder="Digite o preço">
              </div>
            </div>
            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trModalidade" class="form-label">Modalidade:</label>
                <select name="modalidade" class="form-select" id="trModalidade">

                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 pt-4">
              <label for="trObs" class="form-label">Observações</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <textarea id="trObs" cols="6" rows="3" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="regTorneio()">Registar</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="limparInput()">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  

  <div class="modal modal-lg fade" id="trEditModal" tabindex="-1" role="dialog" aria-labelledby="trEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class='d-flex'>
            <img src='../../dist/images/logos/favicon.ico' alt='' height='40' width='40' class='mt-2 ms-2'>
            <h1 class='mb-0 mt-2 ms-2 fs-6 p-1' id='teamModalLabel'>Editar Torneio</h1>
          </div>
          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Fechar'></button>
        </div>

        <div class="modal-body">
          <div class="text-center">
            <img class="w-25 img-fluid" id="trImgElemEdit" alt="Imagem">
          </div>
          
          <div class="row">
            <div class="col-md-7 pt-4">
              <div class="form-group">
                <label for="trDescEdit" class="form-label">Descrição:</label>
                <input type="text" class="form-control" id="trDescEdit" placeholder="Digite o nome do torneio" >
              </div>
            </div>

            <div class="col-md-5 pt-4">
              <div class="form-group">
                <label for="trImagemEdit" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="trImagemEdit" accept="image/*" onchange="previewImagemNovoTorneioEdit()">
                <small class="form-text text-muted">Selecione uma imagem para o torneio</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNmrEdit" class="form-label">Nº Máx participantes</label>
                <input type="text" class="form-control" id="trNmrEdit" placeholder="Digite o nº máx participantes">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trNivelEdit" class="form-label">Nível</label>
                <select name="nivel" class="form-select" id="trNivelEdit">
                  <option class="text-muted" value="" selected disabled>Escolha o nível</option>
                  <option value="Principiante">Principiante</option>
                  <option value="Intermediário">Intermediário</option>
                  <option value="Avançado">Avançado</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="trGenEdit" class="form-label">Gênero</label>
                <select name="gen" class="form-select" id="trGenEdit">
                  <option class="text-muted" value="" selected disabled>Escolha o gênero</option>
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                  <option value="misto">Misto</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trDataEdit" class="form-label">Data:</label>
                <input type="date" class="form-control" id="trDataEdit">
              </div>
            </div>


            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trHoraEdit" class="form-label">Hora:</label>
                <input type="time" class="form-control" id="trHoraEdit">
              </div>
            </div>

            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trPrecoEdit" class="form-label">Preço:</label>
                <input type="text" class="form-control" id="trPrecoEdit" placeholder="Digite o preço">
              </div>
            </div>
            <div class="col-md-3 pt-4">
              <div class="form-group">
                <label for="trModalidadeEdit" class="form-label">Modalidade:</label>
                <select name="modalidade" class="form-select" id="trModalidadeEdit">
                  <option class="text-muted" value="" selected disabled>Escolha a modalidade</option>
                  <option value="1">Basquetebol</option>
                  <option value="2">Futsal</option>
                  <option value="3">Padel</option>
                  <option value="4">Ténis</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 pt-4">
              <label for="trObsEdit" class="form-label">Observações</label>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <textarea id="trObsEdit" cols="6" rows="3" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="botaoGuardarEditTorneio">Guardar</button>
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!--  Import Js Files -->  
  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--  core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>
  <script src="../../dist/js/custom.js"></script>
  <!--  current page js files -->

  <script src="../../dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../../dist/js/js_courtify/clube/torneio.js"></script>
  <script src="../../dist/js/js_courtify/clube/clubeLogout.js"></script>
  <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>




</body>

</html>

<?php
} else {
  header("Location: ../horizontal/authentication-error.html");
  exit();
}


?>