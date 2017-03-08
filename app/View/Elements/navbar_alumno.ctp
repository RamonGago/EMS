<div id="throbber"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <a class="navbar-brand" href="index">
                <img src="../img/logo_uvigo.png" alt="EMS" />
                </a>
        </div>
            <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario<!-- < ?=$current_user['username']?>--> <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="perfil"><i class="fa fa-2x fa-user"></i>&nbsp Mi perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="logout"><i class="fa fa-2x fa-sign-out"></i>&nbsp Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="index"><i class="fa fa-2x fa-home"></i> &nbsp INICIO</a>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-2x fa-universal-access"></i> &nbsp  PLAZA ERASMUS <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="#"><i class="fa fa-fw fa-map-marker"></i> &nbsp DESTINOS ERASMUS</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-exchange"></i> &nbsp MI PLAZA</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-2x fa-mail-forward"></i> &nbsp SOLICITUDES<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="#"><i class="fa fa-fw fa-edit"></i> &nbsp PLAZA ERASMUS</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-plus"></i> &nbsp AMPLIACION DE ESTANCIA</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-ban"></i> &nbsp RENUNCIA DE PLAZA</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-3"><i class="fa fa-2x fa-folder-open-o"></i> &nbsp DOCUMENTACIÓN<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-3" class="collapse">
                        <li><a href="#"><i class="fa fa-fw fa-upload"></i> &nbsp ENVIADA</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-history"></i> &nbsp PENDIENTE</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-times"></i> &nbsp RECHAZADA</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-check-square-o"></i> &nbsp VALIDADA</a></li>
                    </ul>
                </li>
                <li>
                    <a href="learning_agreement"><i class="fa fa-2x fa-file-text-o"></i> &nbsp CONTRATO DE ESTUDIOS</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div><!-- /#wrapper -->