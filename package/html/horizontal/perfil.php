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
            <a href="#" class="text-nowrap nav-link mb-2">
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
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./hub.php">Comunidade</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-6" href="./marcacao.php">Marcação de Campos</a>
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
                    <div id="notifVotacao">
                    </div>
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
                      <img class="rounded-circle" width="35" height="35" alt="" id="perfil1" />
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
                      <a href="./perfil.php?id=<?php echo $_SESSION['id']?>" class="py-8 px-7 mt-8 d-flex align-items-center">
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
    <div class="body-wrapper">
      <div class="container-fluid">
        <div class="card overflow-hidden shadow">
          <div class="card-body p-0">
            <div class="image-container">
              <img alt="" id="fotoCapaView" class="img-fluid">
              <div class="icon-container">
                <i class="fas fa-pencil-alt text-white fs-6" data-toggle="tooltip" data-placement="top" title="Editar"
                  data-bs-toggle="modal" data-bs-target="#vertical-center-modal"></i>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-lg-4 order-lg-1 order-2 mt-2">
                <div class="container">
                  <h6 class="text-center fw-semibold">Modalidades</h6>
                  <ul class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center" id="mod">
                  </ul>
                </div>
              </div>
              <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                <div class="mt-n5">
                  <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle "
                      style="width: 160px; height: 160px; z-index: 1;" ;>
                      <div
                        class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                        style="width: 150px; height: 150px;" ;>
                        <img alt="" class="w-100 h-100" id="perfil3" style="z-index: 1;">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h5 class="fs-5 mb-0 fw-semibold" id="nomePerfil"></h5>
                    <p class="mb-0 fs-4">Padel</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 order-last mt-2">
                <div class="container">
                  <h6 class="text-center fw-semibold">Melhores conquistas</h6>
                  <div class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center">
                    <!-- Badge 1 -->
                    <div class="text-center">
                      <img src="../../dist/images/badges/p1000pnt.png" alt="Badge 1"
                        class="img-fluid mb-2 rounded hover-img" data-toggle="tooltip" data-placement="top"
                        title="1000 Pontos no Padel" style="max-width: 50px;">
                    </div>

                    <!-- Badge 2 -->
                    <div class="text-center">
                      <img src="../../dist/images/badges/t-250.png" alt="Badge 3"
                        class="img-fluid mb-2 rounded hover-img" data-toggle="tooltip" data-placement="top"
                        title="250 Pontos no Ténis" style="max-width: 50px;">
                    </div>

                    <!-- Badge 3 -->
                    <div class="text-center">
                      <img src="../../dist/images/badges/p-250.png" alt="Badge 3"
                        class="img-fluid mb-2 rounded hover-img" data-toggle="tooltip" data-placement="top"
                        title="250 Pontos no Padel" style="max-width: 50px;">
                    </div>

                    <!-- Badge 4 -->
                    <div class="text-center">
                      <img src="../../dist/images/badges/perc70.png" alt="Badge 2"
                        class="img-fluid mb-2 rounded hover-img" data-toggle="tooltip" data-placement="top"
                        title="% Vitórias" style="max-width: 50px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light rounded-2" id="pills-tab"
              role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                  id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                  aria-controls="pills-profile" aria-selected="true">
                  <i class="ti ti-home me-2 fs-6"></i>
                  <span class="d-none d-md-block">Geral</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                  id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button"
                  role="tab" aria-controls="pills-followers" aria-selected="false">
                  <i class="ti ti-chart-histogram me-2 fs-6"></i>
                  <span class="d-none d-md-block">Estatísticas</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                  id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab"
                  aria-controls="pills-friends" aria-selected="false">
                  <i class="ti ti-user-circle me-2 fs-6"></i>
                  <span class="d-none d-md-block">Amigos</span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                  id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab"
                  aria-controls="pills-gallery" aria-selected="false">
                  <i class="ti ti-award me-2 fs-6"></i>
                  <span class="d-none d-md-block">Conquistas</span>
                </button>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
            tabindex="0">
            <div class="row">
              <div class="col-lg-4">
                <div class="card shadow border">
                  <div class="card-body">
                    <h4 class="fw-semibold mb-3 pb-2 text-center fs-7 border-2 border-bottom border-light">Sobre Mim
                    </h4>
                    <p id="bio" class="mt-1"></p>
                    <ul class="list-unstyled mb-0">
                      <li class="d-flex align-items-center gap-3 mb-4">
                        <i class="ti ti-mail text-dark fs-6"></i>
                        <h6 class="fs-4 fw-semibold mb-0" id="email"></h6>
                      </li>
                      <li class="d-flex align-items-center gap-3 mb-2">
                        <i class="ti ti-map-pin text-dark fs-6"></i>
                        <h6 class="fs-4 fw-semibold mb-0" id="local"></h6>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="card shadow border">
                  <div class="card-body">
                    <h4 class="fw-semibold mb-3 pb-2 text-center fs-7 border-2 border-bottom border-light">Conquistas
                    </h4>
                    <div class="row">
                      <div class="col-4">
                        <img src="../../dist/images/badges/p1000pnt.png" alt="Badge 1"
                          class="rounded-2 img-fluid mb-3 hover-img" data-toggle="tooltip" data-placement="top"
                          title="1000 Pontos no Padel">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                      <div class="col-4">
                        <img src="../../dist/images/badges/t-250.png" alt="Bade 2" class="rounded-2 img-fluid hover-img"
                          data-toggle="tooltip" data-placement="top" title="250 Pontos no Ténis">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                      <div class="col-4">
                        <img src="../../dist/images/badges/p-250.png" alt="Badge 3"
                          class="rounded-2 img-fluid mb-3 hover-img" data-toggle="tooltip" data-placement="top"
                          title="250 Pontos no Padel">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                      <div class="col-4">
                        <img src="../../dist/images/badges/perc70.png" alt="Badge 4"
                          class="rounded-2 img-fluid mb-3 hover-img" data-toggle="tooltip" data-placement="top"
                          title="70% Vitórias">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                      <div class="col-4">
                        <img src="../../dist/images/badges/p50vit.png" alt="Badge 6"
                          class="rounded-2 img-fluid hover-img" data-toggle="tooltip" data-placement="top"
                          title="50 Vitórias no Padel">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                      <div class="col-4">
                        <img src="../../dist/images/badges/f30pnt.png" alt="Badge 5"
                          class="rounded-2 img-fluid hover-img" data-toggle="tooltip" data-placement="top"
                          title="30 Golos">
                        <p><span class="fw-semibold"></span></p>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card shadow border">
                  <div class="card-body">
                    <h4 class="fw-semibold mb-2 pb-2 text-center fs-7 border-2 border-bottom border-light">Comunidades
                    </h4>
                    <div class="row">
                      <div class="col-lg-12 col-md-6">
                        <div class="d-flex align-items-center mt-4">
                          <img src="../../dist/images/backgrounds/w.png" alt="Equipa 1" class="rounded-2 mb-3"
                            width="100" height="100">
                          <div class="ms-3">
                            <p><span class="fw-bolder fs-5">World Padel Club</span></p>
                            <span class="badge rounded-pill text-bg-primary"><i
                                class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                            <p class="mt-2"><span class="fw-bolder">Posição: </span>Esquerda</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-6">
                        <div class="d-flex align-items-center mt-2">
                          <img src="../../dist/images/backgrounds/padelball3.png" alt="Equipa 1" class="rounded-2 mb-3"
                            width="100" height="100">
                          <div class="ms-3">
                            <p><span class="fw-bolder fs-5">Padel Ball 3</span></p>
                            <span class="badge rounded-pill text-bg-primary"><i
                                class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-6">
                        <div class="d-flex align-items-center mt-2">
                          <img src="../../dist/images/backgrounds/98.png" alt="Equipa 1" class="rounded-2 mb-3"
                            width="100" height="100">
                          <div class="ms-3">
                            <p><span class="fw-bolder fs-5">ETC</span></p>
                            <span class="badge rounded-pill text-bg-success"><i
                                class="ti ti-ball-tennis me-1"></i><small>Ténis</small></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-6">
                        <div class="d-flex align-items-center mt-2">
                          <img src="../../dist/images/backgrounds/g.png" alt="Equipa 1" class="rounded-2 mb-3"
                            width="100" height="100">
                          <div class="ms-3">
                            <p><span class="fw-bolder fs-5">Futsal Geckos</span></p>
                            <span class="badge rounded-pill text-bg-danger"><i
                                class="ti ti-ball-football me-1"></i><small>Futsal</small></span>
                            <p class="mt-2"><span class="fw-bolder">Posição: </span>Extremo</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card shadow border">
                  <div class="card-body">
                    <h4 class="fw-semibold  mb-3 pb-2 text-center fs-7 border-2 border-bottom border-light">Jogos
                      Recentes</h4>
                    <div class="card shadow border hover-img">
                      <div class="card-body">
                        <div class="row mt-2">
                          <!-- Game 1 -->
                          <div class="col-md-3">
                            <img src="../../dist/images/backgrounds/pesquisa_campo5.jpg" alt="Game 1"
                              class="object-fit-cover rounded-2 border border-1 border-primary" width="150"
                              height="110">
                            <button class="btn btn-sm btn-primary mt-2 ms-2 ms-md-0"><i
                                class="ti ti-plus"></i>Info</button>
                          </div>
                          <div class="col-md-4 mt-2 mt-md-0">
                            <small class="fs-5">GDRAR vs 7Basket</small><br>
                            <small><i class="ti ti-calendar me-1"></i>15 Outubro, 2023</small><br>
                            <small><i class="ti ti-clock me-1"></i>15:00</small><br>
                            <small><i class="ti ti-map-pin me-1"></i>BLA</small><br>
                            <span class="badge rounded-pill text-bg-warning mt-2"><i
                                class="ti ti-ball-basketball me-1"></i><small>Basquetebol</small></span>
                          </div>
                          <div class="col-md-5 mt-2 mt-md-0">
                            <div class="row">
                              <small class="fs-3">Participantes</small><br>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img alt="Participant 1" id="perfil4" class="rounded-circle object-fit-cover"
                                    width="30" height="30">
                                  <small class="ms-2" id="nomeEquipa1"></small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/girl2.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Teresa Norte</small>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy12.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Gonçalo Nunes</small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy2.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Rui Paulo</small>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/girl5.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Ana Cruz</small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy6.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Fábio Santos</small>
                                </div>
                              </div>
                            </div>
                            <!-- Participants for Game 1 -->
                            <!-- Add more participants in a similar fashion -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card shadow border hover-img">
                      <div class="card-body">
                        <div class="row mt-2">
                          <!-- Game 1 -->
                          <div class="col-md-3">
                            <img src="../../dist/images/backgrounds/tomasz-krawczyk-M2x3A8Q4JbY-unsplash.jpg"
                              alt="Game 1" class="object-fit-cover rounded-2 border border-1 border-primary" width="150"
                              height="110">
                            <button class="btn btn-sm btn-primary mt-2 ms-2 ms-md-0"><i
                                class="ti ti-plus"></i>Info</button>
                          </div>
                          <div class="col-md-4 mt-2 mt-md-0">
                            <small class="fs-5">Equipa A vs Equipa B</small><br>
                            <small><i class="ti ti-calendar me-1"></i>22 Outubro, 2023</small><br>
                            <small><i class="ti ti-clock me-1"></i>18:30</small><br>
                            <small><i class="ti ti-map-pin me-1"></i>CEZ</small><br>
                            <span class="badge rounded-pill text-bg-primary mt-2"><i
                                class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                            <span class="ms-1 badge rounded-pill text-bg-light mt-2"><i
                                class="ti ti-users me-1"></i><small>Duplas</small></span>
                          </div>
                          <div class="col-md-5 mt-2 mt-md-0">
                            <div class="row">
                              <small class="fs-3">Participantes</small><br>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img alt="Participant 1" id="perfil5" class="rounded-circle object-fit-cover"
                                    width="30" height="30">
                                  <small class="ms-2" id="nomeEquipa2"></small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/girl3.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Catarina Ferreira</small>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy11.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">António Rui</small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/girl4.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Carolina Xavier</small>
                                </div>
                              </div>
                            </div>
                            <!-- Participants for Game 1 -->
                            <!-- Add more participants in a similar fashion -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card shadow border hover-img">
                      <div class="card-body">
                        <div class="row mt-2">
                          <!-- Game 1 -->
                          <div class="col-md-3">
                            <img src="../../dist/images/backgrounds/pesquisa_campo4.jpg" alt="Game 1"
                              class="object-fit-cover rounded-2 border border-1 border-primary" width="150"
                              height="110">
                            <button class="btn btn-sm btn-primary mt-2 ms-2 ms-md-0"><i
                                class="ti ti-plus"></i>Info</button>
                          </div>
                          <div class="col-md-4 mt-2 mt-md-0">
                            <small class="fs-5">António vs Rui</small><br>
                            <small><i class="ti ti-calendar me-1"></i>27 Outubro, 2023</small><br>
                            <small><i class="ti ti-clock me-1"></i>18:00</small><br>
                            <small><i class="ti ti-map-pin me-1"></i>CTI</small><br>
                            <span class="badge rounded-pill text-bg-success mt-2"><i
                                class="ti ti-ball-tennis me-1"></i><small>Ténis</small></span>
                            <span class="ms-1 badge rounded-pill text-bg-light mt-2"><i
                                class="ti ti-user me-1"></i><small>Individuais</small></span>
                          </div>
                          <div class="col-md-5 mt-2 mt-md-0">
                            <div class="row">
                              <small class="fs-3">Participantes</small><br>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img alt="Participant 1" id="perfil6" class="rounded-circle object-fit-cover"
                                    width="30" height="30">
                                  <small class="ms-2" id="nomeEquipa3"></small>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy2.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Rui Paulo</small>
                                </div>
                              </div>
                            </div>
                            <!-- Participants for Game 1 -->
                            <!-- Add more participants in a similar fashion -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card shadow border hover-img">
                      <div class="card-body">
                        <div class="row mb-1">
                          <!-- Game 1 -->
                          <div class="col-md-3">
                            <img src="../../dist/images/backgrounds/jonathan-petersson-ARU18GpF6QQ-unsplash.jpg"
                              alt="Game 1" class="object-fit-cover rounded-2 border border-1 border-primary" width="150"
                              height="110">
                            <button class="btn btn-sm btn-primary mt-2 ms-2 ms-md-0"><i
                                class="ti ti-plus"></i>Info</button>
                          </div>
                          <div class="col-md-4 mt-2 mt-md-0">
                            <small class="fs-5">SLE vs Juventude</small><br>
                            <small><i class="ti ti-calendar me-1"></i>30 Outubro, 2023</small><br>
                            <small><i class="ti ti-clock me-1"></i>21:00</small><br>
                            <small><i class="ti ti-map-pin me-1"></i>SLA</small><br>
                            <span class="badge rounded-pill text-bg-danger mt-2"><i
                                class="ti ti-ball-football me-1"></i><small>Futsal</small></span>
                          </div>
                          <div class="col-md-5 mt-2 mt-md-0">
                            <div class="row">
                              <small class="fs-3">Participantes</small><br>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img alt="Participant 1" id="perfil7" class="rounded-circle object-fit-cover"
                                    width="30" height="30">
                                  <small class="ms-2" id="nomeEquipa4"></small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy2.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Rui Paulo</small>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy6.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Fábio Santos</small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy9.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Paulo Chaves</small>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy12.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Gonçalo Nunes</small>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy10.jpg" alt="Participant 2"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Gonçalo Ricardo</small>
                                </div>
                              </div>
                            </div>
                            <!-- Participants for Game 1 -->
                            <!-- Add more participants in a similar fashion -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card shadow border hover-img">
                      <div class="card-body">
                        <div class="row mb-1">
                          <!-- Game 1 -->
                          <div class="col-md-3">
                            <img src="../../dist/images/backgrounds/pesquisa_campo3.jpg" alt="Game 1"
                              class="object-fit-cover rounded-2 border border-1 border-primary" width="150"
                              height="110">
                            <button class="btn btn-sm btn-primary mt-2 ms-2 ms-md-0"><i
                                class="ti ti-plus"></i>Info</button>
                          </div>
                          <div class="col-md-4 mt-2 mt-md-0">
                            <small class="fs-5">António vs Fábio</small><br>
                            <small><i class="ti ti-calendar me-1"></i>12 Outubro, 2023</small><br>
                            <small><i class="ti ti-clock me-1"></i>21:00</small><br>
                            <small><i class="ti ti-map-pin me-1"></i>CCP</small><br>
                            <span class="badge rounded-pill text-bg-primary mt-2"><i
                                class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                          </div>
                          <div class="col-md-5 mt-2 mt-md-0">
                            <div class="row">
                              <small class="fs-3">Participantes</small><br>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img alt="Participant 1" id="perfil8" class="rounded-circle object-fit-cover"
                                    width="30" height="30">
                                  <small class="ms-2" id="nomeEquipa5"></small>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="d-flex align-items-center mt-2">
                                  <img src="../../dist/images/profile/boy6.jpg" alt="Participant 1"
                                    class="rounded-circle object-fit-cover" width="30" height="30">
                                  <small class="ms-2">Fábio Santos</small>
                                </div>
                              </div>
                            </div>
                            <!-- Participants for Game 1 -->
                            <!-- Add more participants in a similar fashion -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                      <ul class="pagination me-3">
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
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab"
            tabindex="0">
            <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
              <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Estatísticas</h3>
              <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                  placeholder="Procurar Estatísticas">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
              </form>
            </div>
            <div class="row">
              <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 fw-semibold">2545</h4>
                        <p class="mb-0">Amigos</p>
                      </div>
                    </div>
                  </div>
                  <div id="widgest-chart-1"></div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-end justify-content-between mb-3">
                      <div>
                        <h4 class="mb-0 fw-semibold">15480</h4>
                        <p class="mb-0">Visualizações de Perfil</p>
                      </div>
                    </div>
                    <div id="widgest-chart-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                      <div>
                        <h4 class="mb-0 fw-semibold">4493</h4>
                        <p class="mb-0">Atletas Encontrados</p>
                      </div>
                    </div>
                  </div>
                  <div id="widgest-chart-3"></div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body p-4">
                    <div class="mb-7 pb-8">
                      <h4 class="mb-0 fw-semibold">1439</h4>
                      <p class="mb-0">Jogos Realizados</p>
                    </div>
                    <div id="widgest-chart-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                  <h5 class="card-title fw-semibold mb-0">Ranking</h5>
                </div>
                <div class="row">
                  <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                      <div class="card-body">
                        <div id="widgest-chart-5"></div>
                        <div class="d-flex align-items-end justify-content-between mt-7">
                          <div>
                            <p class="mb-1">Padel</p>
                            <h4 class="mb-0 fw-semibold">3657º</h4>
                            <div class="d-flex align-items-center pt-3">
                              <p class="fs-3 mb-0">2021</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                      <div class="card-body">
                        <div id="widgest-chart-6"></div>
                        <div class="d-flex align-items-end justify-content-between mt-7">
                          <div>
                            <p class="mb-1">Ténis</p>
                            <h4 class="mb-0 fw-semibold">8764º</h4>
                            <div class="d-flex align-items-center pt-3">
                              <p class="fs-3 mb-0">2022</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                      <div class="card-body">
                        <div id="current-year"></div>
                        <div class="d-flex align-items-end justify-content-between mt-7">
                          <div>
                            <p class="mb-1">Subidas</p>
                            <h4 class="mb-0 fw-semibold">248</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Vitórias</h5>
                        <h4 class="fw-semibold mb-2">895</h4>
                        <div class="d-flex align-items-center mb-7 pb-8">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="d-flex justify-content-center">
                          <div id="breakup"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body pb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <h5 class="card-title mb-0 fw-semibold"> Derrotas </h5>
                    </div>
                    <div class="d-flex align-items-center mb-7 pb-8">
                      <h4 class="fw-semibold mb-0 fs-7">394</h4>
                      <div class="d-flex align-items-center">
                      </div>
                    </div>
                    <div id="monthly-earning"></div>
                  </div>
                </div>
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                      <h5 class="card-title mb-0 fw-semibold"> Empates </h5>
                      <div>
                        <select class="form-select text-dark">
                          <option value="1">Março</option>
                          <option value="2">Abril</option>
                          <option value="3">Maio</option>
                        </select>
                      </div>
                    </div>
                    <div id="most-visited"></div>
                    <div class="d-flex align-items-center justify-content-center">
                      <div class="me-4">
                        <span class="round-8 rounded-circle me-2 d-inline-block"
                          style="background-color: #6AAD45;"></span>
                        <span>2022</span>
                      </div>
                      <div>
                        <span class="round-8 rounded-circle me-2 d-inline-block"
                          style="background-color: #F8CF29;"></span>
                        <span>2023</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <div>
                      <h5 class="card-title fw-semibold">Pontos</h5>
                      <div id="yearly-salary"></div>
                      <div class="d-flex align-items-center justify-content-between mt-3">
                        <div class="d-flex align-items-center">
                          <div>
                            <p class="fs-3 mb-0 fw-normal">Marcados</p>
                            <h6 class="fw-semibold text-dark fs-4 mb-0">2348</h6>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div>
                            <p class="fs-3 mb-0 fw-normal">Sofridos</p>
                            <h6 class="fw-semibold text-dark fs-4 mb-0">580</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body">
                    <h5 class="card-title fw-semibold mb-0">Golos</h5>
                    <div class="row align-items-center">
                      <div class="col-md-6">
                        <h4 class="fw-semibold mb-0 mt-4">36</h4>
                        <p class="mb-1 fs-2 mb-2">(Futebol / Futsal)</p>
                        <div class="d-flex align-items-center">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div id="impressions"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden">
                      <div class="card-body">
                        <p class="mb-1 fs-5">Padel</p>
                        <h4 class="fw-semibold">1854</h4>
                        <div class="d-flex align-items-center">
                          <p class="text-muted fs-3 mb-0">Pontos Ganhos </p>
                        </div>
                      </div>
                      <div id="customers"></div>
                    </div>
                  </div>
                  <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden">
                      <div class="card-body">
                        <p class="mb-1 fs-5">Ténis</p>
                        <h4 class="fw-semibold">348</h4>
                        <div class="d-flex align-items-center mb-2">
                          <p class="text-muted fs-3 mb-0">Jogos Realizados</p>
                        </div>
                        <div id="projects"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card w-100 position-relative overflow-hidden">
                  <div class="card-body pb-4">
                    <h5 class="card-title fw-semibold">Média de Votação</h5>
                    <p class="card-subtitle mb-4">Mensal</p>
                    <div class="d-flex align-items-center">
                      <div class="me-4">
                        <span class="round-8 rounded-circle me-2 d-inline-block"
                          style="background-color: #0779AB;"></span>
                        <span class="fs-2">Subidas</span>
                      </div>
                      <div>
                        <span class="round-8 rounded-circle me-2 d-inline-block"
                          style="background-color: #6AAD45;"></span>
                        <span class="fs-2">Descidas</span>
                      </div>
                    </div>
                    <div id="revenue-updates"></div>
                  </div>
                </div>
                <div class="card w-100">
                  <div class="card-body">
                    <h5 class="card-title fw-semibold">% Vitórias</h5>
                    <p class="card-subtitle mb-4">3 Principais Modalidades</p>
                    <div id="sales-overview"></div>
                    <div class="d-flex align-items-center justify-content-between mt-5 pb-2">
                      <div class="d-flex align-items-center">
                        <div>
                          <h6 class="fw-semibold text-dark fs-4 mb-0">683</h6>
                          <p class="fs-3 mb-0 fw-normal">Vitórias</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-center">
                        <div>
                          <h6 class="fw-semibold text-dark fs-4 mb-0">239</h6>
                          <p class="fs-3 mb-0 fw-normal">Derrotas</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab"
            tabindex="0">
            <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
              <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Amigos <span
                  class="badge text-bg-primary fs-2 rounded-4 py-1 px-2 ms-2 mt-1 badge-container">2545</span></h3>
              <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                  placeholder="Pesquisar Amigos">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
              </form>
            </div>
            <div class="row">
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">
                    <img src="../../dist/images/profile/boy.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">André Silva</h5>
                    <span class="text-dark fs-2">Futebol</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">
                    <img src="../../dist/images/profile/girl.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Joana Cruz</h5>
                    <span class="text-dark fs-2">Ténis</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">
                    <img src="../../dist/images/profile/boy2.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Rui Paulo</h5>
                    <span class="text-dark fs-2">Ténis</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy3.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Pedro Moura</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/girl2.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Irene Santos</h5>
                    <span class="text-dark fs-2">Futsal</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/girl3.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Andreia Ramos</h5>
                    <span class="text-dark fs-2">Futsal</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy4.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Afonso Lima</h5>
                    <span class="text-dark fs-2">Futebol</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy5.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Vitor Andrade</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy6.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Roberto João</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/girl4.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Lúcia Faria</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy7.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">António Borges</h5>
                    <span class="text-dark fs-2">Ténis</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy6.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Pedro Torres</h5>
                    <span class="text-dark fs-2">Futebol</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy8.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">João Chaves</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/girl5.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">

                    <h5 class="fw-semibold mb-0">Sara Luís</h5>
                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-6 col-lg-4">
                <div class="card hover-img">
                  <div class="card-body p-4 text-center border-bottom">

                    <img src="../../dist/images/profile/boy9.jpg" alt="" class="rounded-circle mb-3 object-fit-cover"
                      height="100" width="100">
                    <h5 class="fw-semibold mb-0">Francisco Correia</h5>

                    <span class="text-dark fs-2">Padel</span>
                  </div>
                  <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                    <li class="position-relative">
                      <a class="text-primary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold"
                        href="javascript:void(0)">
                        <i class="ti ti-plus"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-info d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-message"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-secondary d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-star"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-danger d-flex align-items-center justify-content-center p-2 fs-5 rounded-circle fw-semibold "
                        href="javascript:void(0)">
                        <i class="ti ti-square-x"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab"
            tabindex="0">
            <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-5">
              <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center fs-5">Conquistas <span
                  class="badge fs-2 rounded-4 py-1 px-2 ms-2 fs-5 badge-container fw-bosemiboldlder"
                  style="background-color: #63a340;">11
                  de 16</span></h3>
              <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                  placeholder="Pesquisar Conquistas">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
              </form>
            </div>
            <div class="badge-container2">
              <div class="row mb-0 pb-0 mt-5">
                <div class="col-12 text-center">
                  <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7">Padel <span
                      class="badge fs-2 fw-semibold rounded-4 py-1 px-2 ms-2 fs-7 badge-container"
                      style="background-color: #63a340;">6 de 6</span></h1>
                </div>
              </div>

              <div class="row mb-5 mt-5">
                <div class="carousel-container" id="carousel1">
                  <div class="owl-carousel">
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p50vit.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="50 Vitórias no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">50\50</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                              aria-valuemax="50" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="10 Pontos no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">10\10</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                              aria-valuemax="10" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="30 Pontos no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">30\30</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                              aria-valuemax="30" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p70pnt.png" alt="Badge 1" class="img-fluid rounded mt-1"
                            data-toggle="tooltip" data-placement="top" title="70 Pontos no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">70\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                              aria-valuemax="70" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p-250.png" alt="Badge 1" class="img-fluid rounded mt-1"
                            data-toggle="tooltip" data-placement="top" title="250 Pontos no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">250\250</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="250"
                              aria-valuemin="0" aria-valuemax="250" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/p1000pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded"
                            data-toggle="tooltip" data-placement="top" title="1000 Pontos no Padel"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">1000\1000</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="1000"
                              aria-valuemin="0" aria-valuemax="1000" style="width: 1000%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">70\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                              aria-valuemax="70" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="owl-prev" data-owl="prev" data-carousel="carousel1"><i
                      class="ti ti-chevron-left fs-10"></i></button>
                  <button class="owl-next" data-owl="next" data-carousel="carousel1"><i
                      class="ti ti-chevron-right fs-10"></i></button>
                </div>
              </div>

            </div>

            <div class="badge-container2">
              <div class="row mb-0 pb-0 mt-5">
                <div class="col-12 text-center">
                  <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7">Ténis <span
                      class="badge fs-2 rounded-4 py-1 px-2 ms-2 fs-7 badge-container fw-semibold"
                      style="background-color: #6AAD45;">5 de 6</span>
                  </h1>
                </div>
              </div>
              <div class="row mb-5 mt-5">
                <div class="carousel-container" id="carousel2">
                  <div class="owl-carousel">
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/19.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="10 Vitórias no Ténis"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">10\10</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                              aria-valuemax="50" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/t10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="10 Pontos no Ténis"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">10\10</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                              aria-valuemax="10" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/t30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="30 Pontos no Ténis"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">30\30</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                              aria-valuemax="30" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/t70pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded"
                            data-toggle="tooltip" data-placement="top" title="70 Pontos no Ténis"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">70\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                              aria-valuemax="70" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/t-250.png" alt="Badge 1" class="img-fluid rounded mt-1"
                            data-toggle="tooltip" data-placement="top" title="250 Pontos no Ténis"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">250\250</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="250"
                              aria-valuemin="0" aria-valuemax="250" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/t1000pnt.png" alt="Badge 1"
                            class="img-fluid mt-1 rounded opacity-50" data-toggle="tooltip" data-placement="top"
                            title="1000 Pontos no Ténis" style="max-width: 200px; filter: grayscale(36%);">
                          <h1 class="fs-5 fw-bolder">647\1000</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="647" aria-valuemin="0"
                              aria-valuemax="1000" style="width: 64%; background-color: #F8CF29;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">70\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                              aria-valuemax="70" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="owl-prev" data-owl="prev" data-carousel="carousel2"><i
                      class="ti ti-chevron-left fs-10"></i></button>
                  <button class="owl-next" data-owl="next" data-carousel="carousel2"><i
                      class="ti ti-chevron-right fs-10"></i></button>
                </div>
              </div>
            </div>

            <div class="badge-container2">
              <div class="row mb-0 pb-0 mt-5">
                <div class="col-12 text-center">
                  <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7">Futsal <span
                      class="badge fs-2 rounded-4 fw-semibold py-1 px-2 ms-2 fs-7 badge-container"
                      style="background-color: #f84b29;">2 de 6</span></h1>
                </div>
              </div>

              <div class="row mb-5 mt-5">
                <div class="carousel-container" id="carousel3">
                  <div class="owl-carousel">
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/20.png" alt="Badge 1"
                            class="img-fluid mb-2 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="30 Vitórias no Futsal" style="max-width: 200px; filter: grayscale(75%);">
                          <h1 class="fs-5 fw-bolder">12\30</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="12" aria-valuemin="0"
                              aria-valuemax="30" style="width: 38%; background-color: #F8CF29;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/f10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="10 Golos" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">10\10</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                              aria-valuemax="10" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/f30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="30 Golos" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">30\30</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                              aria-valuemax="30" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/f70pnt.png" alt="Badge 1"
                            class="img-fluid pt-2 rounded opacity-50" data-toggle="tooltip" data-placement="top"
                            title="70 Golos" style="max-width: 200px; filter: grayscale(50%);">
                          <h1 class="fs-5 fw-bolder">35\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0"
                              aria-valuemax="70" style="width: 50%; background-color: #F8CF29;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/f-100.png" alt="Badge 1"
                            class="img-fluid pt-2 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="100 Golos" style="max-width: 200px; filter: grayscale(50%);">
                          <h1 class="fs-5 fw-bolder">35\100</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0"
                              aria-valuemax="100" style="width: 35%; background-color: #f88629;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/f-250.png" alt="Badge 1"
                            class="img-fluid mt-1 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="200 Golos no Futsal" style="max-width: 200px; filter: grayscale(75%);">
                          <h1 class="fs-5 fw-bolder">35\200</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="35" aria-valuemin="0"
                              aria-valuemax="200" style="width: 17%; background-color: #f44028;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">20\20</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                              aria-valuemax="20" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="owl-prev" data-owl="prev" data-carousel="carousel3"><i
                      class="ti ti-chevron-left fs-10"></i></button>
                  <button class="owl-next" data-owl="next" data-carousel="carousel3"><i
                      class="ti ti-chevron-right fs-10"></i></button>
                </div>
              </div>

            </div>
            <div class="badge-container2">
              <div class="row mb-0 pb-0 mt-5">
                <div class="col-12 text-center">
                  <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7">Basquetebol <span
                      class="badge fs-2 rounded-4 py-1 fw-semibold px-2 ms-2 fs-7 badge-container"
                      style="background-color: firebrick;">1 de 6</span></h1>
                </div>
              </div>


              <div class="row mb-5 mt-5">
                <div class="carousel-container" id="carousel4">
                  <div class="owl-carousel">
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/30.png" alt="Badge 1"
                            class="img-fluid mb-2 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="50 Vitórias no Basquetebol" style="max-width: 200px; filter: grayscale(100%);">
                          <h1 class="fs-5 fw-bolder">5\50</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                              aria-valuemax="50" style="width: 10%; background-color: firebrick;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/b10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="10 Pontos no Basquetebol"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">10\10</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                              aria-valuemax="10" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/b30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="30 Pontos no Basquetebol"
                            style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">25\30</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                              aria-valuemax="30" style="width: 86%;  background-color: #63a340;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/b70pnt.png" alt="Badge 1"
                            class="img-fluid mb-2 rounded opacity-50" data-toggle="tooltip" data-placement="top"
                            title="70 Pontos no Basquetebol" style="max-width: 200px; filter: grayscale(75%);">
                          <h1 class="fs-5 fw-bolder">25\70</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                              aria-valuemax="70" style="width: 36%; background-color: #f87c29;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                          <img src="../../dist/images/badges/b-250.png" alt="Badge 1"
                            class="img-fluid mt-1 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="250 Pontos no Basquetebol" style="max-width: 200px; filter: grayscale(90%);">
                          <h1 class="fs-5 fw-bolder">25\250</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                              aria-valuemax="250" style="width: 10%; background-color: firebrick"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img shadow ">
                          <img src="../../dist/images/badges/b1000pnt.png" alt="Badge 1"
                            class="img-fluid mt-1 rounded opacity-25" data-toggle="tooltip" data-placement="top"
                            title="1000 Pontos no Basquetebol" style="max-width: 200px; filter: grayscale(97%);">
                          <h1 class="fs-5 fw-bolder">25\1000</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                              aria-valuemax="1000" style="width: 3%; background-color: firebrick"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="mt-1">
                        <div
                          class="card px-5 py-5 d-flex flex-column align-items-center justify-content-center hover-img text-center shadow">
                          <img src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded"
                            data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                          <h1 class="fs-5 fw-bolder">20\20</h1>
                          <div class="progress" style="height: 15px;">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                              aria-valuemax="20" style="width: 100%;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="owl-prev" data-owl="prev" data-carousel="carousel4"><i
                      class="ti ti-chevron-left fs-10"></i></button>
                  <button class="owl-next" data-owl="next" data-carousel="carousel4"><i
                      class="ti ti-chevron-right fs-10"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
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
  </div>
  </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
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
            <a class="sidebar-link" href="#" aria-expanded="false">
              <span>
                <i class="ti ti-home"></i>
              </span>
              <span class="hide-menu">Home</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="marcacao_editavel.php" aria-expanded="false">
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



  <div class="modal fade" id="vertical-center-modal" tabindex="-1" aria-labelledby="vertical-center-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title">
            Alterar foto de capa
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 mb-3">
            <label for="fotoCapa" class="form-label">Fotografia de capa</label>
            <input class="form-control" type="file" id="fotoCapa" name="fotoCapa">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary text-primary font-medium waves-effect text-start"
            onclick="altFotoCapa()" data-bs-dismiss="modal">
            Guardar
          </button>
          <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start"
            data-bs-dismiss="modal">
            Fechar
          </button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="scroll-long-inner-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id = "corpoModal">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start"
           data-bs-dismiss="modal" id= "guardarVotacao">
            Guardar
          </button>
          <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start"
            data-bs-dismiss="modal">
            Fechar
          </button>
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

  <script src="../../dist/js/custom.js"></script>
  <!-- current page js files -->
  <script src="../../dist/js/js_courtify/sweatalert.js"></script>
  <script src="../../dist/js/js_courtify/perfilUser.js"></script>
  <script src="../../dist/js/js_courtify/notificacao.js"></script>
  <script src="../../dist/js/js_courtify/user.js"></script>
  <script src="../../../landingpage/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../dist/js/widgets-charts.js"></script>


  <script>
    $(function () {
      $("[data-toggle = 'tooltip']").tooltip();
    });
  </script>

  <script>
    $(document).ready(function () {

      $(".owl-carousel").each(function () {
        var carouselId = $(this).closest(".carousel-container").attr("id");
        $(this).owlCarousel({
          items: 3,
          margin: 20,
          loop: true,
          nav: false,
          autoplay: true,
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

  <script type="text/javascript">
    var timeout;


    function resetSessionTimeout() {
      clearTimeout(timeout);
      timeout = setTimeout(function () {

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'logout.php', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            alerta2("Alerta", "Sessão terminada após 15m de inatividade", "warning");
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

  <style>
    .selected-img {
      border: 6px solid #63a340;
    }
  </style>

  <script>
    var selectedImage = null;

    function toggleImageSelection(imgElement) {

      if (imgElement.classList.contains('selected-img')) {
        imgElement.classList.remove('selected-img');
        selectedImage = null;
      } else {

        if (selectedImage) {
          selectedImage.classList.remove('selected-img');
        }
        
        imgElement.classList.add('selected-img');


        selectedImage = imgElement;
      }
    }
  </script>

</body>

</html>
<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>