<?php
require '/clases/Autocarga.php';
$sesion = new Session();
if(!$sesion->isLogged()){
    $sesion->sendRedirect("index.php");
      
}else{
 $user = new Usuario();
$user = $sesion->getUser(); 
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
        
        <div id="navcontain">
            <div id="nav">
                <div id="vinilo">
                </div>
                <div id="logoname">
                    <h1 id="logotipo">RedVinyl</h1>
                </div>
                <div id="list">
                    <ul class="menuH">
                        <li><a href="index.html"  class="nave">Home</a></li>
                        <li><a href="index.html"  class="nave">News</a></li>
                        <li><a href="index.html " class="nave">Team</a></li>
                        <li><a href="index.html"  class="nave">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="containermusic">
            <div id="containerelements">
                <div id="disco">
                    
                    <div id="fotocirculo" STYLE="background-image: url('<?php echo "mp3/usuarios/" . $user->getNombre() . "/avatar.jpg" ?>')">
                    </div>

                </div>
                <div id="infousuario">
                    <p id="nombreusuario"><?php echo $user->getNombre() ?></p>
                    <p id=totalcanciones>Songs Available: <?php echo Listpodcast::CountFiles($user->getNombre()) ?> </p>
    
                    <p id="cierre"><a href="logout.php">LogOut</a></p>
                    
                    <p id="back"><a href="user.php"><-- Back</a></p>
                    
                </div>
                
                
                 
                <div id="areamusicaborrar">
                    <div class="titulosecciones"><p id="textostandar1">List of songs.</p></div>
                      <ul class="listadodemusica">       

                        <?php
                        echo Listpodcast::listarCanciones($user->getNombre(), "Rock", "private");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Pop", "private");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Heavy", "private");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Jazz", "private");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Soul", "private");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Rock", "public");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Pop", "public");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Heavy", "public");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Jazz", "public");
                        echo Listpodcast::listarCanciones($user->getNombre(), "Soul", "public");
                        $var=  Request::get('src');
                        ?>
                    </ul>
                     <?php 
            if(file_exists($var)){
                    unlink($var);
                    header('Location:menuborrar.php');
                }
            ?>
                    
                </div>
      
            </div>
        </div>
        <footer>
            <div id="contenidopie">
                <div class="infopie2">
                    <p id="copy2">© EIDOSDESIGN ESTUDIO · 2015 · ALL RIGHTS RESERVED<span id="web">www.eidosdesign.es</span></p>
                </div>

            </div>          
        </footer>

    </body>

</html>