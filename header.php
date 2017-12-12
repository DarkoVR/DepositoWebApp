<?php
  include 'configuracion.php';
?>
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
            <ul id="lista_principal">
                <li><a href="index.php">Depósito Vázquez</a></li>
                <li><div class="flexsearch">
                    <div id="busqueda" class="flexsearch--wrapper">
                        <form class="flexsearch--form" action="php/buscar.php" method="GET">
                            <div class="flexsearch--input-wrapper">
                                <input id="btSubmit" class="flexsearch--input" type="search" placeholder="Buscar productos por nombre, código o categoría..." name="search" required>
                            </div>
                            <input class="flexsearch--submit" type="submit" value="&#10140;"/>
                        </form>
                    </div>
                </div></li>
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
        <ul id="lista_superior">
             <li><a class="menu_escondido" href="marcas.php" id="dropbtn" style="display: none">Marcas</a></li>
            <li><a class="menu_escondido" href="quienes_somos.php" style="display: none">¿Quiénes somos?</a></li>
            <li><a class="menu_escondido" href="ubicacion.php" style="display: none">Ubicación</a></li>
            <li><a class="menu_escondido" href="horarios.php" style="display: none">Horarios</a></li>
            <li><a class="menu_escondido" href="clientes.php" style="display: none">Clientes</a></li>
            <li><a class="menu_escondido" href="contacto.php" style="display: none">Contacto</a></li>
        </ul>
        </nav>
        </nav>                                        <!--<p id="escribe_aca">0</p>-->
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
              "ActionScript",
              "AppleScript",
              "Asp",
              "BASIC",
              "C",
              "C++",
              "Clojure",
              "COBOL",
              "ColdFusion",
              "Erlang",
              "Fortran",
              "Groovy",
              "Haskell",
              "Java",
              "JavaScript",
              "Lisp",
              "Perl",
              "PHP",
              "Python",
              "Ruby",
              "Scala",
              "Scheme"
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
        <!--Script para tooltiptext-->
        <script>
          $( function() {
            $( document ).tooltip();
          } );
          </script>
          <style>
          label {
            display: inline-block;
            width: 10em;
          }
          </style>
          <!--Script para el checkbox-->
          <script>
          $( function() {
            $( "input" ).checkboxradio();
          } );
          </script>
        </div><!--Div de los scripts-->
        <!--Inicio de body wrapper-->
    </div><!--Div del header-->