<?php
session_start();

if (isset($_SESSION['id'])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Title -->
    <title>Courtify</title>
    <!-- Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/favicon.ico" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="../../dist/libs/owl.carousel/dist/assets/owl.carousel.min.css">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
      body {
        overflow-x: hidden;
      }
    </style>



  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-xl navbar-light container-fluid px-0">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-xl-block">
              <a href="./index.php" class="text-nowrap nav-link mb-2">
                <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo" width="180" alt="" />
                <img src="../../dist/images/logos/light-logo.svg" class="light-logo" width="180" alt="" />
              </a>
            </li>
            <li class="nav-item d-none d-xl-block mt-1">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)" onclick="getAtletasPesquisaNavbar()" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="ti ti-search"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav quick-links d-none d-xl-flex">
            <li class="nav-item dropdown-hover d-none d-xl-block">
                <a class="nav-link fs-6" href="./index.php">Home</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="./hub.php">Comunidade</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="./marcacao.php">Marcação de Campos</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="#">Descobrir</a>
            </li>
          </ul>
          <div class="d-block d-xl-none mb-2 ms-5">
            <a href="index.html" class="text-nowrap nav-link">
              <img src="../../dist/images/logos/logo_courtify.png" width="180" alt="" />
            </a>
          </div>
          <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
              <i class="ti ti-dots fs-7"></i>
            </span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
              <a href="javascript:void(0)" class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                <i class="ti ti-align-justified fs-7"></i>
              </a>
              <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                <li class="nav-item dropdown">
                  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                  </a>
                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="d-flex align-items-center justify-content-between py-3 px-7">
                      <h5 class="mb-0 fs-5 fw-semibold">Notificações</h5>
                      <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container"></span>
                    </div>
                    <div class="message-body" data-simplebar>
                      <div id="divNotificacoesVotacao">

                      </div>
                      <div id="divNotificacoesConviteMarcacao">

                      </div>
                      <div id="divNotificacoesPedidoAmizade">

                      </div>
                    </div>
                    <div class="py-6 px-7 mb-1">
                      <button class="btn btn-outline-primary w-100"> Ver Tudo </button>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                      <div class="user-profile-img mb-2">
                        <img class="rounded-circle" width="35" height="35" alt="" id="perfil1" />
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                    <div class="profile-dropdown position-relative" data-simplebar>
                      <div class="py-3 px-7 pb-0">
                      </div>
                      <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                        <img class="rounded-circle" width="80" height="80" alt="" id="perfil2" />
                        <div class="ms-3">
                          <h5 class="mb-1 fs-3 fw-bolder" id="nome2"></h5>
                          <span class="badge rounded-pill border border-1 border-primary bg-light text-dark fs-3 mt-1">
                            <i class="ti ti-trophy text-primary fs-4"></i>
                              Atleta
                          </span>
                          <p class="mb-0 d-flex text-dark align-items-center gap-2" id="email2">
                            <i class="ti ti-mail fs-4"></i>
                          </p>
                        </div>
                      </div>
                      <div class="message-body">
                        <a href="./perfil.php?id=<?php echo $_SESSION['id'] ?>" class="py-8 px-7 mt-8 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <i class="ti ti-user-circle fs-7 text-primary"></i>
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold">Perfil</h6>
                            <span class="d-block text-dark"></span>
                          </div>
                        </a>
                        <a href="./chat.php" class="py-8 px-7 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <i class="ti ti-message fs-7 text-primary"></i>
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold">Mensagens</h6>
                          </div>
                        </a>
                        <a href="./calendario.php" class="py-8 px-7 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <i class="ti ti-calendar fs-7 text-primary"></i>
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold">Calendário</h6>
                          </div>
                        </a>
                        <a href="./perfil_definicoes.php" class="py-8 px-7 d-flex align-items-center">
                          <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                            <i class="ti ti-settings fs-7 text-primary"></i>
                          </span>
                          <div class="w-75 d-inline-block v-middle ps-3">
                            <h6 class="mb-1 bg-hover-primary fw-semibold">Definições</h6>
                          </div>
                        </a>
                      </div>
                      <div class="d-grid py-4 px-7 pt-8">
                        <a class="btn btn-outline-primary" onclick="logout()">Terminar Sessão</a>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <!-- Header End -->
      <!-- Sidebar Start -->
      <!-- Main wrapper -->
      <div class="">
        <div class="">
          <div class="row">
            <div class="col-lg-12" style="position: relative; margin-top: 80px;">
              <div style="position: absolute; top: 5px; right: 16px; z-index: 1;">
                <img src="../../dist/images/logos/logo_icone.png" style="max-width: 70px;">
              </div>
              <img class="img-fluid" src="../../dist/images/backgrounds/descobrir_banner.jpg" style="width: 100%; max-width: 100%; height: 600px; object-fit: cover; filter: brightness(50%);">
              <div style="position: absolute; top: 65%; transform: translateY(-50%); left: 5%; text-align: center; color: white;">
                <h1 class="text-white fw-bolder" style="letter-spacing: 1px; font-size: 90px">
                  Descobrir</h1>
                <p class="text-white lead lead-md-2 lead-lg-1" style="letter-spacing: 1px; font-size: 40px">
                  Jogos disponíveis <br> a qualquer momento</p>
              </div>
            </div>
          </div>
          <div class="body-wrapper">
            <div class="container">
            <div class="mt-5">
              <div class="row arrow-container">
                  <div class="col-lg-4">
                    <div class="card shadow" style="height: 260px">
                      <div class="card-header">
                      <h4 class="m-0 p-0"><span class="badge rounded-circle text-bg-success me-2">1</span>Descobrir</h4>
                      </div>
                      <div class="card-body">
                        <p class="fs-4 card-text">Nesta página, tens acesso a todas a Marcações abertas que consideramos ser as que mais
                          se identificam contigo. Todos os resultados foram cuidadosamente selecionados para o teu perfil.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card shadow" style="height: 260px">
                      <div class="card-header">
                      <h4 class="m-0 p-0"><span class="badge rounded-circle text-bg-success me-2">2</span>Juntar</h4>
                      </div>
                      <div class="card-body">
                        <p class="fs-4 card-text">Agora que encontras-te a marcação perfeita para ti, é altura de te juntares a ela.
                          No fim de cada resultado, encontras um botão verde com o nome "Juntar". Clica, confirma a seleção, e já está!
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card shadow" style="height: 260px">
                      <div class="card-header">
                      <h4 class="m-0 p-0"><span class="badge rounded-circle text-bg-success me-2">3</span>Jogar</h4>
                      </div>
                      <div class="card-body">
                        <p class="fs-4 card-text">Agora que estás inscrito nesta Marcação, o último passo é jogar! 
                        Confirma as horas, a morada do clube (clica no seu nome!), e não te esqueças de levar o teu equipamento</p>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="mt-5">
                <h2 class="mb-4">Marcações abertas dos teus amigos <span class="ms-2 badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container" id="quantidadeMarcacoesAmigos"></span></h2>
                </h2>
                <div class="card bg-light px-3" id="cardCarousel1">
                  <div class="carousel-container mt-5" id="carousel1">
                    <div class="owl-carousel" id="marcacaoAmigos">
                      <div class="item">
                        <div class="mt-1">
                          <div class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img">

                          </div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="mt-1">
                          <div class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img">

                          </div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="mt-1">
                          <div class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img">

                          </div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="mt-1">
                          <div class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img">

                          </div>
                        </div>
                      </div>
                      <div class="item">
                        <div class="mt-1">
                          <div class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img">

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-5">
                  <h2 class="mb-4">Marcações abertas das tuas Modalidades <span class="ms-2 badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container" id="quantidadeMarcacoesModalidades"></span></h2>
                  <div class="card bg-light px-3" id="cardCarousel2">
                    <div class="carousel-container mt-5" id="carousel2">
                      <div class="owl-carousel" id="marcacaoModalidades">

                      </div>
                    </div>
                  </div>
                  <div class="mt-5">
                    <h2 class="mb-4">Marcações abertas em <span id="localidadeUser"></span> <span class="ms-2 badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container" id="quantidadeMarcacoesLocalidade"></span></h2>
                    <div class="card bg-light px-3" id="cardCarousel3">
                      <div class="carousel-container mt-5" id="carousel3">
                        <div class="owl-carousel" id="marcacaoLocalidade">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div style="margin-left: 60px; margin-right: 60px;">
                  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <p class="col-md-4 mb-0 text-muted">Copyright © 2023 Courtify</p>

                    <a href="#" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                      <img src="../../../landingpage/dist/images/logos/logo_icone.png" width="50">
                    </a>
                    <div>
                      <p class="mb-0 text-muted">Todos os direitos reservados.</p>
                    </div>

                  </footer>
                </div>
              </div>
            </div>
          </div>
          <div class="dark-transparent sidebartoggler"></div>
        </div>
        <!--  Shopping Cart -->
        <div class="offcanvas offcanvas-end shopping-cart" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header py-4">
            <h5 class="offcanvas-title fs-5 fw-semibold" id="offcanvasRightLabel">Shopping Cart</h5>
            <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
          </div>
          <div class="offcanvas-body h-100 px-4 pt-0" data-simplebar>
            <ul class="mb-0">
              <li class="pb-7">
                <div class="d-flex align-items-center">
                  <img src="../../dist/images/products/product-1.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="" />
                  <div>
                    <h6 class="mb-1">Supreme toys cooker</h6>
                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                      <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                      <div class="input-group input-group-sm w-50">
                        <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button" id="add1"> - </button>
                        <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add1" value="1" />
                        <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button" id="addo2">
                          + </button>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="pb-7">
                <div class="d-flex align-items-center">
                  <img src="../../dist/images/products/product-2.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="" />
                  <div>
                    <h6 class="mb-1">Supreme toys cooker</h6>
                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                      <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                      <div class="input-group input-group-sm w-50">
                        <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button" id="add2"> - </button>
                        <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add2" value="1" />
                        <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button" id="addon34"> + </button>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="pb-7">
                <div class="d-flex align-items-center">
                  <img src="../../dist/images/products/product-3.jpg" width="95" height="75" class="rounded-1 me-9 flex-shrink-0" alt="" />
                  <div>
                    <h6 class="mb-1">Supreme toys cooker</h6>
                    <p class="mb-0 text-muted fs-2">Kitchenware Item</p>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                      <h6 class="fs-2 fw-semibold mb-0 text-muted">$250</h6>
                      <div class="input-group input-group-sm w-50">
                        <button class="btn border-0 round-20 minus p-0 bg-light-success text-success " type="button" id="add3"> - </button>
                        <input type="text" class="form-control round-20 bg-transparent text-muted fs-2 border-0  text-center qty" placeholder="" aria-label="Example text with button addon" aria-describedby="add3" value="1" />
                        <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button" id="addon3"> + </button>
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
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
          <nav class="sidebar-nav scroll-sidebar">
            <div class="offcanvas-header justify-content-between">
              <img src="../../dist/images/logos/favicon.ico" alt="" class="img-fluid">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar="" data-simplebar>
              <ul id="sidebarnav">
                <li class="sidebar-item">
                  <a class="sidebar-link" href="#" aria-expanded="false">
                    <span>
                      <i class="ti ti-home"></i>
                    </span>
                    <span class="hide-menu">Home</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="marcacao.php" aria-expanded="false">
                    <span>
                      <i class="ti ti-soccer-field"></i>
                    </span>
                    <span class="hide-menu">Marcação</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="#" aria-expanded="false">
                    <span>
                      <i class="ti ti-radar"></i>
                    </span>
                    <span class="hide-menu">Descobrir</span>
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
          <div class='d-flex'>
          <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
          <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Pesquisa Geral</h4>
          </div>
          <div class='pt-3 pb-2 ps-3 pe-3'>
            <span>
              Através desta pesquisa, consegues facilmente encontrar quem ou o que procuras. 
              Sejam outros Atletas como tu, Clubes, Grupos ou Equipas, esta Pesquisa geral está aqui a tua disposição.
            </span>
          </div> 
          <div class="modal-header border-bottom">
            <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" data-bs-dismiss="modal" aria-label="Close"></button>
            <input type="text" class="form-control fs-3" placeholder="Introduza um termo de pesquisa..." id="search" />
          </div>
          <div class="modal-body message-body" data-simplebar="">
            <h5 class="mb-0 fs-4 p-1">Resultados</h5>
            <ul class="list mb-0 py-2" id="pesquisaAtletasNavbar">

            </ul>
          </div>
        </div>
      </div>
    </div>


        <div class="modal fade" id="scroll-long-inner-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="corpoModal">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start" data-bs-dismiss="modal" id="guardarVotacao">
                  Guardar
                </button>
                <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start" data-bs-dismiss="modal">
                  Fechar
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="scroll-long-inner-modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="corpoModal1">
              </div>
              <div class="d-flex justify-content-center align-items-center gap-3">
                <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3 mt-3" data-bs-dismiss="modal" id="aceitar">
                  Aceitar
                </button>
                <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3 mt-3" data-bs-dismiss="modal" id="rejeitar">
                  Rejeitar
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="scroll-long-inner-modal3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title">
                  Marcação
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <span>Estás prestes a juntar-te a esta Marcação.<br></span>
                <h5 class='mt-3'>Tens a certeza?</h5>
              </div>
              <div class="d-flex justify-content-center align-items-center gap-3" id="corpoBotoesDescobrir">

              </div>
            </div>
          </div>
        </div>





        <!-- Import Js Files -->
        <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
        <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
        <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- core files -->
        <script src="../../dist/js/app.min.js"></script>
        <script src="../../dist/js/app.horizontal.init.js"></script>
        <script src="../../dist/js/app-style-switcher.js"></script>
        <script src="../../dist/js/sidebarmenu.js"></script>
        <script src="../../../landingpage/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
        <script src="../../dist/js/js_courtify/descobrir.js"></script>

        <script src="../../dist/js/custom.js"></script>
        <!-- current page js files -->
        <script src="../../dist/js/js_courtify/sweatalert.js"></script>
        <script src="../../dist/js/js_courtify/user.js"></script>
        <script src="../../dist/js/js_courtify/perfilUser.js"></script>
        <script src="../../dist/js/js_courtify/notificacao.js"></script>

        <script>
          $(function() {
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
          });
        </script>

        <script type="text/javascript">
          var timeout;


          function resetSessionTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {

              var xhr = new XMLHttpRequest();
              xhr.open('GET', 'logout.php', true);
              xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                  alerta2("Alerta", "Sessão terminada após 15m de inatividade", "warning");
                  setTimeout(function() {
                    window.location.href = '../../../landingpage/index.html';
                  }, 3000);

                }
              };
              xhr.send();
            }, 900000);
          }


          document.onmousemove = resetSessionTimeout;
          document.onkeypress = resetSessionTimeout;


          resetSessionTimeout();
        </script>





  </body>

  </html>
<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>