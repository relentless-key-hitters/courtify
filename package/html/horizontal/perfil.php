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
              <a href="#" class="text-nowrap nav-link mb-2">
                <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo" width="180" alt="" />
                <img src="../../dist/images/logos/light-logo.svg" class="light-logo" width="180" alt="" />
              </a>
            </li>
            <li class="nav-item d-none d-xl-block mt-1">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                          <h5 class="mb-1 fs-3" id="nome2"></h5>
                          <span class="mb-1 d-block text-dark">Padel</span>
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
      <div class="body-wrapper">
        <div class="container-fluid">
          <div class="card overflow-hidden shadow">
            <div class="card-body p-0">
              <div class="image-container">
                <img alt="" id="fotoCapaView" class="img-fluid">
                <div class="icon-container" id="iconAlterarFoto">

                </div>
              </div>
              <div class="row align-items-center">
                <div class="col-lg-3 mt-2">
                  <div class="container">
                    <h6 class="text-center fw-semibold">Modalidades</h6>
                    <ul class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center" id="mod">
                    </ul>
                  </div>
                </div>
                <div class="col-lg-2 mt-2">
                  <div class="container">
                    <div class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center" id="botaoAdicionarAmigo">

                    </div>
                  </div>
                </div>
                <div class="col-lg-2 mt-0 mt-lg-n3">
                  <div class="mt-0 mt-lg-n5">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                      <div class="d-flex align-items-center justify-content-center rounded-circle " style="width: 160px; height: 160px; z-index: 1;" ;>
                        <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 150px; height: 150px;" ;>
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
                <div class="col-lg-2 mt-2">
                  <div class="container">
                    <div class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center" id="botaoMensagemAmigo">

                    </div>
                  </div>
                </div>
                <div class="col-lg-3 mt-2">
                  <div class="container">
                    <h6 class="text-center fw-semibold">Melhores conquistas</h6>
                    <div class="d-flex align-items-center mb-1 mt-3 gap-3 justify-content-center" id = "melhoresBadges">
                    </div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light rounded-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                    <i class="ti ti-home me-2 fs-6"></i>
                    <span class="d-none d-md-block">Geral</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
                    <i class="ti ti-chart-histogram me-2 fs-6"></i>
                    <span class="d-none d-md-block">Estatísticas</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
                    <i class="ti ti-user-circle me-2 fs-6"></i>
                    <span class="d-none d-md-block">Amigos</span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
                    <i class="ti ti-award me-2 fs-6"></i>
                    <span class="d-none d-md-block">Conquistas</span>
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
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
                      <h4 class="fw-semibold mb-3 pb-2 text-center fs-7 border-2 border-bottom border-light">Conquistas Recentes
                      </h4>
                      <div class="row" id="badgesRecentes">
                        
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
                            <img src="../../dist/images/backgrounds/w.png" alt="Equipa 1" class="rounded-2 mb-3" width="100" height="100">
                            <div class="ms-3">
                              <p><span class="fw-bolder fs-5">World Padel Club</span></p>
                              <span class="badge rounded-pill text-bg-primary"><i class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                              <p class="mt-2"><span class="fw-bolder">Posição: </span>Esquerda</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                          <div class="d-flex align-items-center mt-2">
                            <img src="../../dist/images/backgrounds/padelball3.png" alt="Equipa 1" class="rounded-2 mb-3" width="100" height="100">
                            <div class="ms-3">
                              <p><span class="fw-bolder fs-5">Padel Ball 3</span></p>
                              <span class="badge rounded-pill text-bg-primary"><i class="ti ti-ball-tennis me-1"></i><small>Padel</small></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                          <div class="d-flex align-items-center mt-2">
                            <img src="../../dist/images/backgrounds/98.png" alt="Equipa 1" class="rounded-2 mb-3" width="100" height="100">
                            <div class="ms-3">
                              <p><span class="fw-bolder fs-5">ETC</span></p>
                              <span class="badge rounded-pill text-bg-success"><i class="ti ti-ball-tennis me-1"></i><small>Ténis</small></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-6">
                          <div class="d-flex align-items-center mt-2">
                            <img src="../../dist/images/backgrounds/g.png" alt="Equipa 1" class="rounded-2 mb-3" width="100" height="100">
                            <div class="ms-3">
                              <p><span class="fw-bolder fs-5">Futsal Geckos</span></p>
                              <span class="badge rounded-pill text-bg-danger"><i class="ti ti-ball-football me-1"></i><small>Futsal</small></span>
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
                      <h4 class="fw-semibold  mb-3 pb-2 text-center fs-7 border-2 border-bottom border-light">Jogos Recentes</h4>
                      <div id="jogosRecentes">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
              <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Estatísticas</h3>
              </div>
              <div id="estatisticasPadel" class="d-none">
                <div class="row">
                  <div class="col-md-12 text-center pb-5">
                    <span class="badge rounded-pill text-bg-primary fw-semibold fs-7">
                      <i class="ti ti-ball-tennis me-1"></i>
                      <small class="me-1">Padel</small>
                    </span>
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Ranking <span class="ti ti-chart-bar fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="rankingPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Pontuação <span class="ti ti-ball-tennis fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="pontuacaoPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Jogos <span class="ti ti-device-gamepad-2 fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nJogosPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">% Vitórias <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="percVitPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Sets Ganhos <span class="ti ti-trophy-filled fs-5"></span>
                            </h4>
                            <p class="pt-2 fs-9" id="nSetsGanhosPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Média Jogos Ganhos/Set <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="mediaVitSetPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Média Sets Ganhos <span class="ti ti-trophy-filled fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="mediaSetsGanhosPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">MVP's <span class="ti ti-award fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nMvpPadel"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                      <h5 class="card-title fw-semibold mb-0">Gráficos</h5>
                    </div>
                    <div class="row">
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="radarPadel"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barPadel"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barPadel2"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="estatisticasTenis" class="d-none">
                <div class="row">
                  <div class="col-md-12 text-center pb-5">
                    <span class="badge rounded-pill text-bg-success fw-semibold fs-7">
                      <i class="ti ti-ball-tennis me-1"></i>
                      <small class="me-1">Ténis</small>
                    </span>
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Ranking <span class="ti ti-chart-bar fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="rankingTenis"> 36827º</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Pontuação <span class="ti ti-ball-tennis fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="pontuacaoTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Jogos <span class="ti ti-device-gamepad-2 fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nJogosTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">% Vitórias <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="percVitTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Sets Ganhos <span class="ti ti-trophy-filled fs-5"></span>
                            </h4>
                            <p class="pt-2 fs-9" id="nSetsGanhosTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Média Jogos Ganhos/Set <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="mediaVitSetTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Média Sets Ganhos <span class="ti ti-trophy-filled fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="mediaSetsGanhosTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-sm-6 col-lg-3 d-flex align-items-stretch">
                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">MVP's <span class="ti ti-award fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nMvpTenis"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                      <h5 class="card-title fw-semibold mb-0">Gráficos</h5>
                    </div>
                    <div class="row">
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="radarTenis"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barTenis"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barTenis2"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="estatisticasBasquetebol" class="d-none">
                <div class="row">
                  <div class="col-md-12 text-center pb-5">
                    <span class="badge rounded-pill text-bg-warning fw-semibold fs-7">
                      <i class="ti ti-ball-basketball me-1"></i>
                      <small class="me-1">Basquetebol</small>
                    </span>
                  </div>
                </div>

                <div class="row">
                  <div class="d-flex justify-content-between gap-4">


                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Ranking <span class="ti ti-chart-bar fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="rankingBasq"> 36827º</p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Pontuação <span class="ti ti-ball-basketball fs-5"></span>
                            </h4>
                            <p class="pt-2 fs-9" id="pontuacaoBasq"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Jogos <span class="ti ti-shoe fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nJogosBasq"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">% Vitórias <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="percVitBasq"></p>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">MVP's <span class="ti ti-award fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nMvpBasq"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                      <h5 class="card-title fw-semibold mb-0">Gráficos</h5>
                    </div>
                    <div class="row">
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="radarBasket"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barBasket"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barBasket2"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="estatisticasFutsal" class="d-none">
                <div class="row">
                  <div class="col-md-12 text-center pb-5">
                    <span class="badge rounded-pill text-bg-danger fw-semibold fs-7">
                      <i class="ti ti-ball-football me-1"></i>
                      <small class="me-1">Futsal</small>
                    </span>
                  </div>
                </div>

                <div class="row">
                  <div class="d-flex justify-content-between gap-4">

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Ranking <span class="ti ti-chart-bar fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="rankingFutsal"> 36827º</p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Pontuação <span class="ti ti-ball-football fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="pontuacaoFutsal"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">Jogos <span class="ti ti-soccer-field fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nJogosFutsal"></p>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">% Vitórias <span class="ti ti-trophy fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="percVitFutsal"></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card w-100 position-relative overflow-hidden card-hover shadow">
                      <div class="card-body">
                        <div class="d-flex align-items-end justify-content-between">
                          <div>
                            <h4 class="mb-0 fw-semibold fs-5">MVP's <span class="ti ti-award fs-5"></span></h4>
                            <p class="pt-2 fs-9" id="nMvpFutsal"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="card">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                      <h5 class="card-title fw-semibold mb-0">Gráficos</h5>
                    </div>
                    <div class="row">
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="radarFutsal"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barFutsal"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 d-flex align-items-stretch">
                        <div class="card w-100 position-relative overflow-hidden mb-7 mb-lg-0">
                          <div class="card-body">
                            <div id="barFutsal2"></div>
                            <div class="d-flex align-items-end justify-content-between mt-7">
                              <div>
                                <p class="mb-1">Descrição</p>
                                <h4 class="mb-0 fw-semibold">Descrição Adicional</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
              <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Amigos <span class="badge text-bg-primary fs-2 rounded-4 py-1 px-2 ms-2 mt-1 badge-container" id="contagemAmigos"></span>
                </h3>
                <div class="position-relative">
                  <input type="text" class="form-control search-chat py-2 ps-5" id="pesquisaAmigos" placeholder="Pesquisar Amigos">
                  <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                </div>
              </div>
              <div class="row" id="amigosUtilizador">

              </div>
            </div>
            <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
              <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-5">
                <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Conquistas <span class="badge bg-primary fs-2 rounded-4 py-1 px-2 ms-2 fs-5 badge-container" id="numeroConquistasTotais">11
                    de 16</span></h3>
              </div>
              <div id="badgesPadel" class="d-none">
                <div class="badge-container2">
                  <div class="row mb-0 pb-0 mt-5">
                    <div class="col-12 text-center">
                      <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7"><i class="ti ti-ball-tennis me-1"></i>Padel <span class="badge fs-2 fw-semibold rounded-4 py-1 px-2 ms-2 fs-7 badge-container" id="contagemPadel"></span></h1>
                    </div>
                  </div>

                  <div class="row mb-5 mt-5">
                    <div class="carousel-container" id="carousel1">
                      <div class="owl-carousel">
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>20 Vitórias</h5>
                              <img id="imgPVit20" src="../../dist/images/badges/padel/vitorias/p20vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP20Vit">10/20</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP20Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>50 Vitórias</h5>
                              <img id="imgPVit50" src="../../dist/images/badges/padel/vitorias/p50vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP50Vit">20/50</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP50Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>100 Vitórias</h5>
                              <img id="imgPVit100" src="../../dist/images/badges/padel/vitorias/p100vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="100 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP100Vit">50\100</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP100Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>150 Vitórias</h5>
                              <img id="imgPVit150" src="../../dist/images/badges/padel/vitorias/p150vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="150 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP150Vit">50\150</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP150Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>200 Vitórias</h5>
                              <img id="imgPVit200" src="../../dist/images/badges/padel/vitorias/p200vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="200 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP200Vit">50\200</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP200Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>10 Pontos</h5>
                              <img id="imgP10Pnt" src="../../dist/images/badges/padel/pontos/p10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="10 Pontos no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP10Pnt">10\10</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP10Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>30 Pontos</h5>
                              <img id="imgP30Pnt" src="../../dist/images/badges/padel/pontos/p30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="30 Pontos no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP30Pnt">30\30</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP30Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>70 Pontos</h5>
                              <img id="imgP70Pnt" src="../../dist/images/badges/padel/pontos/p70pnt.png" alt="Badge 1" class="img-fluid rounded mt-1" data-toggle="tooltip" data-placement="top" title="70 Pontos no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP70Pnt">70\70</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP70Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>250 Pontos</h5>
                              <img id="imgP250Pnt" src="../../dist/images/badges/padel/pontos/p250pnt.png" alt="Badge 1" class="img-fluid rounded mt-1" data-toggle="tooltip" data-placement="top" title="250 Pontos no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP250Pnt">250\250</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP250Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>1000 Pontos</h5>
                              <img id="imgP1000Pnt" src="../../dist/images/badges/padel/pontos/p1000pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="1000 Pontos no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeP1000Pnt">1000\1000</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarP1000Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc20P" src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc20"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc20" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>50% Vitórias</h5>
                              <img id="imgPerc50P" src="../../dist/images/badges/perc50.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc50"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc50" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>70% Vitórias</h5>
                              <img id="imgPerc70P" src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc70"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc70" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="owl-prev" data-owl="prev" data-carousel="carousel1"><i class="ti ti-chevron-left fs-10"></i></button>
                      <button class="owl-next" data-owl="next" data-carousel="carousel1"><i class="ti ti-chevron-right fs-10"></i></button>
                    </div>
                  </div>

                </div>
              </div>
              <div id="badgesTenis" class="d-none">
                <div class="badge-container2">
                  <div class="row mb-0 pb-0 mt-5">
                    <div class="col-12 text-center">
                      <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7"><i class="ti ti-ball-tennis me-1"></i>Ténis <span class="badge fs-2 rounded-4 py-1 px-2 ms-2 fs-7 badge-container fw-semibold" style="background-color: #6AAD45;" id="contagemTenis"></span>
                      </h1>
                    </div>
                  </div>
                  <div class="row mb-5 mt-5">
                    <div class="carousel-container" id="carousel2">
                      <div class="owl-carousel">
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>20 Vitórias</h5>
                              <img id="imgTVit20" src="../../dist/images/badges/tenis/vitorias/t20vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT20Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT20Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>50 Vitórias</h5>
                              <img id="imgTVit50" src="../../dist/images/badges/tenis/vitorias/t50vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT50Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT50Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>100 Vitórias</h5>
                              <img id="imgTVit100" src="../../dist/images/badges/tenis/vitorias/t100vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="100 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT100Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT100Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                             <small>Vitórias</small>
                              <h5>150 Vitórias</h5>
                              <img id="imgTVit150" src="../../dist/images/badges/tenis/vitorias/t150vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="150 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT150Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT150Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>200 Vitórias</h5>
                              <img id="imgTVit200" src="../../dist/images/badges/tenis/vitorias/t200vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="200 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT200Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT200Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>10 Pontos</h5>
                              <img id="imgT10Pnt" src="../../dist/images/badges/tenis/pontos/t10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="10 Pontos no Ténis" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT10Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT10Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>30 Pontos</h5>
                              <img id="imgT30Pnt" src="../../dist/images/badges/tenis/pontos/t30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="30 Pontos no Ténis" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT30Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT30Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>70 Pontos</h5>
                              <img id="imgT70Pnt" src="../../dist/images/badges/tenis/pontos/t70pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="70 Pontos no Ténis" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT70Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT70Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>250 Pontos</h5>
                              <img id="imgT250Pnt" src="../../dist/images/badges/tenis/pontos/t250pnt.png" alt="Badge 1" class="img-fluid rounded mt-1" data-toggle="tooltip" data-placement="top" title="250 Pontos no Ténis" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT250Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT250Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>1000 Pontos</h5>
                              <img id="imgT1000Pnt" src="../../dist/images/badges/tenis/pontos/t1000pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="1000 Pontos no Ténis" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeT1000Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarT1000Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc20T" src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc20T"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc20T" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>50% Vitórias</h5>
                              <img id="imgPerc50T" src="../../dist/images/badges/perc50.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc50T"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc50T" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>70% Vitórias</h5>
                              <img id="imgPerc70T" src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc70T"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc70T" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="owl-prev" data-owl="prev" data-carousel="carousel2"><i class="ti ti-chevron-left fs-10"></i></button>
                      <button class="owl-next" data-owl="next" data-carousel="carousel2"><i class="ti ti-chevron-right fs-10"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="badgesFutsal" class="d-none">
                <div class="badge-container2">
                  <div class="row mb-0 pb-0 mt-5">
                    <div class="col-12 text-center">
                      <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7"><i class="ti ti-ball-football me-1"></i>Futsal <span class="badge fs-2 rounded-4 fw-semibold py-1 px-2 ms-2 fs-7 badge-container" style="background-color: #f84b29;" id="contagemFutsal"></span></h1>
                    </div>
                  </div>

                  <div class="row mb-5 mt-5">
                    <div class="carousel-container" id="carousel3">
                      <div class="owl-carousel">
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>20 Vitórias</h5>
                              <img id="imgFVit20" src="../../dist/images/badges/futsal/vitorias/f20vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF20Vit">20/20</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF20Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>50 Vitórias</h5>
                              <img id="imgFVit50" src="../../dist/images/badges/futsal/vitorias/f50vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF50Vit">20/50</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF50Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>100 Vitórias</h5>
                              <img id="imgFVit100" src="../../dist/images/badges/futsal/vitorias/f100vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="100 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF100Vit">50\100</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF100Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>150 Vitórias</h5>
                              <img id="imgFVit150" src="../../dist/images/badges/futsal/vitorias/f150vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="150 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF150Vit">50\150</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF150Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>200 Vitórias</h5>
                              <img id="imgFVit200" src="../../dist/images/badges/futsal/vitorias/f200vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="200 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF200Vit">50\200</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF200Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Golos</small>
                              <h5>10 Golos</h5>
                              <img id="imgF10Pnt" src="../../dist/images/badges/futsal/pontos/f10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="10 Golos" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF10Pnt">10\10</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF10Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Golos</small>
                              <h5>30 Golos</h5>
                              <img id="imgF30Pnt" src="../../dist/images/badges/futsal/pontos/f30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="30 Golos" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF30Pnt">30\30</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF30Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Golos</small>
                              <h5>70 Golos</h5>
                              <img id="imgF70Pnt" src="../../dist/images/badges/futsal/pontos/f70pnt.png" alt="Badge 1" class="img-fluid pt-2 rounded" data-toggle="tooltip" data-placement="top" title="70 Golos" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF70Pnt">35\70</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF70Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Golos</small>
                              <h5>100 Golos</h5>
                              <img id="imgF100Pnt" src="../../dist/images/badges/futsal/pontos/f100pnt.png" alt="Badge 1" class="img-fluid pt-2 rounded" data-toggle="tooltip" data-placement="top" title="100 Golos" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF100Pnt">35\100</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF100Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Golos</small>
                              <h5>200 Golos</h5>
                              <img id="imgF250Pnt" src="../../dist/images/badges/futsal/pontos/f250pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="200 Golos no Futsal" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeF250Pnt">35\200</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarF250Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc20F" src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc20F">20\20</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc20F" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                            <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc50F" src="../../dist/images/badges/perc50.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc50F">50\50</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc50F" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc70F" src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc70F">70\70</h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc70F" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="owl-prev" data-owl="prev" data-carousel="carousel3"><i class="ti ti-chevron-left fs-10"></i></button>
                      <button class="owl-next" data-owl="next" data-carousel="carousel3"><i class="ti ti-chevron-right fs-10"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="badgesBasquetebol" class="d-none">
                <div class="badge-container2">
                  <div class="row mb-0 pb-0 mt-5">
                    <div class="col-12 text-center">
                      <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-7"><i class="ti ti-ball-basketball me-1"></i>Basquetebol <span class="badge fs-2 rounded-4 py-1 fw-semibold px-2 ms-2 fs-7 badge-container" style="background-color: firebrick;" id="contagemBasquetebol"></span></h1>
                    </div>
                  </div>


                  <div class="row mb-5 mt-5">
                    <div class="carousel-container" id="carousel4">
                      <div class="owl-carousel">
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>20 Vitórias</h5>
                              <img id="imgBVit20" src="../../dist/images/badges/basquetebol/vitorias/b20vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB20Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB20Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>50 Vitórias</h5>
                              <img id="imgBVit50" src="../../dist/images/badges/basquetebol/vitorias/b50vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="20 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB50Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB50Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>100 Vitórias</h5>
                              <img id="imgBVit100" src="../../dist/images/badges/basquetebol/vitorias/b100vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="100 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB100Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB100Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Vitórias</small>
                              <h5>150 Vitórias</h5>
                              <img id="imgBVit150" src="../../dist/images/badges/basquetebol/vitorias/b150vit.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="150 Vitórias no Padel" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB150Vit"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB150Vit" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>10 Pontos</h5>
                              <img id = "imgB10Pnt" src="../../dist/images/badges/basquetebol/pontos/b10pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="10 Pontos no Basquetebol" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB10Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB10Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>30 Pontos</h5>
                              <img id="imgB30Pnt" src="../../dist/images/badges/basquetebol/pontos/b30pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="30 Pontos no Basquetebol" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB30Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB30Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>70 Pontos</h5>
                              <img id="imgB70Pnt" src="../../dist/images/badges/basquetebol/pontos/b70pnt.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="70 Pontos no Basquetebol" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB70Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB70Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Pontos</small>
                              <h5>250 Pontos</h5>
                              <img id="imgB250Pnt" src="../../dist/images/badges/basquetebol/pontos/b250pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="250 Pontos no Basquetebol" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB250Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB250Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow ">
                              <small>Pontos</small>
                              <h5>1000 Pontos</h5>
                              <img id="imgB1000Pnt" src="../../dist/images/badges/basquetebol/pontos/b1000pnt.png" alt="Badge 1" class="img-fluid mt-1 rounded" data-toggle="tooltip" data-placement="top" title="1000 Pontos no Basquetebol" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadeB1000Pnt"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarB1000Pnt" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>20% Vitórias</h5>
                              <img id="imgPerc20B" src="../../dist/images/badges/perc20.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc20B"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc20B" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>50% Vitórias</h5>
                              <img id="imgPerc50B" src="../../dist/images/badges/perc50.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc50B"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc50B" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="item">
                          <div class="mt-1">
                            <div class="card px-5 py-3 d-flex flex-column align-items-center justify-content-center hover-img shadow">
                              <small>Percentagem Vitórias</small>
                              <h5>70% Vitórias</h5>
                              <img id="imgPerc70B" src="../../dist/images/badges/perc70.png" alt="Badge 1" class="img-fluid mb-2 rounded" data-toggle="tooltip" data-placement="top" title="% Vitórias" style="max-width: 200px;">
                              <h1 class="fs-5 fw-bolder" id="quantidadePerc70B"></h1>
                              <div class="progress" style="height: 15px;">
                                <div id="progressBarPerc70B" class="progress-bar" role="progressbar"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button class="owl-prev" data-owl="prev" data-carousel="carousel4"><i class="ti ti-chevron-left fs-10"></i></button>
                      <button class="owl-next" data-owl="next" data-carousel="carousel4"><i class="ti ti-chevron-right fs-10"></i></button>
                    </div>
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
                  <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
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
                  <span class="fs-3 text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
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



    <div class="modal fade" id="vertical-center-modal" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
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
            <button type="button" class="btn btn-light-primary text-primary font-medium waves-effect text-start" onclick="altFotoCapa()" data-bs-dismiss="modal">
              Guardar
            </button>
            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start" data-bs-dismiss="modal">
              Fechar
            </button>
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

    <div class="modal fade" id="scroll-long-inner-modal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scroll-long-inner-modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <h4 class="modal-title">
              Remover Amizade
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <span>Estás prestes a remover a tua amizade com este Utilizador.<br></span>
            <small>Caso o faças, poderás sempre voltar a fazer-lhe um pedido.</small>
            <h5 class='mt-3'>Remover?</h5>
          </div>
          <div class="d-flex justify-content-center align-items-center gap-3" id="corpoBotoesAmizade">

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
    <script src="../../dist/js/js_courtify/user.js"></script>
    <script src="../../../landingpage/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../../dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../../dist/js/widgets-charts.js"></script>
    <script src="../../dist/js/js_courtify/amigo.js"></script>
    <script src="../../dist/js/js_courtify/notificacao.js"></script>

    <script>
      $(function() {
        $("[data-toggle = 'tooltip']").tooltip();
      });
    </script>

    <script>
      $(document).ready(function() {

        $(".owl-carousel").each(function() {
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


          $("#" + carouselId + " .owl-prev").click(function() {
            $("#" + carouselId + " .owl-carousel").trigger("prev.owl.carousel");
          });

          $("#" + carouselId + " .owl-next").click(function() {
            $("#" + carouselId + " .owl-carousel").trigger("next.owl.carousel");
          });
        });
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

    <style>
      .selected-img {
        border: 6px solid #63a340;
      }
    </style>



    <script>
      function removerAmigo(id) {
        let dados = new FormData();
        dados.append("op", 30);
        dados.append("idAmigo", id);

        $.ajax({
            url: "../../dist/php/controllerUser.php",
            method: "POST",
            data: dados,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false
          })

          .done(function(msg) {
            let obj = JSON.parse(msg);
            alerta2(obj.titulo, obj.msg, obj.icon);
            setTimeout(function() {
              location.reload();
            }, 3000);
          })

          .fail(function(jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
          });
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