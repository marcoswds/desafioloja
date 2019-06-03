<?php
session_start();
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html>

<!-- Jquery 3.4.0 -->
<script src="visual/js/jquery-3.4.0.min.js"></script>

<!-- Material Icons Font -->
<link href="visual/fonts/material_icons_css.css" rel="stylesheet">

<!-- Materialize CSS 1.0.0 -->
<link rel="stylesheet" href="visual/css/materialize.min.css">

<body class="grey lighten-4">

   <main id="index" style="padding: 100px">

      <div class="row">
         <div class="col s12">
            <div class="col s6 l3 offset-l3">
               <div class="card card-panel white">
                  <div class="card-image">
                     <img src="visual/images/manager.png">
                     <a class="btn-floating halfway-fab waves-effect waves-light red" href="admin.php"><i class="material-icons">person</i></a>
                  </div>
                  <div class="card-title center">
                     <p><strong>Perfil: Administrador</strong></p>
                  </div>
               </div>
            </div>
            <div class="col s6 l3">
               <div class="card card-panel white">
                  <div class="card-image">
                     <img src="visual/images/vendedor.png">
                     <a class="btn-floating halfway-fab waves-effect waves-light red" href="vendedor.php"><i class="material-icons">person</i></a>
                  </div>
                  <div class="card-title center">
                     <p><strong>Perfil: Vendedor</strong></p>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </main>
</body>

<!-- Materialize JS 1.0.0 -->
<script src="visual/js/materialize.min.js"></script>

<script>
   $(document).ready(function(){
      $('.tooltipped').tooltip();
   });
</script>

</html>