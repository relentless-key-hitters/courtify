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

  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

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
              <a class="sidebar-link fs-4 link-active" href="./visao_dash.php" aria-expanded="false">
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
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4" href="#" aria-expanded="false">
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
        <div class="col-lg-2">

        </div>
        <div class="col-lg-10">
          <div class="container">
            <div>
              <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 65px" id="nomeClube"></h1>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>



  <div class="row pe-5">
    <div class="col-lg-2">

    </div>
    <div class="col-lg-10">
      <div class="container">
        <div class="row mt-3">
          <div class="col-lg-12 mb-4">
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
              <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                  <div class="col-9">
                    <h3 class="fw-semibold mb-8"><i class="ti ti-settings me-2"></i>Definições</h3>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="./visao_dash.php">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Definições</li>
                      </ol>
                    </nav>
                  </div>
                  <div class="col-3">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card shadow w-100 position-relative overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Fotografia</h5>
                <p class="card-subtitle mb-4">Altere aqui a sua fotografia identificativa.</p>
                <div class="text-center">
                  <img id="fotoClubeEditCurrent" alt="" class="img-fluid rounded" width="420"
                    height="220">
                </div>
                <input class="form-control mt-5" type="file" id="fotoClubeEditNova" name="fotoClubeEditNova">
              </div>
              <div class="d-flex align-items-center justify-content-center mb-4 gap-3">
                <button type="button" class="btn btn-primary" onclick="alterarFotoClube()">Guardar</button>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card shadow w-100 position-relative overflow-hidden">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Password</h5>
                <p class="card-subtitle mb-4">Altere aqui a sua password. Se não quiser alterar, deixe em
                  branco.</p>
                <form>
                  <div class="mb-4 mb-md-5">
                    <label for="passwordAtualClubeEdit" class="form-label fw-semibold">Password Atual</label>
                    <input type="password" class="form-control" id="passwordAtualClubeEdit" value="">
                  </div>
                  <div class="mb-4 mb-md-5">
                    <label for="passwordNovaClubeEdit" class="form-label fw-semibold">Nova Password</label>
                    <input type="password" class="form-control" id="passwordNovaClubeEdit" value="">
                  </div>
                  <div class="">
                    <label for="passwordNovaClubeEdit2" class="form-label fw-semibold">Confirmar Password</label>
                    <input type="password" class="form-control" id="passwordNovaClubeEdit2" value="">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card shadow w-100 position-relative overflow-hidden ">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Detalhes Pessoais</h5>
                <p class="card-subtitle mb-4">Altere aqui a sua informação pessoal</p>
                <form>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <label for="nomeClubeEdit" class="form-label fw-semibold">Nome Completo</label>
                        <input type="text" class="form-control" id="nomeClubeEdit" >
                      </div>
                      <div class="mb-4">
                        <label for="distritoEdit" class="form-label fw-semibold">Distrito</label>
                        <select class="form-select" aria-label=""
                           id="distritoClubeEdit">
                        </select>
                      </div>
                      <div class="mb-4">
                        <label for="emailClubeEdit" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" id="emailClubeEdit">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-4">
                        <div class="row">
                          <div class="col-4">
                            <label for="nifClubeEdit" class="form-label fw-semibold">NIF</label>
                            <input type="number" class="form-control" id="nifClubeEdit">
                          </div>
                          <div class="col-4">
                            <label for="cpClubeEdit" class="form-label fw-semibold">Código-Postal</label>
                            <input type="text" class="form-control" id="cpClubeEdit">
                          </div>
                          <div class="col-4">
                            <label for="anoFundacaoClubeEdit" class="form-label fw-semibold">Ano Fundação</label>
                            <input type="number" class="form-control" id="anoFundacaoClubeEdit">
                          </div>
                        </div>
                      </div>
                      <div class="mb-4">
                        <label for="concelhoClubeEdit" class="form-label fw-semibold">Concelho</label>
                        <select class="form-select" aria-label="Default select example" id="concelhoClubeEdit">
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="mb-4">
                            <label for="telemovelClubeEdit" class="form-label fw-semibold">Telemóvel</label>
                            <input type="text" class="form-control" id="telemovelClubeEdit">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="mb-4">
                            <label for="telefoneClubeEdit" class="form-label fw-semibold">Telefone</label>
                              <input type="text" class="form-control" id="telefoneClubeEdit">
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-4">
                        <label for="moradaClubeEdit" class="form-label fw-semibold">Morada</label>
                        <input type="text" class="form-control" id="moradaClubeEdit">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="">
                        <label for="descricaoClubeEdit" class="form-label fw-semibold">Descrição</label>
                        <textarea class="form-control" id="descricaoClubeEdit" rows ='7'></textarea>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card shadow w-100 position-relative overflow-hidden ">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Horários</h5>
                <p class="card-subtitle mb-4">Configure aqui o seu horário semanal.</p>
                <div class="container">
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Segunda-Feira:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaSegunda">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoSegunda">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Terça-Feira:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaTerca">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoTerca">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Quarta-Feira:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaQuarta">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoQuarta">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Quinta-Feira:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaQuinta">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoQuinta">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Sexta-Feira:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaSexta">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoSexta">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Sábado:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaSabado">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoSabado">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3">

                          </div>
                          <div class="col-3 text-center">
                            <span class="fw-bold fs-3">Abertura</span>
                          </div>
                          <div class="col-3 text-center">
                          <span class="fw-bold fs-3">Fecho</span>
                          </div>
                          <div class="col-3">
                            
                          </div>  
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-3 mt-2">
                            <div class="d-flex justify-content-center align-items-end">
                              <span class="fw-bolder fs-4">Domingo:</span>
                            </div>
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="aberturaDomingo">
                          </div>
                          <div class="col-3 text-center">
                            <input type="time" class="form-control" id="fechoDomingo">
                          </div>
                          <div class="col-3 mt-2">
                            <input type="checkbox" class="form-check-input me-2">
                            <span class="fs-3">Fechado</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                <button type="button" class="btn btn-primary"
                  onclick="guardarEditClube()">Salvar</button>
              </div>
            </div>
        </div>
      </div>


    </div>
  </div>

  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-10">
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
  <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="../../dist/js/js_courtify/definicoesClube.js"></script>
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