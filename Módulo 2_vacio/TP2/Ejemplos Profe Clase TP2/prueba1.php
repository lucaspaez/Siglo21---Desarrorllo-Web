<?php session_start();
   if (!isset($_SESSION["cuenta_paginas"])){
       $_SESSION["cuenta_paginas"] = 1;
   }else{
       $_SESSION["cuenta_paginas"]++;
   }
?>
<html>
<head>
<title>Contar páginas vistas por un usuario en toda su sesión</title>
</head>

<body>
<?php
   echo "Desde que entraste has visto " . $_SESSION["cuenta_paginas"] . " páginas";
?>
<br>
<br>
<a href="prueba1.php">Ver otra página</a>
<br>
<a href='logica/salir.php'>Salir</a>
</body>
</html>