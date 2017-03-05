<div id="throbber" style="display:none; min-height:120px;"></div>
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
                <img src="../img/erasmus.jpg" alt="EMS" />
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
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-2x fa-home"></i> &nbsp Inicio<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp SUBMENU 1.1</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp SUBMENU 1.2</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp SUBMENU 1.3</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-2x fa-globe"></i> &nbsp  Gestionar plaza <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp Solicitar plaza</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp Ver destinos erasmus</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp +info</a></li>
                    </ul>
                </li>
                <li>
                    <a href="documentation_send"><i class="fa fa-2x fa-mail-forward"></i> &nbsp Enviar documentación</a>
                </li>
                <li>
                    <a href="learning_agreement"><i class="fa fa-2x fa-file-text-o"></i> &nbsp Contrato de estudios</a>
                </li>
                <li>
                    <a href="extension_request"><i class="fa fa-2x fa-plus"></i> &nbsp Ampliación de estancia</a>
                </li>
                <li>
                    <a href="resignation"><i class="fa fa-2x fa-remove"></i> &nbsp Renuncia de plaza</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div><!-- /#wrapper -->