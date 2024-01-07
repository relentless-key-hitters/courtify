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
      <div class="card shadow" style="margin-top: 120px;">
        <div class="row">
          <div class="col-md-3">
            <div id="infoGrupo">

            </div>
          </div>
          <div class="col-md-6">
            <div id="estatisticasGrupo">
              <h4 class="fw-semibold mb-1 pb-2 text-center fs-6 border-2 border-bottom border-light">Estatísticas</h4>
              <div class="row d-flex align-content-center mt-3 p-sm-3 p-3">
                <div class="col-md-4 col-sm-4">
                  <div class="card shadow p-3">
                    <h4 class="mb-0 fw-semibold fs-4">% Vitórias<span class="ti ti-bolt fs-5 ms-1"></span></h4>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="card shadow p-3">
                    <h4 class="mb-0 fw-semibold fs-4">% <span class="ti ti-trophy fs-4 ms-1"></span></h4>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="card shadow p-3">
                    <h4 class="mb-0 fw-semibold fs-4">% MVP<span class="ti ti-award fs-5 ms-1"></span></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 d-flex flex-column justify-content-center">
            <div id="algoGrupo">
              <h4 class="fw-semibold mb-1 pb-2 text-center fs-6 border-2 border-bottom border-light">Menu</h4>
              <div class="p-3">
                <div class="row text-center">
                  <div class="col-md-12" id="botoesNonAdmin">

                  </div>
                  <div class="col-md-12" id="botoesAdmin">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-4 col-lg-3">

          <!-- <div class="card shadow">
            <div class="p-3">
              <h4 class="fw-semibold mb-1 pb-2 text-center fs-6 border-2 border-bottom border-light">Conquistas</h4>
              <div class="text-end mb-1">
                <span class="fw-bolder">Total:</span> <span id="totalBadges"></span>
              </div>
              <div class="row" id="badgesGrupo">

              </div>
            </div>
          </div> -->

          <div class="card shadow">
            <div class="p-3">
              <h4 class="fw-semibold mb-1 pb-2 text-center fs-6 border-2 border-bottom border-light">Membros</h4>
              <div class="text-end mb-1">
                <span class="fw-bolder">Total:</span> <span id="totalMembros"></span>
              </div>
              <div class="row gap-4 d-flex" id="atletasGrupo">

              </div>
            </div>
            <div class='mt-1' id="paginacaoAtletasGrupo">

            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8 col-lg-9">
          <div class="card shadow" id="atividadeGrupo">
            <div class="p-3">
              <h4 class="fw-semibold mb-1 pb-2 text-center fs-6 border-2 border-bottom border-light">Atividade<i class='ti ti-info-circle ms-1' data-toggle="tooltip" data-bs-placement="top" title='Aqui podes encontrar as últimas Marcações já concluidas (na Modalidade deste Grupo) onde outros membros participaram.'></i></h4>
            </div>
            <div class="p-3" id="marcacoesConcluidasGrupo">

            </div>
            <div class='mt-1' id="paginacaoMarcacoesConcluidas">

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

    <div class="modal fade" id="modalJuntarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalJuntarGrupo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <div class='d-flex'>
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
              <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Juntar ao Grupo</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <span class="fs-4">Estás prestes a juntar-te deste grupo.<br></span>
            <h5 class='mt-3'>Juntar?</h5>
          </div>
          <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="juntarGrupo()">
              Sim
            </button>
            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3" data-bs-dismiss="modal">
              Não
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalSairGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSairGrupo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <div class='d-flex'>
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
              <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Sair do Grupo</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <span class="fs-4">Estás prestes a sair deste grupo.<br></span>
            <h5 class='mt-3'>Tens a certeza?</h5>
          </div>
          <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="sairGrupo()">
              Sim
            </button>
            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3" data-bs-dismiss="modal">
              Não
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditarGrupo" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <div class='d-flex'>
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
              <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Edição de Grupo</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="bodyModalEditarGrupo">

          </div>
          <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="guardaEditGrupo()">
              Salvar
            </button>
            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3" data-bs-dismiss="modal">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="modalApagarGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalApagarGrupo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <div class='d-flex'>
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
              <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Apagar Grupo</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <span class="fs-4">Estás prestes a apagar este Grupo.<br></span>
            <small>Todo o conteúdo gerado para este Grupo será apagado.<br> Isto inclui conquistas, estatísticas, etc</small>
            <h5 class='mt-3'>Tens a certeza?</h5>
          </div>
          <div class="d-flex justify-content-center align-items-center gap-3">
            <button type="button" class="btn btn-primary text-white font-medium waves-effect text-start mb-3" data-bs-dismiss="modal" onclick="apagarGrupo()">
              Sim
            </button>
            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start mb-3" data-bs-dismiss="modal">
              Não
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditMembrosGrupo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditMembrosGrupo" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center">
            <div class='d-flex'>
              <img src="../../dist/images/logos/favicon.ico" alt="" height="40" width="40" class="mt-2 ms-2">
              <h4 class="mb-0 mt-2 ms-2 fs-7 p-1">Lista de Membros</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class='pb-2 ps-3 pe-3'>
              <span>
                Através desta lista, consegues encontrar todos os membros que estão atualmente no teu Grupo.
                Podes consultar alguma informação básica, assim como visitar rapidamente o seu perfil ou até mesmo remover.
              </span>
            </div>
            <ul class="list mb-0 py-2" id="listaMembrosGrupo">

            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light text-primary font-medium waves-effect text-start" data-bs-dismiss="modal">
              Fechar
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
    <script src="../../dist/js/apps/chat.js"></script>
    <script src="../../dist/libs/prismjs/prism.js"></script>
    <script src="../../dist/js/js_courtify/sweatalert.js"></script>
    <script src="../../dist/js/js_courtify/perfilUser.js"></script>
    <script src="../../dist/js/js_courtify/user.js"></script>
    <script src="../../dist/js/js_courtify/notificacao.js"></script>


    <!-- ---------------------------------------------- -->
    <!-- current page js files -->
    <!-- ---------------------------------------------- -->

    <script src="../../dist/js/js_courtify/perfilGrupo.js"></script>

    <script class="script">
      $(function() {
        $('body').tooltip({
          selector: '[data-toggle="tooltip"]'
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