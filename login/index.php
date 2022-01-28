<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Ampera</title>
  <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

<link href='https://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>
<body>
<div class="menu">
  <ul class="mainmenu clearfix">
    <li class="menuitem">Well</li>
    <li class="menuitem">how</li>
    <li class="menuitem">about</li>
    <li class="menuitem">that?</li>
  </ul>
</div>
<!-- <button id="findpass">¿Cuál es tu contraseña?</button> -->
<form class="form" method="POST" action="php/validar_ingreso.php" >
  <div class="forceColor"></div>
  <div class="topbar">
    <div class="spanColor"></div>
    <input type="password" class="input" id="password" name="password" placeholder="Contraseña"/>
  </div>
  <?php
    if($_SESSION['oportunidades']==NULL){
      echo '<button class="submit" id="submit" >Ingresar</button>';
    } elseif($_SESSION['oportunidades']==1){
      echo '<button class="submit" style="background-color: orange" id="submit" >Quedan 2 oportunidades</button>';
    } elseif($_SESSION['oportunidades']==2){
      echo '<button class="submit" style="background-color: #ff2c00" id="submit" >Queda 1 oportunidad</button>';
    } elseif($_SESSION['oportunidades']==3){
      echo '<button class="submit" style="background-color: red" id="submit" >Recordar su contraseña</button>';
    }
  ?>
</form>
<!-- <article class="article">
  <h1>This is an article</h1>
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam in laoreet mi. In hac habitasse platea dictumst. Ut varius scelerisque ipsum ac pretium. Aenean a luctus dolor. Fusce sodales iaculis ipsum vel aliquam. In tincidunt tellus faucibus nibh interdum, vel sollicitudin erat maximus. Etiam leo nisl, sodales id vulputate in, tincidunt facilisis felis. Mauris pellentesque libero in vestibulum porta. Vestibulum at nisi ullamcorper, molestie magna non, rhoncus nisi.

Duis vitae dapibus tortor. Quisque nec accumsan lacus. Ut purus nisl, semper sed justo interdum, venenatis facilisis mauris. Nulla et ipsum porttitor, hendrerit justo eu, euismod diam. Curabitur ac porttitor purus, ac gravida massa. Curabitur eleifend dolor eu tellus pretium, sit amet tristique leo tristique. Nulla sed maximus urna, quis varius neque. Pellentesque a ante tincidunt, maximus urna vitae, ultricies metus. Duis eu accumsan turpis. Ut vitae lorem auctor augue aliquet accumsan. Etiam sit amet eleifend libero, nec gravida nibh. Maecenas vitae ligula sodales, tempor nulla eget, bibendum justo. Proin vitae lectus malesuada, varius lacus a, tempor nisl. Vestibulum eget massa a arcu euismod fringilla a vitae magna. Aliquam nec ultricies nisi. Mauris et accumsan purus.

Sed quis felis consequat, posuere urna sodales, finibus nibh. Morbi euismod ut leo in gravida. In eu arcu a leo cursus tincidunt at sit amet nunc. Nunc volutpat massa eu tortor ornare, at elementum purus finibus. Integer nec feugiat felis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed blandit, est id luctus porta, risus elit varius nibh, non tempus lectus nisl vel velit. Nulla cursus malesuada felis. Duis eget orci in massa auctor porttitor sed auctor lectus.

Praesent eget pulvinar metus. Cras aliquam mollis mollis. Suspendisse potenti. Ut massa eros, ultrices mollis venenatis sit amet, posuere eu velit. Pellentesque a ligula dolor. Fusce mollis sed odio non dictum. Cras at pharetra nisl. Vivamus feugiat est ac vehicula pulvinar. Integer sed metus ut justo elementum suscipit sed sed eros. Proin ornare lacus vitae orci pellentesque varius.

Sed malesuada ac lorem sit amet convallis. Nulla et mauris nec magna faucibus viverra. Maecenas imperdiet nulla at orci malesuada rhoncus. Maecenas vel efficitur purus. Cras sit amet nibh congue, varius leo in, tempor nisl. Vestibulum a orci non tellus feugiat consequat. Ut at turpis lorem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer quam ante, luctus ac pulvinar id, gravida id odio. Mauris eu neque venenatis, fermentum nunc eget, convallis turpis.
</article> -->
</body>
</html>
