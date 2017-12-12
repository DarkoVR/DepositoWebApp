<?php
  include 'header.php';
?>
    <div id="wrapper-sec">
        <img id="banner-sec" src="images/banner-sec.jpg" width=100% height=100%>
       <div id="content">
          <section>
            <h2>Ubicación</h2>
            <article>
                <h3> Estamos ubicados en Leandro Valle #402 en Apaseo el alto, Gto.</h3>
                
            </article>
            <h2>Mapa</h2>
            <article>
                <p>
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.161956757384!2d-100.62061638550638!3d20.45854018631002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d34b4a963361b1%3A0x6b92ecd3aba5fa87!2sCalle+Leandro+Valle+402%2C+Zona+Centro%2C+38500+Apaseo+el+Alto%2C+Gto.!5e0!3m2!1ses!2smx!4v1492578066122" width=100% height="600" frameborder="0" style="border:0;" allowfullscreen></iframe>
                </p>
            </article>
            <button onclick="printpage()">Imprimir</button><br><br>
            <script>
                function printpage(){
                    window.print();
                }
            </script>
        </section>
       </div><!--Div de content-->
    </div><!--Div de wrapper-->
<?php
  include 'footer.php';
?>