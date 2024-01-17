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
  <link rel="stylesheet" href="../../dist/libs/owl.carousel/dist/assets/owl.carousel.min.css">

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
          <!-- Show first image on col-md and up -->
          <a href="./visao_dash.php" class="text-nowrap d-none d-xl-block">
            <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo img-fluid" width="180" alt="" />
          </a>

          <!-- Show second image on col-md down -->
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
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
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
      <div class="col-lg-3">

      </div>
      <div class="col-lg-7" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 30px">
            Bem-Vindo,</h1>
        </div>
      </div>
      <div class="col-lg-2">

      </div>
    </div>

    <div class="row">
      <div class="col-lg-3">

      </div>
      <div class="col-lg-7" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder" style="letter-spacing: 1px; font-size: 65px" id="nomeClube">
            </h1>
        </div>
      </div>
      <div class="col-lg-2">

      </div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>



  <div class="row">
    <div class="col-lg-3">

    </div>

    <div class="col-lg-7">
      <div class="container-fluid pt-5">
        <div class="row">
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 bg-light overflow-hidden shadow">
              <div class="card-body position-relative">
                <p class="mb-2 fs-4 fw-semibold"><i class="fs-5 ti ti-currency-euro"></i> Ganhos</p>
                <div class="row pe-5">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <span class="fw-semibold fs-3">
                        <i class="ti ti-report-money me-1"></i>
                        Mês Atual (<?php
                          setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'Portuguese_Portugal.1252');
                          $month = strftime("%B");
                          echo mb_convert_case($month, MB_CASE_TITLE, "UTF-8");
                          ?>)
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <span class="fw-semibold fs-3">
                      <i class="ti ti-report-money me-1"></i>
                      Mês Anterior (<?php
                      setlocale(LC_TIME, 'pt_PT', 'pt_PT.utf-8', 'Portuguese_Portugal.1252');

                      $primDiaUltimoMes = strtotime("first day of last month");
                      $ultimoMesNome = strftime("%B", $primDiaUltimoMes);

                      // Capitalize the first letter
                      echo mb_convert_case($ultimoMesNome, MB_CASE_TITLE, "UTF-8");
                      ?>)
                      </span>
                    </div>
                  </div>
                </div>

                <div class="row pe-5">
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <div class="pe-4 border-muted border-opacity-10">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id="ganhosMesAtual"><i
                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                      <div class=" pe-4 border-muted border-opacity-10">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id= "ganhosMesAnterior"></h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body p-4">
                <p class="mb-1 fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-clipboard"></i> Marcações</p>
                <h4 class="fw-semibold" id="nReservas"><i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h4>
                <div id="sales" class="sales-chart"></div>
                <div class="container pt-3">
                  <a href="./reserva_dash.php"><button type="button"
                      class="btn btn-sm btn-light">Consultar</button></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body p-4">
                <p class="mb-1 fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-tournament"></i> Torneios </p>
                <h4 class="fw-semibold" id="nTorneios"><i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h4>
                <div id="expense"></div>
                <div class="container pt-3">
                  <a href="./torneios_dash.html"><button type="button"
                      class="btn btn-sm btn-light">Consultar</button></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
              <div id="grafico1"></div>
              <div class="d-flex align-items-end justify-content-between mt-7">
                <div>
                  <h4 class="mb-0 fw-semibold"><i class="ti ti-clipboard"></i> Marcações</h4>
                  <div class="mt-2">
                    <span class="fs-4 fw-bold">Últimos 5 meses</span>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
              <div id="grafico2"></div>
              <div class="d-flex align-items-end justify-content-between mt-7">
                <div>
                  <h4 class="mb-0 fw-semibold"><i class="ti ti-currency-euro"></i> Ganhos</h4>
                  <div class="mt-2">
                    <span class="fs-4 fw-bold">Últimos 5 meses</span>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card shadow">
              <div class="card-body">
                <div class="row alig n-items-start">
                  <div class="col-12">
                    <div class="d-flex justify-content-between">
                      <div class="div">
                        <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-soccer-field"></i> Campo mais usado</span>
                      </div>
                      <div class="div">
                        <?php echo date("Y"); ?>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="border-end pe-4 border-muted border-opacity-10">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id = "nomeCampo"><i
                            class="ti ti-arrow-up-right fs-5 lh-base text-danger"></i></h3>
                      </div>
                      <div class="ps-4">
                        <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center" id = "horasCampo"></h3>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <div class="pe-5">
                        <p class="mb-0 text-dark">Nome</p>
                      </div>
                      <div class="ps-5">
                        <p class="mb-0 text-dark">Nº horas</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow">
              <div class="card-body">
                <div class="row align-items-start">
                  <div class="col-12">
                    <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-credit-card-off"></i> Pagamentos Pendentes
                    </span>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <h4 class="fw-semibold mb-0 me-8 mt-2" id="nPend"></h4>
                      <a href="./pagamentos_dash.html"><button type="button"
                          class="btn btn-light mt-2">Consultar</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow">
              <div class="card-body">
                <div class="row alig n-items-start">
                  <div class="col-12">
                    <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-credit-card"></i> Pagamentos Efetuados 
                    </span>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <h4 class="fw-semibold mb-0 mt-2 me-8" id="nFeitos"></h4>
                      <a href="./pagamentos_dash.html"><button type="button"
                          class=" btn btn-light mt-2">Consultar</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
                <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-device-desktop-analytics"></i> Painel de Informação</span>
                <div class="row">
                  <div class="col-12 mt-1 mb-3">
                    <span class="fs-3 fw-bold"><i class="ti ti-clock"></i> Horários mais procurados:</span>
                  </div>
                  <div class="col-12 mb-3">
                    <div class="d-flex flex-column align-items-start gap-2">
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">1º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario1"></h5>
                      </div>
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">2º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario2"></h5>
                      </div>
                      <div class="d-flex gap-2">
                        <span class="fw-bolder">3º:</span>
                        <h5 class="fw-semibold mb-0 me-8" id="horario3"></h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mt-1 mb-2">
                    <span class="fs-3 fw-bold"><i class="ti ti-clipboard"></i> Nº Marcações Hoje:</span>
                  </div>
                  <div class="col-12 mt-1 mb-2">
                    <h4 class="fw-semibold mb-0 me-8" id="nMarcacoesHoje"></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 shadow">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                  <div class="mb-3 mb-sm-0">
                    <span class="fs-4 fw-semibold"><i class="me-1 fs-5 ti ti-award"></i> Classificação </span>
                    <p class="card-subtitle mt-1">Melhores Atletas nas suas Equipas</p>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table align-middle text-nowrap mb-0">
                    <thead>
                      <tr class="text-muted fw-semibold text-center">
                        <th scope="col" class="ps-0">Atleta</th>
                        <th scope="col">Data Nascimento</th>
                        <th scope="col">Nº Vitórias</th>
                        <th scope="col">Nº Jogos Realizados</th>
                      </tr>
                    </thead>
                    <tbody class="border-top" id= "bodyMelhoresAtletas">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    </div>
    <div class="col-lg-2">
      
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
  <div class="offcanvas offcanvas-end shopping-cart" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header py-4">
      <h5 class="offcanvas-title fs-5 fw-semibold" id="offcanvasRightLabel">Shopping Cart</h5>
      <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
    </div>
    <div class="offcanvas-body h-100 px-4 pt-0" data-simplebar>
      <ul class="mb-0">
        <li class="pb-7">
          <div class="d-flex align-items-center">
            <img src="../../dist/images/products/product-1.jpg" width="95" height="75"
              class="rounded-1 me-9 flex-shrink-0" alt="" />
            <div>
              <h6 class="mb-1">Supreme toys cooker</h6>
              <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
              <div class="d-flex align-items-center justify-content-between mt-2">
                <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                <div class="input-group input-group-sm w-50">
                  <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button"
                    id="add1"> - </button>
                  <input type="text"
                    class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty"
                    placeholder="" aria-label="Example text with button addon" aria-describedby="add1" value="1" />
                  <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button" id="addo2">
                    + </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="pb-7">
          <div class="d-flex align-items-center">
            <img src="../../dist/images/products/product-2.jpg" width="95" height="75"
              class="rounded-1 me-9 flex-shrink-0" alt="" />
            <div>
              <h6 class="mb-1">Supreme toys cooker</h6>
              <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
              <div class="d-flex align-items-center justify-content-between mt-2">
                <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                <div class="input-group input-group-sm w-50">
                  <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button"
                    id="add2"> - </button>
                  <input type="text"
                    class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty"
                    placeholder="" aria-label="Example text with button addon" aria-describedby="add2" value="1" />
                  <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button"
                    id="addon34"> + </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="pb-7">
          <div class="d-flex align-items-center">
            <img src="../../dist/images/products/product-3.jpg" width="95" height="75"
              class="rounded-1 me-9 flex-shrink-0" alt="" />
            <div>
              <h6 class="mb-1">Supreme toys cooker</h6>
              <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
              <div class="d-flex align-items-center justify-content-between mt-2">
                <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                <div class="input-group input-group-sm w-50">
                  <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button"
                    id="add3"> - </button>
                  <input type="text"
                    class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty"
                    placeholder="" aria-label="Example text with button addon" aria-describedby="add3" value="1" />
                  <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button"
                    id="addon3"> + </button>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      <div class="align-bottom">
        <div class="d-flex align-items-center pb-7">
          <span class="text-dark fs-3">Sub Total</span>
          <div class="ms-auto">
            <span class="text-dark fw-semibold fs-3">$2530</span>
          </div>
        </div>
        <div class="d-flex align-items-center pb-7">
          <span class="text-dark fs-3">Total</span>
          <div class="ms-auto">
            <span class="text-dark fw-semibold fs-3">$6830</span>
          </div>
        </div>
        <a href="./eco-checkout.html" class="btn btn-outline-primary w-100">Go to shopping cart</a>
      </div>
    </div>
  </div>

  <!--  Mobilenavbar -->
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <nav class="sidebar-nav scroll-sidebar">
      <div class="offcanvas-header justify-content-between">
        <img src="../../dist/images/logos/favicon.ico" alt="" class="img-fluid">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar="" data-simplebar>
        <ul id="sidebarnav">
          <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
              <span>
                <i class="ti ti-apps"></i>
              </span>
              <span class="hide-menu">Apps</span>
            </a>
            <ul aria-expanded="false" class="collapse first-level my-3">
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-message-box.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Email App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get new emails</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                    <span class="fs-2 d-block fw-normal text-muted">learn more information</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24" height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Get dates</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-lifebuoy.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                    <span class="fs-2 d-block fw-normal text-muted">Add new contact</span>
                  </div>
                </a>
              </li>
              <li class="sidebar-item py-2">
                <a href="#" class="d-flex align-items-center">
                  <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                    <img src="../../dist/images/svgs/icon-dd-application.svg" alt="" class="img-fluid" width="24"
                      height="24">
                  </div>
                  <div class="d-inline-block">
                    <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                    <span class="fs-2 d-block fw-normal text-muted">To-do and Daily tasks</span>
                  </div>
                </a>
              </li>
              <ul class="px-8 mt-7 mb-4">
                <li class="sidebar-item mb-3">
                  <h5 class="fs-5 fw-semibold">Quick Links</h5>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Pricing Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Authentication Design</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Register Now</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">404 Error Page</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Notes App</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">User Application</a>
                </li>
                <li class="sidebar-item py-2">
                  <a class="fw-semibold text-dark" href="#">Account Settings</a>
                </li>
              </ul>
            </ul>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-chat.html" aria-expanded="false">
              <span>
                <i class="ti ti-message-dots"></i>
              </span>
              <span class="hide-menu">Chat</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-calendar.html" aria-expanded="false">
              <span>
                <i class="ti ti-calendar"></i>
              </span>
              <span class="hide-menu">Calendar</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="app-email.html" aria-expanded="false">
              <span>
                <i class="ti ti-mail"></i>
              </span>
              <span class="hide-menu">Email</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <!--  Search Bar -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content rounded-1">
        <div class="modal-header border-bottom">
          <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
          <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
            <i class="ti ti-x fs-5 ms-3"></i>
          </span>
        </div>
        <div class="modal-body message-body" data-simplebar="">
          <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
          <ul class="list mb-0 py-2">
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Modern</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Dashboard</span>
                <span class="fs-3 text-muted d-block">/dashboards/dashboard2</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Contacts</span>
                <span class="fs-3 text-muted d-block">/apps/contacts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Posts</span>
                <span class="fs-3 text-muted d-block">/apps/blog/posts</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Detail</span>
                <span
                  class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
              </a>
            </li>
            <li class="p-1 mb-1 bg-hover-light-black">
              <a href="#">
                <span class="fs-3 text-black fw-normal d-block">Shop</span>
                <span class="fs-3 text-muted d-block">/apps/ecommerce/shop</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
  </button>
  <div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel" data-simplebar="">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
      <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4">
      <div class="theme-option pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style.min.css')"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
            <i class="ti ti-brightness-up fs-7 text-primary"></i>
            <span class="text-dark">Light</span>
          </a>
          <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style-dark.min.css')"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
            <i class="ti ti-moon fs-7 "></i>
            <span class="text-dark">Dark</span>
          </a>
        </div>
      </div>
      <div class="theme-direction pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Theme Direction</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
            <i class="ti ti-text-direction-ltr fs-6 text-primary"></i>
            <span class="text-dark">LTR</span>
          </a>
          <a href="../rtl/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
            <i class="ti ti-text-direction-rtl fs-6 text-dark"></i>
            <span class="text-dark">RTL</span>
          </a>
        </div>
      </div>
      <div class="theme-colors pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Theme Colors</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <ul class="list-unstyled mb-0 d-flex gap-3 flex-wrap change-colors">
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin1-bluetheme-primary active-theme "
                onclick="toggleTheme('../../dist/css/style.min.css')" data-color="blue_theme" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-title="BLUE_THEME"><i
                  class="ti ti-check text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin2-aquatheme-primary "
                onclick="toggleTheme('../../dist/css/style-aqua.min.css')" data-color="aqua_theme"
                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME"><i
                  class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin3-purpletheme-primary"
                onclick="toggleTheme('../../dist/css/style-purple.min.css')" data-color="purple_theme"
                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME"><i
                  class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin4-greentheme-primary"
                onclick="toggleTheme('../../dist/css/style-green.min.css')" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-title="GREEN_THEME"><i
                  class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin5-cyantheme-primary"
                onclick="toggleTheme('../../dist/css/style-cyan.min.css')" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-title="CYAN_THEME"><i
                  class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
            <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
              <a href="javascript:void(0)"
                class="rounded-circle position-relative d-block customizer-bgcolor skin6-orangetheme-primary"
                onclick="toggleTheme('../../dist/css/style-orange.min.css')" data-bs-toggle="tooltip"
                data-bs-placement="top" data-bs-title="ORANGE_THEME"><i
                  class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="layout-type pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
            <i class="ti ti-layout-sidebar fs-6 text-primary"></i>
            <span class="text-dark">Vertical</span>
          </a>
          <a href="../horizontal/index.html"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
            <i class="ti ti-layout-navbar fs-6 text-dark"></i>
            <span class="text-dark">Horizontal</span>
          </a>
        </div>
      </div>
      <div class="container-option pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Container Option</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 boxed-width text-dark">
            <i class="ti ti-layout-distribute-vertical fs-7 text-primary"></i>
            <span class="text-dark">Boxed</span>
          </a>
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 full-width text-dark">
            <i class="ti ti-layout-distribute-horizontal fs-7"></i>
            <span class="text-dark">Full</span>
          </a>
        </div>
      </div>
      <div class="sidebar-type pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Sidebar Type</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 fullsidebar">
            <i class="ti ti-layout-sidebar-right fs-7"></i>
            <span class="text-dark">Full</span>
          </a>
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center text-dark sidebartoggler gap-2">
            <i class="ti ti-layout-sidebar fs-7"></i>
            <span class="text-dark">Collapse</span>
          </a>
        </div>
      </div>
      <div class="card-with pb-4">
        <h6 class="fw-semibold fs-4 mb-1">Card With</h6>
        <div class="d-flex align-items-center gap-3 my-3">
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 text-dark cardborder">
            <i class="ti ti-border-outer fs-7"></i>
            <span class="text-dark">Border</span>
          </a>
          <a href="javascript:void(0)"
            class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 cardshadow">
            <i class="ti ti-border-none fs-7"></i>
            <span class="text-dark">Shadow</span>
          </a>
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
  <script src="../../dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../dist/js/dashboard.js"></script>
  <script src="../../dist/js/js_courtify/dashboardClube.js"></script>


  <script src="../../dist/js/widgets-charts.js"></script>

  <script>
    $(document).ready(function () {

      $(".owl-carousel").each(function () {
        var carouselId = $(this).closest(".carousel-container").attr("id");
        $(this).owlCarousel({
          items: 3,
          margin: 20,
          loop: false,
          nav: false,
          autoplay: false,
          autoplayHoverPause: true,
          responsive: {
            0: {
              items: 1
            },
            768: {
              items: 2
            },
            992: {
              items: 3
            }
          }
        });


        $("#" + carouselId + " .owl-prev").click(function () {
          $("#" + carouselId + " .owl-carousel").trigger("prev.owl.carousel");
        });

        $("#" + carouselId + " .owl-next").click(function () {
          $("#" + carouselId + " .owl-carousel").trigger("next.owl.carousel");
        });
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