<?php 
session_start();

if (isset($_SESSION['id'])) {?>
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

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <style>
    .animated-text {
      opacity: 0;
      transform: translateY(-20px);
      transition: opacity 3s ease-out, transform 3s ease-out;
    }

    .animated-text.show {
      opacity: 1;
      transform: translateY(0);
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
    <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Header Start -->
    <header class="app-header">
      <nav class="navbar navbar-expand-xl navbar-light container-fluid px-0">
        <ul class="navbar-nav">
          <li class="nav-item d-none d-xl-block">
            <a href="index.html" class="text-nowrap nav-link mb-2">
              <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo" width="180" alt="" />
              <img src="../../dist/images/logos/light-logo.svg" class="light-logo" width="180" alt="" />
            </a>
          </li>
          <li class="nav-item d-none d-xl-block mt-1">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal"
              data-bs-target="#exampleModal">
              <i class="ti ti-search"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-xl-flex">
          <li class="nav-item dropdown hover-dd d-none d-xl-block">
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block ms">
            <a class="nav-link fs-6" href="./hub.php">Hub</a>
          </li>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./marcacao_editavel.php">Marcação de Campos</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./descobrir.php">Descobrir</a>
          </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="./hub-grupos.php">Grupos</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="./hub-equipas.php">Equipas</a>
            </li>
        </ul>
        <div class="d-block d-xl-none mb-2 ms-5">
          <a href="index.html" class="text-nowrap nav-link">
            <img src="../../dist/images/logos/logo_courtify.png" width="180" alt="" />
          </a>
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="p-2">
            <i class="ti ti-dots fs-7"></i>
          </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
            <a href="javascript:void(0)"
              class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center"
              type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
              aria-controls="offcanvasWithBothOptions">
              <i class="ti ti-align-justified fs-7"></i>
            </a>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="ti ti-bell-ringing"></i>
                  <div class="notification bg-primary rounded-circle"></div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                  aria-labelledby="drop2">
                  <div class="d-flex align-items-center justify-content-between py-3 px-7">
                    <h5 class="mb-0 fs-5 fw-semibold">Notificações</h5>
                    <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container">5</span>
                  </div>
                  <div class="message-body" data-simplebar>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                      <span class="me-3">
                        <img src="../../dist/images/profile/boy11.jpg" alt="user"
                          class="rounded-circle object-fit-cover" width="48" height="48" />
                      </span>
                      <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Vasco Pissarra</h6>
                        <span class="d-block">Novo Pedido de Amizade</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                      <span class="me-3">
                        <img src="../../dist/images/profile/girl.jpg" alt="user" class="rounded-circle object-fit-cover"
                          width="48" height="48" />
                      </span>
                      <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Joana Cruz</h6>
                        <span class="d-block">Nova Mensagem</span>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                      <span class="me-3">
                        <img src="../../dist/images/profile/boy5.jpg" alt="user" class="rounded-circle object-fit-cover"
                          width="48" height="48" />
                      </span>
                      <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Vitor Andrade</h6>
                        <span class="d-block">Nova Mensagem</span>
                      </div>
                    </a>
                  </div>
                  <div class="py-6 px-7 mb-1">
                    <button class="btn btn-outline-primary w-100"> Ver Tudo </button>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <div class="d-flex align-items-center">
                    <div class="user-profile-img mb-2">
                      <img id="perfil1" class="rounded-circle" width="35" height="35" alt="" />
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                  aria-labelledby="drop1">
                  <div class="profile-dropdown position-relative" data-simplebar>
                    <div class="py-3 px-7 pb-0">
                    </div>
                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                      <img class="rounded-circle" width="80" height="80" alt="" id="perfil2" />
                      <div class="ms-3">
                        <h5 class="mb-1 fs-3" id="nome2"></h5>
                        <span class="mb-1 d-block text-dark">Padel</span>
                        <p class="mb-0 d-flex text-dark align-items-center gap-2" id="email2">
                          <i class="ti ti-mail fs-4"></i>
                        </p>
                      </div>
                    </div>
                    <div class="message-body">
                      <a href="./perfil.php" class="py-8 px-7 mt-8 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <i class="ti ti-user-circle fs-7 text-primary"></i>
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                          <h6 class="mb-1 bg-hover-primary fw-semibold">Perfil</h6>
                          <span class="d-block text-dark"></span>
                        </div>
                      </a>
                      <a href="./app-email.html" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <i class="ti ti-message fs-7 text-primary"></i>
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                          <h6 class="mb-1 bg-hover-primary fw-semibold">Mensagens</h6>
                        </div>
                      </a>
                      <a href="./app-calendar.php" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <i class="ti ti-chart-histogram fs-7 text-primary"></i>
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
    <!-- Sidebar Start -->4 4 41
    <!-- Main wrapper -->
    <div class="">
    <div class="col-lg-12" style="position: relative; margin-top: 59px;">
        <div style="position: absolute; top: 5px; right: 5px; z-index: 1;">
          <img src="../../dist/images/logos/logo_icone.png" style="max-width: 70px;">
        </div>
        <img class="img-fluid"
          src="../../dist/images/backgrounds/marcacao_banner.jpg"
          style="width: 100%; max-width: 100%; height: 600px; object-fit: cover; filter: brightness(70%);">
        <div
          style="position: absolute; top: 30%; transform: translateY(-50%); left: 10%; text-align: left; color: white;">
          <h1 class="text-white fw-bolder"
            style="letter-spacing: 1px; font-size: 90px;">
            Marcação de Campos</h1>
          <p class="text-white lead lead-md-2 lead-lg-1"
            style="letter-spacing: 1px; font-size: 40px;">
            Encontra o campo ideal para <br> a próxima partida</p>
        </div>
      </div>

      <div class="card shadow pb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="fw-bolder mb-3 fs-9">Pesquisa</h4>
            </div>
          </div>
          <div class="">
            <form>
              <div class="row">
                <div class="form-group input-group-lg col-md-4 mt-3 mt-md-0">
                  <input type="text" class="form-control" placeholder="Nome, localidade, etc..." id="stringPesquisa">
                </div>
                <div class="form-group input-group-lg col-md-2 mt-3 mt-md-0 col-6">
                  <select class="form-select" id="pesquisaMarcacaoModalidade">

                  </select>
                </div>
                <div class="form-group input-group-lg col-md-2 mt-3 mt-md-0 col-6">
                  <input type="date" class="form-control" id="currentDateInput">
                </div>
                <div class="form-group input-group-lg col-md-2 mt-3 mt-md-0">
                  <select id="currentTimeInput" class="form-select">
                    <option value="-1" style="color: #c9c9c9;">Hora</option>
                    <option value="07:00:00">07:00</option>
                    <option value="07:30:00">07:30</option>
                    <option value="08:00:00">08:00</option>
                    <option value="08:30:00">08:30</option>
                    <option value="09:00:00">09:00</option>
                    <option value="09:30:00">09:30</option>
                    <option value="10:00:00">10:00</option>
                    <option value="10:30:00">10:30</option>
                    <option value="11:00:00">11:00</option>
                    <option value="11:30:00">11:30</option>
                    <option value="12:00:00">12:00</option>
                    <option value="12:30:00">12:30</option>
                    <option value="13:00:00">13:00</option>
                    <option value="13:30:00">13:30</option>
                    <option value="14:00:00">14:00</option>
                    <option value="14:30:00">14:30</option>
                    <option value="15:00:00">15:00</option>
                    <option value="15:30:00">15:30</option>
                    <option value="16:00:00">16:00</option>
                    <option value="16:30:00">16:30</option>
                    <option value="17:00:00">17:00</option>
                    <option value="17:30:00">17:30</option>
                    <option value="18:00:00">18:00</option>
                    <option value="18:30:00">18:30</option>
                    <option value="19:00:00">19:00</option>
                    <option value="19:30:00">19:30</option>
                    <option value="20:00:00">20:00</option>
                    <option value="20:30:00">20:30</option>
                    <option value="21:00:00">21:00</option>
                    <option value="21:30:00">21:30</option>
                    <option value="22:00:00">22:00</option>
                    <option value="22:30:00">22:30</option>
                    <option value="23:00:00">23:00</option>
                    <option value="23:30:00">23:30</option>
                  </select>
                </div>
                <div class="form-group input-group-lg col-md-2 mt-3 mt-md-0">
                  <button type="button" class="btn btn-primary" onclick="pesquisarCampos()">Pesquisa</button>
                  <button type="button" class="mt-2 mt-sm-0 mt-xl-0 btn btn-light"
                    onclick="getUserLocation()">Redefinir</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="mb-5 px-5">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group input-group-lg">
              <select class="form-select" id="filtroTipo">
                <option value="-1" selected disabled>Tipo</option>
                <option value="Cobertura">Coberto</option>
                <option value="Indoor">Indoor</option>
                <option value="Exterior">Exterior</option>
              </select>
            </div>
          </div>
          <div class="col-md-2 mt-2 mt-md-0">
            <div class="form-group input-group-lg">
              <select class="form-select" id="filtroDistancia">
                <option value="-1" selected disabled>Distância</option>
                <option value="0-1km">Até 1km</option>
                <option value="1-5km">Até 5km</option>
                <option value="5-10km">Até 10km</option>
              </select>
            </div>
          </div>
          <div class="form-group input-group-lg col-md-2 mt-3 mt-md-0 d-flex align-items-center gap-2">
            <button type="button" class="btn btn-primary btn-sm w-100" onclick="aplicarFiltros()">Filtrar</button>
            <button type="button" class="btn btn-light btn-sm w-100" onclick="removerFiltros()">Remover</button>
          </div>
          <div class="col-md-6 text-end mt-2 mt-md-0 col">
            <div class="form-check input-group-lg form-switch d-flex align-items-center justify-content-end mb-0">
              <div>
                <input class="form-check-input me-2" type="checkbox" role="switch" id="flexSwitchCheckChecked1" checked style="width:50px; height: 30px;">
                <label class="form-check-label me-5 fs-5" for="flexSwitchCheckDefault">Clubes sem disponibilidade</label>
              </div>
              <div class="d-none d-xxl-flex input-group-lg">
                <input class="form-check-input me-2" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked style="width:50px; height: 30px;">
                <label class="form-check-label fs-5" for="flexSwitchCheckChecked">Mostrar mapa</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="px-3 page">
        <div class="left" id="leftContainer">
          <div class="card">
            <div class="card-body bg-light">
              <h3 class="fw-semibold mb-3 fs-8">Resultados</h3>

              <div class="row" id="rowCampos">

              </div>
            </div>
            <nav aria-label="Page navigation example" class="bg-light d-flex justify-content-end">
              <ul class="pagination bg-light me-3">
                <li class="page-item">
                  <a class="page-link link" href="#" aria-label="Previous">
                    <span aria-hidden="true">
                      <i class="ti ti-chevrons-left fs-4"></i>
                    </span>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link link" href="#" aria-label="Next">
                    <span aria-hidden="true">
                      <i class="ti ti-chevrons-right fs-4"></i>
                    </span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="divider d-none d-xxl-flex" id="divider">

        </div>
        <div class="right rounded" id="rightContainer">
          <div id="mapa" style="height: 100%">

          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
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
            <a class="sidebar-link" href="#" aria-expanded="false">
              <span>
                <i class="ti ti-home"></i>
              </span>
              <span class="hide-menu">Home</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="#" aria-expanded="false">
              <span>
                <i class="ti ti-soccer-field"></i>
              </span>
              <span class="hide-menu">Marcação</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="descobrir.php" aria-expanded="false">
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

  <!-- Import Js Files -->
  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../dist/js/math/math.js"></script>
  <!-- core files -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.horizontal.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>

  <script src="../../dist/js/custom.js"></script>
  <!-- current page js files -->
  <script src="../../dist/js/js_courtify/sweatalert.js"></script>
  <script src="../../dist/js/js_courtify/perfilUser.js"></script>
  <script src="../../dist/js/js_courtify/user.js"></script>
  <script src="../../dist/js/js_courtify/campo.js"></script>


  <script>
    // Add a class to trigger the animation on page load
    $(document).ready(function () {
      $('.animated-text').addClass('show');
    });
  </script>


  <script>
    function getCurrentDate() {
      const now = new Date();
      if (now.getHours() >= 23 && now.getMinutes() >= 30) {
        // If it's 23:30 or later, get the date for the next day
        now.setDate(now.getDate() + 1);
      }
      const year = now.getFullYear();
      const month = (now.getMonth() + 1).toString().padStart(2, '0');
      const day = now.getDate().toString().padStart(2, '0');
      return `${year}-${month}-${day}`;
    }

    function resetOptions() {
      const options = document.querySelectorAll("#currentTimeInput option");
      options.forEach(option => {
        option.style.display = "block";
      });
    }

    document.getElementById("currentDateInput").addEventListener("change", resetOptions);

    document.getElementById("currentDateInput").value = getCurrentDate();
  </script>

  <script>
    const toggleSwitch = document.getElementById("flexSwitchCheckChecked");
    const rightContainer = document.getElementById("rightContainer");
    const divider = document.getElementById("divider");

    function isScreenBelowMd() {
      return window.matchMedia("(max-width: 1700px)").matches;
    }

    function updateVisibility() {
      if (isScreenBelowMd() || !toggleSwitch.checked) {
        rightContainer.style.display = "none";
        divider.style.display = "none";
        toggleSwitch.checked = false;
      } else {
        rightContainer.style.display = "block";
        divider.style.display = "block";
      }
    }

    updateVisibility();

    toggleSwitch.addEventListener("change", function () {
      if (toggleSwitch.checked) {
        rightContainer.style.display = "block";
        divider.style.display = "block";
      } else {
        rightContainer.style.display = "none";
        divider.style.display = "none";
      }
    });

    window.addEventListener("resize", updateVisibility);
  </script>


  <script type="text/javascript">
    var timeout;


    function resetSessionTimeout() {
      clearTimeout(timeout);
      timeout = setTimeout(function () {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'logout.php', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            alerta2("Utilizador", "Sessão terminada após 15m de inatividade", "warning");
            setTimeout(function () {
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

  <script>
    const currentDateInput = document.getElementById("currentDateInput");
    const currentTimeInput = document.getElementById("currentTimeInput");

    function updateOptions() {
      const selectedDate = new Date(currentDateInput.value);
      const currentTime = new Date();
      currentTime.setMinutes(currentTime.getMinutes() + 30);


      if (selectedDate.toDateString() === currentTime.toDateString()) {
        const currentTimeValue = `${currentTime.getHours().toString().padStart(2, "0")}${currentTime.getMinutes().toString().padStart(2, "0")}`;
        const options = currentTimeInput.querySelectorAll("option");

        options.forEach(option => {
          const optionValue = option.value;
          if (optionValue <= currentTimeValue) {
            option.disabled = true;
            option.style.display = "none";
          } else {
            option.disabled = false;
            option.style.display = "block";
          }
        });
      } else {

        currentTimeInput.querySelectorAll("option").forEach(option => {
          option.disabled = false;
          option.style.display = "block";
        });
      }
    }


    updateOptions();
    currentDateInput.addEventListener("change", updateOptions);
  </script>


</body>

</html>
<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>