<!doctype html>
<html>
    <head>
    	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    	<title>Depósito Vázquez</title>
    	<link rel="stylesheet" type="text/css" href="css/main.css">
         <!--Script para Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--Script para jquerys-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--Scripts para JQueryUI-->
      
        <!---->
    </head>
    <!--Div indispensable no se porque para la convertir el fondo transparente-->
    <div id="top"></div>
    <!--Div del sidenav-->
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <a href="venta/login/">Sign In</a>
      <a href="venta/registro/nuevo.php">Sign Up</a>
      <h3 style="color: white;">Redes sociales</h3>
      <table id="tabla_redes" width="100%" style="margin-left: -15px;">
          <tr>
              <th><a href="https://www.facebook.com/">
                  <img src="images/social1.png" width="42" height="42" alt="">
              </a></th>
              <th><a href="https://www.twitter.com">
                  <img src="images/social2.png" width="44" height="40" alt="">
              </a></th>
              <th><a href="https://www.gmail.com">
                  <img src="images/social3.png" width="50" height="40" alt="">
              </a></th>
          </tr>
      </table>
    </div>
    <!---->
    <body id="main" onscroll="_verScroll()">
    <div id="header">
        <nav id="menu_principal">
            <ul id="lista_principal" style="background: transparent;">
                <li><a href="index.php">Depósito Vázquez</a></li>
                <li>
                <div class="flexsearch">
                    <div id="busqueda" class="flexsearch--wrapper">
                        <form class="flexsearch--form" action="php/buscar.php" method="GET">
                            <div class="flexsearch--input-wrapper">
                                <input id="btSubmit" class="flexsearch--input" type="search" placeholder="Buscar productos por nombre, código o categoría..." name="search" required>
                            </div>
                            <input class="flexsearch--submit" type="submit" value="&#10140;"/>
                        </form>
                    </div>
                </div>
                </li>
                <li><a class="btn btn-link btn-lg" id="btDesplegar">
                    <span  class="glyphicon glyphicon-th-list"></span> Menú
                 </a></li>
                <li><a class="btn btn-link btn-lg" id="btOcultar" style="display: none;">
                    <span  class="glyphicon glyphicon-th-list"></span> Menú
                </a></li>
                  <li><a id="btComprar" href="productos.php">
                    <span class="glyphicon glyphicon-shopping-cart" style="margin-left: -32px;"></span> Comprar
                </a></li>
                <li>
                <a id="btLogin" class="btn btn-link btn-sm">
                    <span  class="glyphicon glyphicon-log-in" style="cursor: pointer; font-size: 17px; font-weight: bold; margin-left: -32px;" onclick="openNav()"> login</span>
                 </a>
                </li>
            </ul>
        </nav>
        <nav id="menu_superior">
        <ul id="lista_superior" style="background: transparent; opacity: 1;">
            <li><a class="menu_escondido" href="marcas.php" id="dropbtn" style="display: none">Marcas</a></li>
            <li><a class="menu_escondido" href="quienes_somos.php" style="display: none">¿Quiénes somos?</a></li>
            <li><a class="menu_escondido" href="ubicacion.php" style="display: none">Ubicación</a></li>
            <li><a class="menu_escondido" href="horarios.php" style="display: none">Horarios</a></li>
            <li><a class="menu_escondido" href="clientes.php" style="display: none">Clientes</a></li>
            <li><a class="menu_escondido" href="contacto.php" style="display: none">Contacto</a></li>
        </ul>
        </nav>
                                        <!--<p id="escribe_aca">0</p>-->
        <div id="Scripts">
        <!--Scrip para desplegar menu superior-->
        <script>
            $( "#btDesplegar" ).click(function() {
              $( ".menu_escondido" ).show(  );
              $( "#btOcultar" ).show(  );
              $( "#btDesplegar" ).hide(  );
            });

            $( "#btOcultar" ).click(function() {
              $( ".menu_escondido" ).hide(  );
              $( "#btOcultar" ).hide(  );
              $( "#btDesplegar" ).show(  );
            });
        </script>
        <!--Scrip para autocompletar de barra de busqueda-->
        <script>
          $( function() {
            var availableTags = [
              "Coca-Cola",
              "Pepsi",
              "Sidral Mundet",
              "Refresco",
              "Jugo",
              "Agua",
              "Ubicacion",
              "Mayoreo",
              "Bonafont",
              "Precio",
              "Cerveza",
              "Corona",
              "600ml",
              "1L",
              "2L",
              "3L",
              "litros",
              "Ofertas",
              "Descuentos",
              "Clientes",
              "Ayuda",
              "Si el hombre araña el niño rasguña?"
            ];
            $( "#busqueda" ).autocomplete({
              source: availableTags
            });
          } );
        </script>
        <!--Scrip para el sidenav de login-->
        <script>
        a=document.body.scrollTop;

        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.position="absolute"; /*position="fixed";*/
            document.getElementById("busqueda").style.width="350px";
            document.getElementById("lista_superior").style.padding="0px 0px 0px 7%";
            document.getElementById("btSubmit").placeholder="Buscar...";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.body.style.backgroundColor = "white";
            document.body.style.position="relative";
            document.getElementById("busqueda").style.width="600px";
            document.getElementById("lista_superior").style.padding="0px 0px 0px 15%";
            document.getElementById("btSubmit").placeholder="Buscar productos por nombre, código o categoría...";
        }
        </script>
        <!--Script para mostrar menu principal-->
        <script>
        function _verScroll(){
          a=document.body.scrollTop;
          if(a>=700){
            document.getElementById('lista_principal').style.backgroundColor = '#111';
            document.getElementById('lista_superior').style.backgroundColor = '#111';
            document.getElementById('lista_superior').style.opacity="0.7";
          }else {
            document.getElementById('lista_principal').style.backgroundColor = 'transparent';
            document.getElementById('lista_superior').style.backgroundColor = 'transparent';
            document.getElementById('lista_superior').style.opacity="1";
          }
          }
        </script>
        </div><!--Div de los scripts-->
        <!--Inicio de body wrapper-->
    </div><!--Div del header-->
    <div id="wrapper-prim">
        <img src="images/banner.png" width=100% height=100%>
        <hr style="height: 110px;background-color: #111;margin-top: -.5px;margin-bottom: 1px;">
        <header>
            <!--Inicio de carousel de imagenes del encabezado-->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="images/header_logo.jpg" width="100%" height="100%">
                  </div>

                  <div class="item">
                    <img src="images/header_logo2.jpg"  width="100%" height="100%">
                  </div>
                
                  <div class="item">
                    <img src="images/header_logo3.jpg"  width="100%" height="100%">
                  </div>

                  <div class="item">
                    <img src="images/header_logo4.jpg"  width="100%" height="100%">
                  </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <!--Fin de carousel-->
        </header>
        <div id="content">
		<section>
            <h2>"DEPÓSITO VÁZQUEZ" APASEO EL ALTO, GTO.</h2>
            <article id="a1">
                <table class="tablas">
                    <tr>
                        <th>
                            <div id="img-contenedor">
                            <img src="images/tabla1.jpg">
                            </div>
                        </th>
                        <th>
                            <div id="img-contenedor">
                            <img src="images/tabla2.jpg">
                            </div>
                        </th>
                        <th>
                            <div id="img-contenedor">
                            <img src="images/tabla3.jpg">
                            </div>
                        </th>
                        <th>
                            <div id="img-contenedor">
                            <img src="images/tabla4.jpg">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center; padding: 20px;">Coca-Cola Original</td>
                        <td style="text-align: center;">Coca-Cola Light</td>
                        <td style="text-align: center;">Coca-Cola Verde</td>
                        <td style="text-align: center;">Coca-Cola Sin Azúcar</td>
                    </tr>
                </table>
            </article>
            <article>
                <h3>Nos comprometemos contigo, para darte el mejor servicio</h3>
                <h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h3>
            </article>
            <h2>Promociones</h2>
            <article>
                <img id="promocion" src="images/promo1.jpg" width="100%" height="400px">
                <p>
                    <script type="text/javascript">
                    var fecha = new Date();
                    var day = fecha.getDate();
                    var month = fecha.getMonth();
                    var months = ['enero', 'febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Diciembre'];
                    var year = fecha.getFullYear();
                    day = day + 10;
                    document.write("*La promocion termina el dia "+ day + " de " + months[month] + " del " + year);
                </script>
                </p>
                <p>
                    <button onclick="document.getElementById('promocion').src='images/promo1.jpg'">Promo 1</button>
                    <button onclick="document.getElementById('promocion').src='images/promo2.jpg'">Promo 2</button>
                    <button onclick="document.getElementById('promocion').src='images/promo3.jpg'">Promo 3</button>
                    <br><br>
                </p>
            </article>
        </section>
		
	</div><!--Div de content-->
    </div><!--Div de wrapper-->
    <div id="footer">
	<nav id="menu_inferior">
	</nav>
	<footer>
		<p>
            Copyright DARKOVRSOFT © 2017<br />
            <script type="text/javascript" >
                document.write(Date());
            </script>
        </p>
	</footer>
    </div>
    </body>
</html>