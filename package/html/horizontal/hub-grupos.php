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

    <link rel="stylesheet" href="../../../landingpage/dist/libs/aos/dist/aos.css">

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
            <li class="nav-item mt-1">
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
              <a class="nav-link fs-6" href="./marcacao.php">Marcação</a>
            </li>
            <li class="nav-item dropdown-hover d-none d-xl-block">
              <a class="nav-link fs-6" href="./descobrir.php">Descobrir</a>
            </li>
          </ul>
          <div class="d-block d-xl-none mb-2">
            <a href="./index.php" class="text-nowrap nav-link">
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
                    <div class="notification bg-primary rounded-circle d-none" id="notificacaoAtiva"></div>
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
                      <div id="divNotificacoesConviteGrupo">

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
            <div class="d-none d-md-block">
              <div class="col-lg-12" style="position: relative; margin-top: 80px;">
                <div style="position: absolute; bottom: 5px; right: 16px; z-index: 1;">
                  <img src="../../dist/images/logos/logo_icone.png" style="max-width: 70px;">
                </div>
                <img class="img-fluid" src="../../dist/images/backgrounds/tomasz-krawczyk-M2x3A8Q4JbY-unsplash.jpg" data-aos style="width: 100%; max-width: 100%; height: 600px; object-fit: cover; filter: brightness(50%);">
                <div style="position: absolute; top: 40%; transform: translateY(-50%); left: 50%; text-align: center; color: white;">
                  <h1 class="text-white fw-bolder" style="letter-spacing: 1px; font-size: 90px">
                    Grupos</h1>
                  <p class="text-white lead lead-md-2 lead-lg-1" style="letter-spacing: 1px; font-size: 50px">
                    Junta-te a atletas que <br> partilhem Desporto
                </div>
              </div>
            </div>
          </div>
          <div class="body-wrapper">
            <div class="container">

              

              <div class="mt-5 mt-md-0">
                 &nbsp;  
                <div class="card mt-5 shadow">
                  <div class="card-body">
                    <div class="row flex-lg-row-reverse align-items-center g-5 py-3">
                      <div class="col-10 col-sm-8 col-lg-6">
                        <img src="../../dist/images/backgrounds/banner_hub_grupos.jpg" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000" class="img-fluid rounded" alt="Imagem Grupos" width="700" height="500">
                      </div>
                      <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-2" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">É aqui que a Comunidade entra em ação</h1>
                        <p class="lead mt-5" data-aos="fade-up" data-aos-delay="800" data-aos-duration="1000">Esta página é o teu ponto de partida para te tornares parte da comunidade Courtify. Cria ou junta-te a grupos e começa a partilhar momentos e experiências.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>




              <div class="d-flex justify-content-between align-items-center mt-3">
                <h3 class="">Os teus Grupos</span></h3>
                <div class="d-flex justify-content-center align-items-center">
                  <p class="fs-5 me-3 mt-3">Não tens grupo?</p>
                  <button type="button" class="btn btn-primary btn-small" data-bs-toggle="modal" data-bs-target="#modalCriarGrupo">Criar Grupo</button>
                </div>
              </div>
              <div class="card bg-light px-3 py-3 mt-2">
                <div class="row" id="gruposUser">

                </div>
              </div>


              <div class="mt-2">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="">Marcações abertas dos teus Grupos <span class="ms-2 badge bg-primary rounded-4 px-3 py-1 lh-sm badge-container" id="quantidadeMarcacoesGrupos"></span></h3>
                </div>
                <div class="card bg-light px-3" id="cardCarousel4">
                  <div class="carousel-container mt-3" id="carousel4">
                    <div class="owl-carousel" id="marcacaoGrupos">

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
                <a class="sidebar-link" href="hub.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">Comunidade</span>
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
              <div class='d-flex'>
                <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
                <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Marcação</h4>
              </div>
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

      <div class="modal fade" id="modalCriarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCriarGrupo" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
              <div class='d-flex'>
                <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
                <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Criação de Grupo</h4>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bodyModalEditarGrupo">
              <form class="row g-3">
                <div class="col-md-12">
                  <div class="d-flex flex-column gap-3 align-items-center">
                    <img src="" class="img-fluid img-thumbnail" width="200" alt="" id="imgNovoGrupo">
                    <div class="col-md-6 text-center">
                      <label for="fotoNovoGrupo" class="form-label">Foto</label>
                      <input type="file" class="form-control" id="fotoNovoGrupo" accept="image/png, image/gif, image/jpeg" onchange="previewImagemNovoGrupo()">
                      <small class="mb-0">Permitido JPG ou PNG. Tamanho máximo de 10MB.</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <label for="nomeNovoGrupo" class="form-label">Nome</label>
                  <input type="text" class="form-control" id="nomeNovoGrupo">
                </div>
                <div class="col-md-4">
                  <label for="modalidadeNovoGrupo" class="form-label">Modalidade</label>
                  <select class="form-select" id="modalidadeNovoGrupo">
                    <option value="-1" selected disabled>Selecione uma opção</option>
                    <option value="1">Basquetebol</option>
                    <option value="2">Futsal</option>
                    <option value="3">Padel</option>
                    <option value="4">Ténis</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Tipo</label><br>
                  <div class="mt-2 d-flex gap-2">
                    <input type="checkbox" class="form-check-input" value="aberto" id="checkboxGrupoAberto">Aberto</input>
                    <input type="checkbox" class="form-check-input" value="fechado" id="checkboxGrupoFechado">Fechado</input>
                  </div>
                </div>
                <div class="col-12">
                  <label for="descricaoNovoGrupo" class="form-label">Descrição</label>
                  <textarea name="" class="form-control" cols="30" rows="8" id="descricaoNovoGrupo" maxlength="500"></textarea>
                </div>
              </form>
            </div>
            <div class=" d-flex justify-content-center align-items-center gap-3">
              <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="registaGrupo()">
                Criar
              </button>
              <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="limpaCampos()">
                Cancelar
              </button>
            </div>
          </div>



          <!-- Import Js Files -->
          <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
          <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
          <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
          <script src="../../../landingpage/dist/libs/aos/dist/aos.js"></script>

          <!-- core files -->
          <script src="../../dist/js/app.min.js"></script>
          <script src="../../dist/js/app.horizontal.init.js"></script>
          <script src="../../dist/js/app-style-switcher.js"></script>
          <script src="../../dist/js/sidebarmenu.js"></script>
          <script src="../../../landingpage/dist/libs/owl.carousel/dist/owl.carousel.min.js"></script>
          <script src="../../../landingpage/dist/js/custom.js"></script>
          <script src="../../dist/js/js_courtify/grupo.js"></script>
          <script src="../../dist/js/js_courtify/descobrir.js"></script>


          <script src="../../dist/js/custom.js"></script>
          <!-- current page js files -->
          <script src="../../dist/js/js_courtify/sweatalert.js"></script>
          <script src="../../dist/js/js_courtify/user.js"></script>
          <script src="../../dist/js/js_courtify/perfilUser.js"></script>
          <script src="../../dist/js/js_courtify/notificacao.js"></script>








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