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
    <header class="app-header" style="position: fixed; top: 0; left: 0; width: 100%;">
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
            <a class="nav-link fs-4" href="./hub.php">Hub Central</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-4" href="./marcacao_editavel.php">Marcação</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-4" href="./descobrir.php">Descobrir</a>
          </li>
          <li class="nav-item dropdown-hover d-none d-xl-block">
            <a class="nav-link fs-4" href="./comunidades.php">Comunidade</a>
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
      <div class="row">
        <div class="col-lg-12" style="position: relative; margin-top: 80px;">
          <div style="position: absolute; top: 5px; right: 16px; z-index: 1;">
            <img src="../../dist/images/logos/logo_icone.png" style="max-width: 70px;">
          </div>
          <img class="img-fluid" src="../../dist/images/backgrounds/sandro-giacon-WLIQEo16gSo-unsplash-2.jpg"
            style="width: 100%; max-width: 100%; height: 600px; object-fit: cover;">
          <div
            style="position: absolute; top: 37%; transform: translateY(-50%); left: 10.5%; text-align: center; color: white;">
            <h1 class="text-white display-4 display-md-2 display-lg-1 fw-bolder" style="letter-spacing: 1px;">Hub
              Central
            </h1>
            <p class="text-white lead lead-md-2 lead-lg-1 fs-8" style="letter-spacing: 1px;">Cria, Partilha, Joga!</p>
          </div>
        </div>
      </div>
      <div style="margin: 120px;">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-lg-4 text-center">
                <div class="card bg-light" style="margin-top: 15px;">
                  <div class="row pt-4">
                    <div class="col-md-12">
                      <h1 class="display-6 display-md-2 display-lg-1 fw-semibold pb-3" style="letter-spacing: 1px;">Comunidades
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/w.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1" style="max-width: 220px;">
                        <div class="card-body text-center">
                          <h5 class="card-title fs-8">World Padel Club</h5>
                          <p class="card-text fs-7">Desde 2022</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/98.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1" style="max-width: 220px;">
                        <div class="card-body text-center">
                          <h5 class="card-title fs-8">Évora Tennis Club</h5>
                          <p class="card-text fs-7">Desde 2022</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/comunidade4.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1" style="max-width: 220px;">
                        <div class="card-body text-center">
                          <h5 class="card-title fs-8">Padel Ball 3</h5>
                          <p class="card-text fs-7">Desde 2022</p>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                        <a class="btn btn-success"href="./comunidades.php" style="font-size: 20px;">
                          Mais Comunidades
                        </a>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <div class="card-body text-center form-group">
                          <h5 class="card-title fs-8 pb-4">Criar Comunidade</h5>
                          <input type="text" placeholder="Nome" class="form-control mb-4">
                          <select class="form-select mb-4"  id="pesquisaMarcacaoModalidade">
                            <option value="" selected disabled>Modalidade</option>
                          </select>
                          <select class="form-select mb-4">
                            <option value="" selected disabled>Privacidade</option>
                            <option value="publico">Público</option>
                            <option value="privado">Privado</option>
                          </select>
                          <a class="btn btn-primary">Criar</a>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <div class="card bg-light" style="margin-top: 15px;">
                  <div class="row pt-4">
                    <div class="col-md-12">
                      <h1 class="display-6 display-md-2 display-lg-1 fw-semibold pb-3" style="letter-spacing: 1px;">Equipas
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/comunidade4.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1" style="max-width: 220px;">
                        <div class="card-body">
                          <h5 class="card-title fs-8">Padel</h5>
                          <p class="card-text fs-7">Sexta-Feira (10/11) 18:30</p>
                          <p class="card-text fs-5">ESC Padel Indoor</p>
                          <a href="#" class="btn btn-primary">Mais Info</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/98.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 2" style="max-width: 220px;">
                        <div class="card-body">
                          <h5 class="card-title fs-8">Ténis</h5>
                          <p class="card-text fs-7">Terça-Feira (14/11) 19:30</p>
                          <p class="card-text fs-5">ETC Outdoor</p>
                          <a href="#" class="btn btn-primary">Mais Info</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/98.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 2" style="max-width: 220px;">
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
              <div class="col-lg-4 text-center">
                <div class="card bg-light" style="margin-top: 15px;">
                  <div class="row pt-4">
                    <div class="col-md-12">
                      <h1 class="display-6 display-md-2 display-lg-1 fw-semibold pb-3" style="letter-spacing: 1px;">Torneios
                      </h1>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/descobrir_banner.jpg" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1">
                        <div class="card-body">
                          <h5 class="card-title fs-8">Torneio Novembro</h5>
                          <p class="card-text fs-7">Sexta-Feira (24/11) 18:30</p>
                          <p class="card-text fs-5">CTE</p>
                          <a href="#" class="btn btn-primary">Inscrever</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/tomasz-krawczyk-M2x3A8Q4JbY-unsplash.jpg" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1">
                        <div class="card-body">
                          <h5 class="card-title fs-8">Torneio ESC Padel</h5>
                          <p class="card-text fs-7">Sexta-Feira (24/11) 18:30</p>
                          <p class="card-text fs-5">ESC Padel Indoor</p>
                          <a href="#" class="btn btn-primary">Inscrever</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <div class="card card-hover align-items-center" style="margin: 30px;">
                        <img src="../../dist/images/backgrounds/comunidade4.png" class="card-img-top object-fit-cover"
                          alt="Placeholder Image 1" style="max-width: 220px;">
                        <div class="card-body">
                          <h5 class="card-title fs-8">Torneio PB3</h5>
                          <p class="card-text fs-7">Sexta-Feira (12/12) 19:30</p>
                          <p class="card-text fs-5">ESC Padel Indoor</p>
                          <a href="#" class="btn btn-primary">Inscrever</a>
                        </div>
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
  <script src="../../dist/js/js_courtify/campo.js"></script>


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

</body>

</html>
<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>