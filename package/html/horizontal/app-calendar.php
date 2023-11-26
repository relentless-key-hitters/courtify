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
  <meta name="description" content="Courtify" />
  <meta name="author" content="" />
  <meta name="keywords" content="Courtify" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/favicon.ico" />
  <!-- Owl Carousel -->
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
    <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!-- Body Wrapper -->
  <div class="page-wrapper overflow-hidden" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6"
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
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
          <li class="nav-item dropdown">
            <a class="nav-link fs-6 dropdown-toggle" href="#" id="hubDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Comunidade
            </a>
            <div class="dropdown-menu border border-1 border-primary" aria-labelledby="hubDropdown">

              <a class="dropdown-item fs-4" href="./hub.php">Hub</a>
              <a class="dropdown-item fs-4" href="#">Item 2</a>

            </div>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./marcacao_editavel.php">Marcação de Campos</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./descobrir.php">Descobrir</a>
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
                      <a href="./app-notes.html" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                          <i class="ti ti-chart-histogram fs-7 text-primary"></i>
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                          <h6 class="mb-1 bg-hover-primary fw-semibold">Estatísticas</h6>
                        </div>
                      </a>
                      <a href="./app-calendar.html" class="py-8 px-7 d-flex align-items-center">
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
  </div>

  <!-- Header End -->


  <!-- Main wrapper -->

  <div class="row">
    <div class="col-lg-12" style="position: relative; margin-top: 80px;">
      <div style="position: absolute; top: 5px; right: 16px; z-index: 1;">
        <img src="../../dist/images/logos/logo_icone.png" style="max-width: 70px;">
      </div>
      <img class="img-fluid"
        src="../../dist/images/backgrounds/max-bohme-DRwfzyyKw1s-unsplash.jpg"
        style="width: 100%; max-width: 100%; height: 600px; object-fit: cover; filter: brightness(70%);">
      <div
        style="position: absolute; top: 17%; transform: translateY(-50%); left: 10%; text-align: center; color: white;">
        <h1 class="text-white fw-bolder"
          style="letter-spacing: 1px; font-size: 90px">
          Calendário</h1>
        <p class="text-white lead lead-md-2 lead-lg-1"
          style="letter-spacing: 1px; font-size: 40px">
          Nunca te esqueças do próximo jogo </p>
      </div>
    </div>
  </div>

  <div class="body-wrapper mb-5" style="margin: 120px;">
    <div class="row">
      <!-- Left Side: Cards -->
      <div class="col-lg-3 text-center">
        <div class="card shadow" style="margin-top: 15px;">
          <div class="container-fluid">
            <h1 class="fw-semibold fs-7 mt-4">Próximos Jogos</h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-hover align-items-center shadow" style="margin: 30px;">
                <img src="../../dist/images/backgrounds/comunidade4.png" class="card-img-top object-fit-cover"
                  alt="Placeholder Image 1" style="max-width: 190px;">
                <div class="card-body">
                  <h5 class="card-title fs-8">Padel</h5>
                  <p class="card-text fs-7">Sexta-Feira (10/11) 18:30</p>
                  <p class="card-text fs-5">ESC Padel Indoor</p>
                  <a href="#" class="btn btn-primary">Mais Info</a>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="card card-hover align-items-center shadow" style="margin: 30px;">
                <img src="../../dist/images/backgrounds/98.png" class="card-img-top object-fit-cover"
                  alt="Placeholder Image 2" style="max-width: 190px;">
                <div class="card-body">
                  <h5 class="card-title fs-8">Ténis</h5>
                  <p class="card-text fs-7">Terça-Feira (14/11) 19:30</p>
                  <p class="card-text fs-5">ETC Outdoor</p>
                  <a href="#" class="btn btn-primary">Mais Info</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Right Side: Calendar -->
      <div class="col-lg-9 text-center">
        <div class="card mt-3 shadow">
          <div class="container pt-2">
          <h1 class="fw-semibold fs-11">Calendário</h1>
          </div>
          <div class="p-4 calender-sidebar app-calendar">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>







  <!-- BEGIN MODAL -->
  <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">
            Adicionar / Editar Evento
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="">
                <label class="form-label">Título do Evento</label>
                <input id="event-title" type="text" class="form-control" />
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <div><label class="form-label">Importância do Evento (cor)</label></div>
              <div class="d-flex">
                <div class="n-chk">
                  <div class="form-check form-check-warning form-check-inline">
                    <input class="form-check-input" type="radio" name="event-level" value="Success" id="modalSuccess" />
                    <label class="form-check-label" for="modalSuccess">Verde</label>
                  </div>
                </div>
                <div class="n-chk">
                  <div class="form-check form-check-danger form-check-inline">
                    <input class="form-check-input" type="radio" name="event-level" value="Warning" id="modalWarning" />
                    <label class="form-check-label" for="modalWarning">Laranja</label>
                  </div>
                </div>
                <div class="n-chk">
                  <div class="form-check form-check-primary form-check-inline">
                    <input class="form-check-input" type="radio" name="event-level" value="Danger" id="modalDanger" />
                    <label class="form-check-label" for="modalDanger">Vermelho</label>
                  </div>
                </div>
                <div class="n-chk">
                  <div class="form-check form-check-success form-check-inline">
                    <input class="form-check-input" type="radio" name="event-level" value="Primary" id="modalPrimary" />
                    <label class="form-check-label" for="modalPrimary">Azul</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 d-none">
              <div class="">
                <label class="form-label">Data de Início</label>
                <input id="event-start-date" type="text" class="form-control" />
              </div>
            </div>

            <div class="col-md-12 d-none">
              <div class="">
                <label class="form-label">Data de Término</label>
                <input id="event-end-date" type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal">
            Fechar
          </button>
          <button type="button" class="btn btn-success btn-update-event" data-fc-event-public-id="">
            Atualizar
          </button>
          <button type="button" class="btn btn-primary btn-add-event">
            Adicionar
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL -->
  </div>
  </div>
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

  <!-- --------------------------------------------------- -->
  <!-- Customizer -->
  <!-- --------------------------------------------------- -->

  <!-- ---------------------------------------------- -->
  <!-- Customizer -->
  <!-- ---------------------------------------------- -->

  <!-- ---------------------------------------------- -->
  <!-- Import Js Files -->
  <!-- ---------------------------------------------- -->
  <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../dist/libs/jquery-ui/dist/jquery-ui.min.js"></script>
  <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
  <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ---------------------------------------------- -->
  <!-- core files -->
  <!-- ---------------------------------------------- -->
  <script src="../../dist/js/app.min.js"></script>
  <script src="../../dist/js/app.horizontal.init.js"></script>
  <script src="../../dist/js/app-style-switcher.js"></script>
  <script src="../../dist/js/sidebarmenu.js"></script>

  <script src="../../dist/js/custom.js"></script>
  <script src="../../dist/libs/prismjs/prism.js"></script>
  <script src="../../dist/js/js_courtify/perfilUser.js"></script>

  <!-- ---------------------------------------------- -->
  <!-- current page js files -->
  <!-- ---------------------------------------------- -->

  <script src="../../dist/libs/fullcalendar/index.global.min.js"></script>
  <script src="../../dist/js/apps/calendar-init.js"></script>


</body>

</html>

<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>