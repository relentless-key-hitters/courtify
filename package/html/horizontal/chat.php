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
    <div class="page-wrapper overflow-hidden" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
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
                        <img id="perfil1" class="rounded-circle" width="35" height="35" alt="" />
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
                        <a href="#" class="py-8 px-7 d-flex align-items-center">
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
    </div>

    <!-- Header End -->


    <!-- Main wrapper -->

    <div class="container">
      <div class="card overflow-hidden chat-application" style="position: relative; margin-top: 120px;">
        <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
          <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
            <i class="ti ti-menu-2 fs-5"></i>
          </button>
          <form class="position-relative w-100">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form>
        </div>
        <div class="d-flex">
          <div class="w-30 d-none d-lg-block border-end user-chat-box">
            <div class="px-4 pt-9 pb-6">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                  <div class="position-relative">
                    <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="54" height="54" class="rounded-circle">
                    <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                      <span class="visually-hidden">New alerts</span>
                    </span>
                  </div>
                  <div class="ms-3">
                    <h6 class="fw-semibold mb-2">Mathew Anderson</h6>
                    <p class="mb-0 fs-2">Marketing Director</p>
                  </div>
                </div>
                <div class="dropdown">
                  <a class="text-dark fs-6 nav-icon-hover " href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item d-flex align-items-center gap-2 border-bottom" href="javascript:void(0)"><span><i class="ti ti-settings fs-4"></i></span>Setting</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-help fs-4"></i></span>Help and feadback</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-layout-board-split fs-4"></i></span>Enable split View mode</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 border-bottom" href="javascript:void(0)"><span><i class="ti ti-table-shortcut fs-4"></i></span>Keyboard shortcut</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-login fs-4"></i></span>Sign Out</a></li>
                  </ul>
                </div>
              </div>
              <form class="position-relative mb-4">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact" />
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
              <div class="dropdown">
                <a class="text-muted fw-semibold d-flex align-items-center" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Recent Chats<i class="ti ti-chevron-down ms-1 fs-5"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0)">Sort by time</a></li>
                  <li><a class="dropdown-item border-bottom" href="javascript:void(0)">Sort by Unread</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Hide favourites</a></li>
                </ul>
              </div>
            </div>
            <div class="app-chat">
              <ul class="chat-users" style="height: calc(100vh - 496px)" data-simplebar>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_1" data-user-id="1">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Michell Flintoff</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">You: Yesterdy was great...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">15 minutes</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-2.jpg" alt="user-2" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-danger">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Bianca Anderson</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Nice looking dress you...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">30 minutes</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_3" data-user-id="3">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-8.jpg" alt="user-8" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-warning">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Andrew Johnson</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Sent a photo</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">2 hours</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_4" data-user-id="4">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-4.jpg" alt="user-4" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Mark Strokes</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Lorem ispusm text sud...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">5 days</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_5" data-user-id="5">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Mark, Stoinus & Rishvi..</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Lorem ispusm text ...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">5 days</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-2.jpg" alt="user-2" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-danger">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Bianca Anderson</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Nice looking dress you...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">30 minutes</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_3" data-user-id="3">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-8.jpg" alt="user-8" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-warning">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Andrew Johnson</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Sent a photo</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">2 hours</p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="w-70 w-xs-100 chat-container">
            <div class="chat-box-inner-part h-100">
              <div class="chat-not-selected h-100 d-none">
                <div class="d-flex align-items-center justify-content-center h-100 p-5">
                  <div class="text-center">
                    <span class="text-primary">
                      <i class="ti ti-message-dots fs-10"></i>
                    </span>
                    <h6 class="mt-2">Open chat from the list</h6>
                  </div>
                </div>
              </div>
              <div class="chatting-box d-block">
                <div class="p-9 border-bottom chat-meta-user d-flex align-items-center justify-content-between">
                  <div class="hstack gap-3 current-chat-user-name">
                    <div class="position-relative">
                      <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="48" height="48" class="rounded-circle" />
                      <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                        <span class="visually-hidden">New alerts</span>
                      </span>
                    </div>
                    <div class="">
                      <h6 class="mb-1 name fw-semibold"></h6>
                      <p class="mb-0">Away</p>
                    </div>
                  </div>
                  <ul class="list-unstyled mb-0 d-flex align-items-center">
                    <li><a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-phone"></i></a></li>
                    <li><a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-video"></i></a></li>
                    <li>
                      <!-- <a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)" type="button" data-bs-toggle="offcanvas" data-bs-target="#app-chat-offcanvas" aria-controls="offcanvasScrolling">
                            <i class="ti ti-menu-2"></i>
                          </a> -->
                      <a class="chat-menu text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="position-relative overflow-hidden d-flex">
                  <div class="position-relative d-flex flex-grow-1 flex-column">
                    <div class="chat-box p-9" style="height: calc(100vh - 442px)" data-simplebar>
                      <div class="chat-list chat active-chat" data-user-id="1">
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> I want more detailed information. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark mb-1 d-inline-block rounded-1  fs-3"> If I don’t like something, I’ll stay away from it. </div>
                            <div class="p-2 bg-light-info text-dark rounded-1 fs-3"> They got there early, and they got really good seats. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="rounded-2 overflow-hidden">
                              <img src="../../dist/images/products/product-1.jpg" alt="" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 2 -->
                      <div class="chat-list chat" data-user-id="2">
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> I want more detailed information. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark mb-1 d-inline-block rounded-1  fs-3"> If I don’t like something, I’ll stay away from it. </div>
                            <div class="p-2 bg-light-info text-dark rounded-1 fs-3"> They got there early, and they got really good seats. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="rounded-2 overflow-hidden">
                              <img src="../../dist/images/products/product-1.jpg" alt="" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 3 -->
                      <div class="chat-list chat" data-user-id="3">
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> I want more detailed information. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark mb-1 d-inline-block rounded-1  fs-3"> If I don’t like something, I’ll stay away from it. </div>
                            <div class="p-2 bg-light-info text-dark rounded-1 fs-3"> They got there early, and they got really good seats. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="rounded-2 overflow-hidden">
                              <img src="../../dist/images/products/product-1.jpg" alt="" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 4 -->
                      <div class="chat-list chat" data-user-id="4">
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> I want more detailed information. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark mb-1 d-inline-block rounded-1  fs-3"> If I don’t like something, I’ll stay away from it. </div>
                            <div class="p-2 bg-light-info text-dark rounded-1 fs-3"> They got there early, and they got really good seats. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="rounded-2 overflow-hidden">
                              <img src="../../dist/images/products/product-1.jpg" alt="" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- 5 -->
                      <div class="chat-list chat" data-user-id="5">
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> If I don’t like something, I’ll stay away from it. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> I want more detailed information. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                          <div class="text-end">
                            <h6 class="fs-2 text-muted">2 hours ago</h6>
                            <div class="p-2 bg-light-info text-dark mb-1 d-inline-block rounded-1  fs-3"> If I don’t like something, I’ll stay away from it. </div>
                            <div class="p-2 bg-light-info text-dark rounded-1 fs-3"> They got there early, and they got really good seats. </div>
                          </div>
                        </div>
                        <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                          <img src="../../dist/images/profile/user-8.jpg" alt="user8" width="40" height="40" class="rounded-circle" />
                          <div>
                            <h6 class="fs-2 text-muted">Andrew, 2 hours ago</h6>
                            <div class="rounded-2 overflow-hidden">
                              <img src="../../dist/images/products/product-1.jpg" alt="" class="w-100">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="px-9 py-6 border-top chat-send-message-footer">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2 w-85">
                          <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)"> <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i></a>
                          <input type="text" class="form-control message-type-box text-muted border-0 p-0 ms-2" placeholder="Type a Message" />
                        </div>
                        <ul class="list-unstyledn mb-0 d-flex align-items-center">
                          <li><a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-photo-plus"></i></a></li>
                          <li><a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-paperclip"></i></a></li>
                          <li><a class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-microphone"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="app-chat-offcanvas border-start" style="height: calc(100vh - 380px)" data-simplebar="">
                    <div class="p-3 d-flex align-items-center justify-content-between">
                      <h6 class="fw-semibold mb-0">Media <span class="text-muted">(36)</span></h6>
                      <a class="chat-menu d-lg-none d-block text-dark fs-6 bg-hover-primary nav-icon-hover position-relative z-index-5" href="javascript:void(0)">
                        <i class="ti ti-x"></i>
                      </a>
                    </div>
                    <div class="offcanvas-body p-9">
                      <div class="media-chat mb-7">
                        <div class="row">
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-1.jpg" alt="" class="w-100"></div>
                          </div>
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-2.jpg" alt="" class="w-100"></div>
                          </div>
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-3.jpg" alt="" class="w-100"></div>
                          </div>
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-4.jpg" alt="" class="w-100"></div>
                          </div>
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-1.jpg" alt="" class="w-100"></div>
                          </div>
                          <div class="col-4 px-1">
                            <div class="rounded-1 overflow-hidden mb-2"><img src="../../dist/images/products/product-2.jpg" alt="" class="w-100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="files-chat">
                        <h6 class="fw-semibold mb-3">Files <span class="text-muted">(36)</span></h6>
                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover justify-content-between mb-9">
                          <div class="d-flex align-items-center gap-3">
                            <div class="rounded-1 bg-light p-6">
                              <img src="../../dist/images/chat/icon-adobe.svg" alt="" width="24" height="24">
                            </div>
                            <div>
                              <h6 class="fw-semibold">service-task.pdf</h6>
                              <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2 MB</span><span>2 Dec 2023</span></div>
                            </div>
                          </div>
                          <span class="position-relative nav-icon-hover download-file">
                            <i class="ti ti-download text-dark fs-6 bg-hover-primary"></i>
                          </span>
                        </a>
                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover justify-content-between mb-9">
                          <div class="d-flex align-items-center gap-3">
                            <div class="rounded-1 bg-light p-6">
                              <img src="../../dist/images/chat/icon-figma.svg" alt="" width="24" height="24">
                            </div>
                            <div>
                              <h6 class="fw-semibold">homepage-design.fig</h6>
                              <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2 MB</span><span>2 Dec 2023</span></div>
                            </div>
                          </div>
                          <span class="position-relative nav-icon-hover download-file">
                            <i class="ti ti-download text-dark fs-6 bg-hover-primary"></i>
                          </span>
                        </a>
                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover justify-content-between mb-9">
                          <div class="d-flex align-items-center gap-3">
                            <div class="rounded-1 bg-light p-6">
                              <img src="../../dist/images/chat/icon-chrome.svg" alt="" width="24" height="24">
                            </div>
                            <div>
                              <h6 class="fw-semibold">about-us.html</h6>
                              <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2 MB</span><span>2 Dec 2023</span></div>
                            </div>
                          </div>
                          <span class="position-relative nav-icon-hover download-file">
                            <i class="ti ti-download text-dark fs-6 bg-hover-primary"></i>
                          </span>
                        </a>
                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover justify-content-between mb-9">
                          <div class="d-flex align-items-center gap-3">
                            <div class="rounded-1 bg-light p-6">
                              <img src="../../dist/images/chat/icon-zip-folder.svg" alt="" width="24" height="24">
                            </div>
                            <div>
                              <h6 class="fw-semibold">work-project.zip</h6>
                              <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2 MB</span><span>2 Dec 2023</span></div>
                            </div>
                          </div>
                          <span class="position-relative nav-icon-hover download-file">
                            <i class="ti ti-download text-dark fs-6 bg-hover-primary"></i>
                          </span>
                        </a>
                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover justify-content-between">
                          <div class="d-flex align-items-center gap-3">
                            <div class="rounded-1 bg-light p-6">
                              <img src="../../dist/images/chat/icon-javascript.svg" alt="" width="24" height="24">
                            </div>
                            <div>
                              <h6 class="fw-semibold">custom.js</h6>
                              <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2 MB</span><span>2 Dec 2023</span></div>
                            </div>
                          </div>
                          <span class="position-relative nav-icon-hover download-file">
                            <i class="ti ti-download text-dark fs-6 bg-hover-primary"></i>
                          </span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="offcanvas offcanvas-start user-chat-box chat-offcanvas" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Chats </h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="px-4 pt-9 pb-6">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                  <div class="position-relative">
                    <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="54" height="54" class="rounded-circle">
                    <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                      <span class="visually-hidden">New alerts</span>
                    </span>
                  </div>
                  <div class="ms-3">
                    <h6 class="fw-semibold mb-2">Mathew Anderson</h6>
                    <p class="mb-0 fs-2">Marketing Director</p>
                  </div>
                </div>
                <div class="dropdown">
                  <a class="text-dark fs-6 nav-icon-hover " href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item d-flex align-items-center gap-2 border-bottom" href="javascript:void(0)"><span><i class="ti ti-settings fs-4"></i></span>Setting</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-help fs-4"></i></span>Help and feadback</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-layout-board-split fs-4"></i></span>Enable split View mode</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2 border-bottom" href="javascript:void(0)"><span><i class="ti ti-table-shortcut fs-4"></i></span>Keyboard shortcut</a></li>
                    <li><a class="dropdown-item d-flex align-items-center gap-2" href="javascript:void(0)"><span><i class="ti ti-login fs-4"></i></span>Sign Out</a></li>
                  </ul>
                </div>
              </div>
              <form class="position-relative mb-4">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
              </form>
              <div class="dropdown">
                <a class="text-muted fw-semibold d-flex align-items-center" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Recent Chats<i class="ti ti-chevron-down ms-1 fs-5"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:void(0)">Sort by time</a></li>
                  <li><a class="dropdown-item border-bottom" href="javascript:void(0)">Sort by Unread</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Hide favourites</a></li>
                </ul>
              </div>
            </div>
            <div class="app-chat">
              <ul class="chat-users" style="height: calc(100vh - 200px)" data-simplebar>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user bg-light" id="chat_user_1" data-user-id="1">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Michell Flintoff</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">You: Yesterdy was great...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">15 mins</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-2.jpg" alt="user-2" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-danger">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Bianca Anderson</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Nice looking dress you...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">30 mins</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_3" data-user-id="3">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-8.jpg" alt="user-8" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-warning">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Andrew Johnson</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Sent a photo</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">2 hrs</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_4" data-user-id="4">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-4.jpg" alt="user-4" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Mark Strokes</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Lorem ispusm text sud...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">5 days</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_5" data-user-id="5">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-1.jpg" alt="user1" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-success">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Mark, Stoinus & Rishvi..</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Lorem ispusm text ...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">5 days</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-2.jpg" alt="user-2" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-danger">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Bianca Anderson</h6>
                        <span class="fs-3 text-truncate text-dark fw-semibold d-block">Nice looking dress you...</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">30 mins</p>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_3" data-user-id="3">
                    <div class="d-flex align-items-center">
                      <span class="position-relative">
                        <img src="../../dist/images/profile/user-8.jpg" alt="user-8" width="48" height="48" class="rounded-circle" />
                        <span class="position-absolute bottom-0 end-0 p-1 badge rounded-pill bg-warning">
                          <span class="visually-hidden">New alerts</span>
                        </span>
                      </span>
                      <div class="ms-3 d-inline-block w-75">
                        <h6 class="mb-1 fw-semibold chat-title" data-username="James Anderson">Andrew Johnson</h6>
                        <span class="fs-3 text-truncate text-body-color d-block">Sent a photo</span>
                      </div>
                    </div>
                    <p class="fs-2 mb-0 text-muted">2 hrs</p>
                  </a>
                </li>
              </ul>
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
          <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Pesquisa Geral</h4>
          <div class="modal-header border-bottom">
            <input type="search" class="form-control fs-3" placeholder="Introduza um termo de pesquisa..." id="search" />
            <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
              <i class="ti ti-x fs-5 ms-3"></i>
            </span>
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
    <script src="../../dist/js/js_courtify/sweatalert.js"></script>
    <script src="../../dist/js/js_courtify/perfilUser.js"></script>
    <script src="../../dist/js/js_courtify/user.js"></script>
    <script src="../../dist/js/js_courtify/notificacao.js"></script>


    <!-- ---------------------------------------------- -->
    <!-- current page js files -->
    <!-- ---------------------------------------------- -->

    <script src="../../dist/libs/fullcalendar/index.global.min.js"></script>
    <script src="../../dist/js/apps/chat.js"></script>

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


    <!--<script>
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
    </script>-->

  </body>

  </html>

<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>