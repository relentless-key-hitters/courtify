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
      <img src="../../../landingpage/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Header Start -->
      <header class="app-header" style="position: fixed; top: 0; left: 0; width: 100%;">
        <nav class="navbar navbar-expand-xl navbar-light container-fluid px-0">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-xl-block">
              <a href="#" class="text-nowrap nav-link mb-2">
                <img src="../../../landingpage/dist/images/logos/logo_courtify.png" class="dark-logo" width="180" alt="" />
                <img src="../../../landingpage/dist/images/logos/light-logo.svg" class="light-logo" width="180" alt="" />
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
              <a class="nav-link fs-6" href="#">Home</a>
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
              <img src="../../../landingpage/dist/images/logos/logo_courtify.png" width="180" alt="" />
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
      <div class="body-wrapper">
        <div class="body-wrapper overflow-hidden">
          <div id="carouselExampleAutoplaying" class="carousel slide bg-light-primary" data-bs-ride="carousel" style="width: 100%; margin-top: 80px;">
            <div class="carousel-inner">
              <div class="carousel-item active ">
                <div class="text-white d-flex justify-content-center align-items-center" style="height: 700px; overflow: hidden;">
                  <img class="card-img" src="../../../landingpage/dist/images/carousel/carousel_img1.jpg" alt="Card image" style="object-fit: cover; object-position: center; height: 100%;">
                  <div class="card-img-overlay bg-dark bg-opacity-75 d-flex flex-column align-items-center" style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.75), transparent);">
                    <img src="../../../landingpage/dist/images/logos/logo_icone.png" alt="Icon" style="position: absolute; top: 20px; right: 20px; width: 50px; height: 50px;">
                    <h1 class="text-white mt-3 mb-3 fs-13 fw-semibold" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                      Ainda te lembras da tua última partida de <span style="color: #71c449;">Ténis</span>?</h1>
                    <p class="fs-9 mb-5 text-white " data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Combina já a próxima com os teus <span style="color: #71c449;">Amigos</span>!
                    </p>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="bg-dark text-white d-flex align-items-end" style="height: 700px; overflow: hidden; position: relative;">
                  <img class="card-img" src="../../../landingpage/dist/images/carousel/carousel_img2.jpg" alt="Card image" style="object-fit: cover; height: 100%; opacity: 0.7;">
                  <div class="card-img-overlay bg-dark bg-opacity-50 d-flex flex-column align-items-end justify-content-end" style="position: absolute; bottom: 0; right: 0; background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);">
                    <img src="../../../landingpage/dist/images/logos/logo_icone.png" alt="Icon" style="position: absolute; bottom: 20px; left: 20px; width: 50px; height: 50px;">
                    <h1 class="text-white mb-3 me-3 fs-13 fw-semibold" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                      O <span style="color:#71c449;">Campo</span> está a chamar por ti!
                    </h1>
                    <p class="fs-9 mb-3 me-3 text-white" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                      Lançamos uns <span style="color:#71c449;">Cestos</span>?
                    </p>
                  </div>
                </div>
              </div>




              <div class="carousel-item">
                <div class="bg-dark text-white d-flex justify-content-center align-items-center" style="height: 700px; overflow: hidden;">
                  <img class="card-img" src="../../../landingpage/dist/images/carousel/carousel_img3.jpg" alt="Card image" style="object-fit: cover; height: 100%;">
                  <div class="card-img-overlay bg-dark bg-opacity-50 d-flex flex-column justify-content-center align-items-center">
                    <img src="../../../landingpage/dist/images/logos/logo_icone.png" alt="Icon" style="position: absolute; top: 20px; left: 20px; width: 50px; height: 50px;">
                    <h1 class="text-white mt-3 mb-3 fs-13 fw-semibold" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                      É sempre bom voltar a <span style="color: #71c449;">Jogar</span> com os teus amigos, não é?
                    </h1>
                    <p class="fs-9 mb-3 text-white" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                      E se soubesses que aqui é possível guardares esses <span style="color: #71c449;">Momentos</span>?
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <section class="bg-light hero-section position-relative overflow-hidden pt-2 pt-lg-7 pt-xl-9 pb-8 pb-lg-9">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-xl-9">
                <div class="hero-content my-11 my-xl-0">
                  <h6 class="d-flex align-items-center gap-2 mb-7" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000"><small class="text-primary fw-semibold d-block fs-5">PREPARA-TE PARA
                      CONHECER</small><i class="ti ti-arrow-badge-right text-primary fs-11"></i>
                  </h6>
                  <h1 class="fw-bolder mb-8 fs-13" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">A Mais
                    Poderosa <span class="text-primary">Plataforma Desportiva</span>
                    Disponível No Mercado</h1>
                  <p class="fs-7 mb-5 text-dark" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                    A Courtify oferece-te Desporto. <span class="text-primary">Inovador &
                      Dinâmico.</span> Do que estás à espera?</p>
                </div>
              </div>
              <div class="col-xl-3 align-self-end" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="1000">
                <img src="../../../landingpage/dist/images/hero-img/hero-img.png" width="300px">

              </div>
            </div>
          </div>
        </section>

        <section class="pt-lg-7 pt-sm-3" id="visao-courtify">
          <div class="container">
            <div class="container px-4 pt-lg-7 pt-sm-3 text-center" id="featured-3">
              <small class="text-primary fw-semibold mb-2 d-block fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">PARA UNIR ATLETAS</small>
              <h2 class="fs-13 text-center mb-4 mb-lg-3 fw-bolder mt-3" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">A nossa <span class="text-success">Visão</span></h2>
              <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 text-center">
                <div class="feature col">
                  <div class="">
                    <img src="../../../landingpage/dist/images/icons/icone_comunidade_blue.png" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000" class="mb-3" height="64px" width="64px">
                  </div>
                  <h2 class="fs-11 fw-bolder mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Comunidade</h2>
                  <p class="mb-0 fs-7 text-dark mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Partilha momentos com outros <span class="text-success">Atletas.</span></p>
                </div>
                <div class="feature col">
                  <div class="">
                    <img src="../../../landingpage/dist/images/icons/icone_progressao_green.png" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000" class="mb-3" height="64px" width="64px">
                  </div>
                  <h3 class="fs-11 fw-bolder mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Progressão</h3>
                  <p class="mb-0 fs-7 text-dark mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Analisa a tua <span class="text-primary">performance</span> diariamente.</p>
                </div>
                <div class="feature col">
                  <div class="">
                    <img src="../../../landingpage/dist/images/icons/icone_desporto_blue.png" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000" class="mb-3" height="64px" width="64px">
                  </div>
                  <h3 class="fs-11 fw-bolder mb-4 gap-2" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">Desporto</h3>
                  <p class="mb-0 fs-7 text-dark mb-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">A razão para estares aqui. Pratica e <span class="text-success">Vence!</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="features-section bg-light pt-lg-7 pt-sm-3 pb-8 pb-lg-9" id="features-courtify">
          <div class="container">
            <div class="row justify-content-center mt-3">
              <div class="col-lg-10">
                <div class="text-center">
                  <small class="text-primary fw-semibold mb-2 d-block fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">UM MUNDO DE POSSIBILIDADES</small>
                  <h2 class="fs-13 text-center mb-4 mb-lg-9 fw-bolder mt-3" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">Os aspetos <span class="text-primary">Chave</span> da<img src="../../../landingpage/dist/images/logos/logo_courtify.png" width="250px" alt="img-fluid" class="mb-4">

                  </h2>
                </div>
              </div>
            </div>
            <div class="review-slider" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000" style="height: 500px; width: auto;">
              <div class="owl-carousel owl-theme">
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-users text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Comunidade Desportiva</h5>
                      <p class="mb-0 fs-5">É aqui que as pessoas se conectam, através de uma plataforma robusta e
                        intuitiva que conecta entusiastas como tu. Isto inclui equipas formais, grupos de interesse e a
                        possibilidade de criar e participar em eventos desportivos locais.</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-soccer-field text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Abrangência de Modalidades</h5>
                      <p class="mb-0 fs-5">A Courtify abrange uma grande variedade de modalidades desportivas, desde o
                        Futebol, Ténis, Padel, Basquetebol, etc. A nossa plataforma é um lar para todas as paixões
                        desportivas.</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-notification text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Perfil e Notificações Pessoais</h5>
                      <p class="mb-0 fs-5">Oferecemos uma experiência personalizada para cada utilizador, quer seja um
                        jogador de futebol dedicado ou um tenista casual. O nosso sistema adapta o conteúdo e as
                        notificações às tuas preferências e necessidades.</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-calendar text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Agendamento dinâmico</h5>
                      <p class="mb-0 fs-5">Permitimos uma marcação de eventos desportivos fácil e flexível. Podes
                        inscrever-te em jogos com facilidade e de forma intuitiva, bem como criar os teus próprios e
                        convidar outros membros da comunidade.</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-graph text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Análise de dados</h5>
                      <p class="mb-0 fs-5">Fornecemos informações valiosas através da análise de dados para melhorar o
                        teu desempenho. Isto inclui estatísticas detalhadas, gráficos de progresso e recomendações
                        personalizadas.</p>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="card">
                    <div class="card-body text-center mb-0 mb-md-4" style="height: 400px; overflow-y: auto;">
                      <i class="d-block ti ti-device-gamepad-2 text-primary fs-9 fs-md-10"></i>
                      <h5 class="fs-7 fs-md-5 fw-bolder mt-3 mt-md-4 pb-3">Elementos de Gamificação</h5>
                      <p class="mb-0 fs-5">O intuito é tornar o desporto ainda mais competitivo com elementos de jogo.
                        Ganhe conquistas, medalhas, suba de nível, desafie amigos e participe em competições para dar um
                        toque de diversão extra e motivação à sua jornada desportiva.</p>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </section>
        <section class="pt-lg-7 pt-sm-3 pb-8 pb-lg-9" id="pacotes-courtify">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="lc-block mb-4 mt-3">
                  <small class="text-primary fw-semibold mb-2 d-block fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">AO ALCANCE DE UM CLIQUE</small>
                  <h2 class="fs-13 text-center mb-4 fw-bolder" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">É aqui o <span class="text-success">Ponto de Partida</span></h2>
                </div><!-- /lc-block -->
              </div>
            </div>
          </div>

          <div class="m-5">
            <div class="row mt-2">
              <div class="col-sm-12 mt-2 mt-md-0 col-lg-3" data-aos="fade-right" data-aos-delay="600" data-aos-duration="1000">
                <div class="card">
                  <div class="card-body">
                    <span class="fw-bolder text-primary fs-11 d-block mb-7">Atleta</span>
                    <h2 class="fw-bolder fs-9 mb-3">Grátis</h2>
                    <ul class="list-unstyled mb-7 fs-5">
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Perfil</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Análise de Dados</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Participação em Torneios</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Marcação de Campos</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Medalhas e Conquistas</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Acesso à Comunidade</span>
                      </li>
                    </ul>
                    <button class="btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">Saber Mais</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 mt-2 mt-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="card">
                  <div class="card-body">
                    <span class="fw-bolder text-primary fs-11 d-block mb-7">Atleta+</span>
                    <div class="d-flex mb-3">
                      <h2 class="fw-bolder ms-2 fs-9 mb-0">1.99</h2>
                      <h5 class="fw-bolder mb-0 fs-6">€</h5>
                      <span class="ms-2 fs-4 d-flex align-items-center">/mês</span>
                    </div>
                    <ul class="list-unstyled mb-7 fs-5">
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Perfil</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-primary fw-bolder">+ Análise de Dados</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Participação em Torneios</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Marcação de Campos</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-primary fw-bolder">+ Medalhas e Conquistas</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-primary fw-bolder">+ Acesso à Comunidade</span>
                      </li>
                    </ul>
                    <button class="btn btn-primary fw-bolder rounded-2 py-6 w-100 text-capitalize">Saber Mais</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 mt-2 mt-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="card">
                  <div class="card-body">
                    <span class="fw-bolder text-success fs-11 d-block mb-7">Clube</span>
                    <h2 class="fw-bolder fs-9 mb-3">Grátis</h2>
                    <ul class="list-unstyled mb-7 fs-5">
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Perfil</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Gestão de Campos (1 campo)</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Gestão de Marcações</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Acesso à Comunidade</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-x text-primary fs-4"></i>
                        <span class="text-muted">Equipas e Torneios</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-x text-primary fs-4"></i>
                        <span class="text-muted">Disponibilização de Resultados</span>
                      </li>
                    </ul>
                    <button class="btn btn-success fw-bolder rounded-2 py-6 w-100 text-capitalize">Saber Mais</button>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 mt-2 mt-lg-0 col-lg-3" data-aos="fade-left" data-aos-delay="600" data-aos-duration="1000">
                <div class="card">
                  <div class="card-body">
                    <span class="fw-bolder text-success fs-11 d-block mb-7">Clube+</span>
                    <div class="d-flex mb-3">
                      <h2 class="fw-bolder fs-9 ms-2 mb-0">3.99</h2>
                      <h5 class="fw-bolder fs-6 mb-0 me-2">€</h5>
                      <span class="ms-2 fs-4 d-flex align-items-center">/mês</span>
                    </div>
                    <ul class="list-unstyled mb-7 fs-5">
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Perfil</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-success fw-bolder">Gestão de Campos (N campos)</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Gestão de Marcações</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-dark">Acesso à Comunidade</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-success fw-bolder">Equipas e Torneios</span>
                      </li>
                      <li class="d-flex align-items-center gap-2 py-2">
                        <i class="ti ti-check text-primary fs-4"></i>
                        <span class="text-success fw-bolder">Disponibilização de Resultados</span>
                      </li>
                    </ul>
                    <button class="btn btn-success fw-bolder rounded-2 py-6 w-100 text-capitalize">Saber Mais</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
        <section class="pt-lg-7 pt-sm-3 pb-8 pb-lg-9 bg-light" id="equipa-courtify">
          <div class="container">
            <div class="row">

              <div class="col-md-12 text-center">
                <div class="lc-block mb-4 mt-3">
                  <small class="text-primary fw-semibold mb-2 d-block fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">APAIXONADOS PELO DESPORTO</small>
                  <h2 class="fs-13 text-center mb-4 fw-bolder" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">A <span class="text-success">Equipa</span> por trás da visão</h2>
                </div><!-- /lc-block -->
              </div>

            </div>

            <div class="row pt-4" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
              <div class="col-md-4 text-center py-4">
                <div class="lc-block"><img alt="" class="rounded-circle bg-white shadow mb-3" src="../../../landingpage/dist/images/img-equipa/foto_luis.png" style="height:20vh" loading="lazy">
                  <h5 editable="inline" class="fs-9"><strong>Luís Ramalhosa</strong></h5>

                  <small editable="inline" class="text-secondary fs-5" style="letter-spacing:1px">PROGRAMADOR</small>

                </div>
                <div class="lc-block mt-3">
                  <div editable="rich">
                    <p class="fs-5">25 anos | Évora</p>
                  </div>
                </div><!-- /lc-block -->
                <div class="lc-block"><a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" lc-helper="svg-icon" fill="currentColor" width="2em" height="2em">
                      <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                      </path>
                    </svg> </a>
                </div><!-- /lc-block -->
              </div>
              <div class="col-md-4 text-center py-4">
                <div class="lc-block"><img alt="" class="rounded-circle bg-white shadow mb-3" src="../../../landingpage/dist/images/img-equipa/foto_pedro.png" style="height:20vh" loading="lazy">
                  <h5 editable="inline" class="fs-9"><strong>Pedro Delfino</strong></h5>

                  <small editable="inline" class="text-secondary fs-5" style="letter-spacing:1px">PROGRAMADOR</small>

                </div>
                <div class="lc-block mt-3">
                  <div editable="rich">
                    <p class="fs-5">27 anos | Évora</p>
                  </div>
                </div><!-- /lc-block -->
                <div class="lc-block"><a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" lc-helper="svg-icon" fill="currentColor" width="2em" height="2em">
                      <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                      </path>
                    </svg> </a>
                </div><!-- /lc-block -->
              </div>
              <div class="col-md-4 text-center py-4">
                <div class="lc-block"><img alt="" class="rounded-circle bg-white shadow mb-3 object-fit-cover" src="../../../landingpage/dist/images/img-equipa/foto_mariana.png" style="height:20vh" loading="lazy">
                  <h5 editable="inline" class="fs-9"><strong>Mariana Martins</strong></h5>

                  <small editable="inline" class="text-secondary fs-5" style="letter-spacing:1px">PROGRAMADOR</small>

                </div>
                <div class="lc-block mt-3">
                  <div editable="rich">
                    <p class="fs-5">26 anos | Évora</p>
                  </div>
                </div><!-- /lc-block -->
                <div class="lc-block"><a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" lc-helper="svg-icon" fill="currentColor" width="2em" height="2em">
                      <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                      </path>
                    </svg> </a>
                  <a class="text-dark text-decoration-none" href="#"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                      <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                      </path>
                    </svg> </a>
                </div><!-- /lc-block -->
              </div>
            </div>

          </div>

        </section>
        <section class="bg-primary pt-lg-4 pt-sm-2 pb-7 pb-lg-6" id="sobrenos-courtify">
          <div class="container py-5">
            <div class="row">
              <div class="col-md-3 align-self-center justify-content-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                <div class="lc-block border-bottom text-center mt-3" style="letter-spacing:5px">
                  <div editable="rich">
                    <h2 class="text-white mt-3 fs-11 fw-bolder">Sobre Nós</h2>
                  </div>
                </div>
                <div class="text-center mt-2">
                  <img src="../../../landingpage/dist/images/logos/logo_icone.png" width="64px">
                </div>
              </div>
              <div class="me-5 col-md-5 mt-0 pt-sm-2" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                <div class="lc-block">
                  <div editable="rich">
                    <p class="text-white fs-7">A Courtify é uma Plataforma Desportiva concebida para satisfazer as tuas
                      necessidades como entusiasta do desporto, independentemente da tua idade ou nível de competência.<br>
                      Lançada em 2023, a Courtify é o resultado da visão e dedicação de três estudantes apaixonados por
                      programação e sistemas informáticos.</p>
                  </div>
                </div>
                <div class="lc-block">
                  <div editable="rich">
                    <p class="text-white fs-7">A nossa missão é promover a tua paixão pelo desporto, proporcionando-te uma
                      <b>experiência de utilizador</b> excecional, <b>características inovadoras</b> e uma <b>vasta gama de
                        funcionalidades</b> concebidas para melhorar a tua prática desportiva e o teu envolvimento na
                      comunidade.
                    </p>
                  </div>
                </div>
              </div>
              <div class=" col-md-3 d-flex justify-content-center align-self-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <img src="../../../landingpage/dist/images/backgrounds/bg_sobrenos.jpg" class="border border-2 border-white rounded" height="500px">
              </div>
            </div>
          </div>
        </section>
        <section class="py-3 py-md-5 pt-lg-7 pt-sm-3 pb-8 pb-lg-9" id="contactenos-courtify">
          <div class="col-md-12 text-center">

            <div class="lc-block mb-4 mt-3">
              <small class="text-primary fw-semibold mb-2 d-block fs-5" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">AINDA TEM DÚVIDAS?</small>

              <h2 class="fs-13 text-center mb-4 fw-bolder" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                Contacte-nos</h2>
            </div><!-- /lc-block -->
          </div>

          <div class="container">
            <div class="row justify-content-lg-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
              <div class="col-12 col-lg-9">
                <div class="bg-white border rounded shadow-sm overflow-hidden">

                  <form id="form">
                    <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                      <div class="field col-12 col-md-6">
                        <div class="">
                          <label for="fullname" class="form-label fs-5">Nome Completo <span class="text-danger ms-2">*</span></label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                              </svg>
                            </span>
                            <input type="text" class="form-control" id="fullname" name="from_name" value="" required>
                          </div>
                        </div>
                      </div>
                      <div class="field col-12 col-md-6">
                        <div class="">
                          <label for="reply-to" class="form-label fs-5">Email <span class="text-danger ms-2">*</span></label>
                          <div class="input-group">
                            <span class="input-group-text">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                </path>
                                <path d="M3 7l9 6l9 -6"></path>
                              </svg>
                            </span>
                            <input type="email" class="form-control" id="email" name="to_reply" value="" required>
                          </div>
                        </div>
                      </div>
                      <div class="field">
                        <div class="col-12">
                          <label for="message" class="form-label fs-5">Mensagem<span class="text-danger ms-2">*</span></label>
                          <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <input class="btn btn-primary btn-lg" type="submit" id="button" value="Enviar">
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
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

    <script src="../../dist/js/js_courtify/notificacao.js"></script>




    <script>
      $(document).ready(function() {

        $('body').tooltip({selector: '[data-toggle="tooltip"]'});

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



  </body>

  </html>
<?php
} else {
  header("Location: authentication-error.html");
  exit();
}


?>