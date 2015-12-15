<?php
require '/clases/Autocarga.php';
$sesion = new Session();
if(!$sesion->isLogged()){
    $sesion->sendRedirect("index.php");
      
}else{
  $user = new Usuario();
$user = $sesion->getUser();
$param = Request::get('song');  
}



?>



<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">

        <title>RedVinyl</title>
        <link rel="stylesheet" type="text/css" href="reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />

        <link href='https://fonts.googleapis.com/css?family=Work+Sans:200' rel='stylesheet' type='text/css'>

        
    </head>

    <!-- CSS -->

    <body>
           
                <div id="contenedordeerror">       
                    <form action="user.php" method="POST">
                     <p id='error'>UPLOAD FILE ERROR. TRY AGAIN</p>    
                    <input type="submit" value="back" name="back" id="botonerror" />
                    </form>
                </div>

    </body>

</html>