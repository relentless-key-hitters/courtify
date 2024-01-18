<?php 
session_start();

if (isset($_SESSION['id'])) {?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!--  Title -->
  <title>Courtify</title>
  <!--  Required Meta Tag -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="handheldfriendly" content="true" />
  <meta name="MobileOptimized" content="width" />
  <meta name="description" content="Mordenize" />
  <meta name="author" content="" />
  <meta name="keywords" content="Courtify" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/logo_icone.png" />
  <!-- Owl Carousel  -->

  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

  <link rel="stylesheet" href="../../dist/libs/sweetalert2/dist/sweetalert2.min.css">

  <!-- Core Css -->
  <link id="themeColors" rel="stylesheet" href="../../dist/css/style.min.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese.json"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">


  <style>
    body {
      overflow-x: hidden;
    }

    #tabela.dataTables_wrapper {
      padding: 10px;
    }

    #tabela_wrapper .dataTables_filter input {
      width: 250px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    #tabela_length select {
      margin-bottom: 10px;
      border-radius: 5px;
    }


    #tabela.dataTable thead th {
      text-align: center;
      font-weight: 600;
    }


    #tabela.dataTables tbody tr:nth-child(odd) {
      background-color: #e6e6e6;
      text-align: center;
    }


    #tabela.dataTables tbody tr.selected {
      background-color: #c7d4e8;
      text-align: center;
    }



    #tabela_paginate .paginate_button.current {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }

    #tabela_paginate .paginate_button:hover {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }


    #tabela_paginate .paginate_button.previous.hover,
    #tabela_paginate .paginate_button.next:hover,
    #tabela_paginate .paginate_button:hover {
      background-color: #e6e6e6;
      color: white;
      border: 1px solid white;
      border-radius: 6px;
    }
  </style>

</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!-- Preloader -->
  <div class="preloader">
    <img src="../../dist/images/logos/logo_icone.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="mt-2 d-flex align-items-center justify-content-center">
          <a href="./visao_dash.php" class="text-nowrap d-none d-xl-block">
            <img src="../../dist/images/logos/logo_courtify.png" class="dark-logo img-fluid" width="180" alt="" />
          </a>

          
          <a href="./visao_dash.php" class="text-nowrap d-block d-xl-none">
            <img src="../../dist/images/logos/favicon_svg.svg" class="dark-logo img-fluid" width="60" alt="" />
          </a>

          <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8 text-muted"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <!-- ============================= -->
            <!-- Home -->
            <!-- ============================= -->
            <!-- =================== -->
            <!-- Dashboard -->
            <!-- =================== -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu fs-6">Dashboard</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./visao_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Visão Geral</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./calendario_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendário</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./reserva_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-invoice"></i>
                </span>
                <span class="hide-menu">Reservas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./campos_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-soccer-field"></i>
                </span>
                <span class="hide-menu">Campos</span>
              </a>
            </li>
            <li class="sidebar-item selected">
              <a class="sidebar-link fs-4 link-active" href="#" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Membros</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./equipas_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-shirt-sport"></i>
                </span>
                <span class="hide-menu">Equipas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./torneios_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-tournament"></i>
                </span>
                <span class="hide-menu">Torneios</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./pagamentos_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-report-money"></i>
                </span>
                <span class="hide-menu">Pagamentos</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./historico_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Histórico</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link fs-4" href="./definicoes_dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Definições</span>
              </a>
            </li>
            <li class="sidebar-item mt-4">
              <a class="sidebar-link fs-4" style="background-color: #45702d; color: white; cursor: pointer;" onclick="logout()" aria-expanded="false">
                <span>
                  <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </li>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
  </div>

  <div class="body-wrapper">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-6" style="position: relative;">
        <div>
          <h1 class="text-dark fw-bolder pt-4" style="letter-spacing: 1px; font-size: 65px">
            Clube de Padel de Évora</h1>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <div class="dark-transparent sidebartoggler"></div>



  <div class="row">
    <div class="col-lg-3">

    </div>

    <div class="col-lg-7">
      <div class="badge-container2">
        <div class="row mb-0 mt-5">
          <div class="col-12 text-center">
            <h1 class="mb-0 mb-sm-0 fw-semibold align-items-center fs-9">Membros</h1>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-2">


    </div>

    <div class="col-lg-3">


    </div>

    <div class="col-lg-7">
      <div class="row mb-5">
        <div class="container mt-5">
          <table class="table text-center" id="tabela">
            <thead>
              <tr class="text-center">
                <th scope="col">ID (NIF)</th>
                <th scope="col">Foto</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Email</th>
                <th scope="col">Nível</th>
                <th scope="col">Nº Jogos Realizados</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
              </tr>
            </thead>
            <tbody>

              <tr class="text-center">
                <td>18994647</td>
                <td><img src="./../../dist/images/profile/boy11.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Pedro Barros</td>
                <td>1993-01-01</td>
                <td>pf_barros@outlook.com</td>
                <td>N3</td>
                <td>23</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>14748396</td>
                <td><img src="./../../dist/images/profile/boy10.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Rui Silva</td>
                <td>1998-08-12</td>
                <td>rui_silva@gmail.pt</td>
                <td>N4</td>
                <td>89</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>17663428</td>
                <td><img src="./../../dist/images/profile/boy12.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Filipe Serra</td>
                <td>1995-09-01</td>
                <td>serra_filipe@outlook.com</td>
                <td>N2</td>
                <td>292</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>14537272</td>
                <td><img src="./../../dist/images/profile/boy2.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Félix Cunha</td>
                <td>2004-06-18</td>
                <td>felix_2004@hotmail.com</td>
                <td>N4</td>
                <td>16</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>13898092</td>
                <td><img src="./../../dist/images/profile/boy.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Fernando Gomes</td>
                <td>1980-03-09</td>
                <td>frt_gomes@outlook.com</td>
                <td>N3</td>
                <td>178</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>14728323</td>
                <td><img src="./../../dist/images/profile/boy3.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Mário Pato</td>
                <td>1972-08-29</td>
                <td>pf_barros@outlook.com</td>
                <td>N3</td>
                <td>143</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>14129982</td>
                <td><img src="./../../dist/images/profile/boy4.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Alexandre Ribeiro</td>
                <td>1999-01-07</td>
                <td>alex_0909@outlook.com</td>
                <td>N4</td>
                <td>89</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>14538990</td>
                <td><img src="./../../dist/images/profile/girl.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Ana Torres</td>
                <td>1998-09-01</td>
                <td>ana_torres167</td>
                <td>N5</td>
                <td>29</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

              <tr class="text-center">
                <td>16729281</td>
                <td><img src="./../../dist/images/profile/girl2.jpg" alt="Thumbnail 1"
                    class="object-fit-cover rounded-2" width="30" height="30"></td>
                <td>Filipa Sousa</td>
                <td>1993-04-04</td>
                <td>sousa_fil19@outlook.com</td>
                <td>N4</td>
                <td>54</td>
                <td><button type="button" class="btn btn-sm ti ti-pencil text-white" data-toggle="modal"
                    data-target="#editMembrosModal" style="background-color: gold;"></button></td>
                <td><button type="button" class="btn btn-sm ti ti-x text-white"
                    style="background-color: firebrick;"></button></td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>


  <div class="modal modal-lg fade" id="editMembrosModal" tabindex="-1" role="dialog"
    aria-labelledby="editMembrosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-7" id="editMembrosModalLabel">Editar Membro</h5>
          <button type="button" class="btn btn-sm" style="background-color: darkgray;" data-dismiss="modal"
            aria-label="Close">
            <span> <i class="ti ti-x text-white"></i></span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="idEditMembro">ID (NIF)</label>
                <input type="number" disabled class="form-control" id="idEditMembro" placeholder="17663428">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="nomeEditMembro">Nome</label>
                <input type="text" disabled class="form-control" id="nomeEditMembro" placeholder="Filipe Serra">
              </div>
            </div>

            <div class="col-md-4 pt-4">
              <div class="form-group">
                <label for="emailEditMembro">Email</label>
                <input type="email" class="form-control" id="emailEditMembro" placeholder="serra_filipe@outlook.com">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 pt-4">
                <div class="form-group">
                  <label for="nivel">Nível</label>
                  <select name="nivel" class="form-select" id="nivelEditMembro">
                    <option class="text-muted" value="" disabled>Escolha o nível</option>
                    <option value="editSC">Sem Classificação</option>
                    <option value="editN5">N5</option>
                    <option value="editN4">N4</option>
                    <option value="editN3">N3</option>
                    <option selected value="editN2">N2</option>
                    <option value="editN1">N1</option>
                  </select>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-2 pt-4">
                <label for="obsEditMembros">Observações</label>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <textarea id="obsEditMembros" cols="6" rows="3" class="form-control"></textarea>
              </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-success">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-9">
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
      <div class="col-lg-1"></div>
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
                    <button class="btn text-success bg-light-success  p-0 round-20 border-0 add" type="button"
                      id="addo2">
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
                      <img src="../../dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24"
                        height="24">
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
                      <img src="../../dist/images/svgs/icon-dd-cart.svg" alt="" class="img-fluid" width="24"
                        height="24">
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
                      <img src="../../dist/images/svgs/icon-dd-date.svg" alt="" class="img-fluid" width="24"
                        height="24">
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

    <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
      type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
    </button>
    <div class="offcanvas offcanvas-end customizer" tabindex="-1" id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel" data-simplebar="">
      <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body p-4">
        <div class="theme-option pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Option</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style.min.css')"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 light-theme text-dark">
              <i class="ti ti-brightness-up fs-7 text-primary"></i>
              <span class="text-dark">Light</span>
            </a>
            <a href="javascript:void(0)" onclick="toggleTheme('../../dist/css/style-dark.min.css')"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 dark-theme text-dark">
              <i class="ti ti-moon fs-7 "></i>
              <span class="text-dark">Dark</span>
            </a>
          </div>
        </div>
        <div class="theme-direction pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Direction</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-text-direction-ltr fs-6 text-primary"></i>
              <span class="text-dark">LTR</span>
            </a>
            <a href="../rtl/index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-text-direction-rtl fs-6 text-dark"></i>
              <span class="text-dark">RTL</span>
            </a>
          </div>
        </div>
        <div class="theme-colors pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Theme Colors</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <ul class="list-unstyled mb-0 d-flex gap-3 flex-wrap change-colors">
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin1-bluetheme-primary active-theme "
                  onclick="toggleTheme('../../dist/css/style.min.css')" data-color="blue_theme" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-title="BLUE_THEME"><i
                    class="ti ti-check text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin2-aquatheme-primary "
                  onclick="toggleTheme('../../dist/css/style-aqua.min.css')" data-color="aqua_theme"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME"><i
                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin3-purpletheme-primary"
                  onclick="toggleTheme('../../dist/css/style-purple.min.css')" data-color="purple_theme"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME"><i
                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin4-greentheme-primary"
                  onclick="toggleTheme('../../dist/css/style-green.min.css')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-title="GREEN_THEME"><i
                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin5-cyantheme-primary"
                  onclick="toggleTheme('../../dist/css/style-cyan.min.css')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-title="CYAN_THEME"><i
                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
              <li class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center justify-content-center">
                <a href="javascript:void(0)"
                  class="rounded-circle position-relative d-block customizer-bgcolor skin6-orangetheme-primary"
                  onclick="toggleTheme('../../dist/css/style-orange.min.css')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-title="ORANGE_THEME"><i
                    class="ti ti-check  text-white d-flex align-items-center justify-content-center fs-5"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="layout-type pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Layout Type</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="./index.html" class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-layout-sidebar fs-6 text-primary"></i>
              <span class="text-dark">Vertical</span>
            </a>
            <a href="../horizontal/index.html"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2">
              <i class="ti ti-layout-navbar fs-6 text-dark"></i>
              <span class="text-dark">Horizontal</span>
            </a>
          </div>
        </div>
        <div class="container-option pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Container Option</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 boxed-width text-dark">
              <i class="ti ti-layout-distribute-vertical fs-7 text-primary"></i>
              <span class="text-dark">Boxed</span>
            </a>
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 full-width text-dark">
              <i class="ti ti-layout-distribute-horizontal fs-7"></i>
              <span class="text-dark">Full</span>
            </a>
          </div>
        </div>
        <div class="sidebar-type pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Sidebar Type</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 fullsidebar">
              <i class="ti ti-layout-sidebar-right fs-7"></i>
              <span class="text-dark">Full</span>
            </a>
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center text-dark sidebartoggler gap-2">
              <i class="ti ti-layout-sidebar fs-7"></i>
              <span class="text-dark">Collapse</span>
            </a>
          </div>
        </div>
        <div class="card-with pb-4">
          <h6 class="fw-semibold fs-4 mb-1">Card With</h6>
          <div class="d-flex align-items-center gap-3 my-3">
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 text-dark cardborder">
              <i class="ti ti-border-outer fs-7"></i>
              <span class="text-dark">Border</span>
            </a>
            <a href="javascript:void(0)"
              class="rounded-2 p-9 customizer-box hover-img d-flex align-items-center gap-2 cardshadow">
              <i class="ti ti-border-none fs-7"></i>
              <span class="text-dark">Shadow</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!--  Import Js Files -->
    <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <script src="../../dist/js/custom.js"></script>
    <!--  current page js files -->
    <script src="../../dist/js/js_courtify/clube/clubeLogout.js"></script>
    <script src="../../dist/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <script>
      $(document).ready(function () {
        $('#tabela').DataTable({
          responsive: true,
          ordering: false,
          "language": {
            "sEmptyTable": "Nenhum registo encontrado",
            "sInfo": "Mostrando _END_ de _TOTAL_ registos",
            "sInfoEmpty": "Mostrando 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registo encontrado",
            "sSearch": "Pesquisar (id, nome, nível, etc...)",
            "oPaginate": {
              "sNext": ">",
              "sPrevious": "<",
              "sFirst": "Primeiro",
              "sLast": "Último"
            },
            "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
              "rows": {
                "_": "Selecionado %d linhas",
                "0": "Nenhuma linha selecionada",
                "1": "Selecionado 1 linha"
              }
            }
          }
        });
      });
    </script>


</body>

</html>
<?php
} else {
  header("Location: ../horizontal/authentication-error.html");
  exit();
}


?>