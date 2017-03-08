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
                    <a href="index"><i class="fa fa-2x fa-users"></i> &nbsp LISTADO DE ALUMNOS</a>
                </li>
                <li>
                    <a href="index"><i class="fa fa-2x fa-inbox"></i> &nbsp GESTIONAR SOLICITUDES</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div><!-- /#wrapper -->