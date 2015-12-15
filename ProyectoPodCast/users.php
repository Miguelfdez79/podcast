<?php
require '/clases/Autocarga.php';
$sesion = new Session();
$user = new Usuario();
$user = $sesion->getUser();
$nombre = Request::get('nombre');
$param = Request::get('song');

?>



<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="UTF-8">

        <title>RedVinyl</title>
        <link rel="stylesheet" type="text/css" href="reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />

        <link href='https://fonts.googleapis.com/css?family=Work+Sans:200' rel='stylesheet' type='text/css'>

<!--        <script> 
                var looper;
                var degrees = 0;
                var nodoli = document.getElementsByTagName("a");
                var nodoa;

                for (var i = 0; i < nodoli.length; i++) {
                    nodoa = nodoli[i];
                    nodoa.addEventListener("click", rotateAnimation);
                }

                function rotateAnimation(el, speed) {
                    var div = document.getElementById("disco");
                    if (navigator.userAgent.match("Chrome")) {
                        div.style.WebkitTransform = "rotate(" + degrees + "deg)";
                    } else if (navigator.userAgent.match("Firefox")) {
                        div.style.MozTransform = "rotate(" + degrees + "deg)";
                    } else if (navigator.userAgent.match("MSIE")) {
                        div.style.msTransform = "rotate(" + degrees + "deg)";
                    } else if (navigator.userAgent.match("Opera")) {
                        div.style.OTransform = "rotate(" + degrees + "deg)";
                    } else {
                        div.style.transform = "rotate(" + degrees + "deg)";
                    }
                    looper = setTimeout('rotateAnimation(\'' + el + '\',' + speed + ')', speed);
                    degrees++;
                    if (degrees > 359) {
                        degrees = 1;
                    }
                  
                }
        </script>-->
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
                    <script>rotateAnimation("disco", 30);</script>
                     <div id="fotocirculo" STYLE="background-image: url('<?php echo "mp3/usuarios/" . $nombre . "/avatar.jpg" ?>')">
                    </div>
                </div>
                <div id="infousuario">
                    <p id="nombreusuario"><?php echo $nombre?></p>
                    <p id=totalcanciones>Songs Available:</p>
                    <form action="gestionmusica.php" method="post" enctype="multipart/form-data" id="formmusica">
                        <label for="subir">Upload new song</label>
                        <input type="file" name="archivo" />

                        <label for="listagenero">Genre</label>
                        <select name="categorias" id="categorias">
                            <option label="Pop" value="Pop">
                            <option label="Rock" value="Rock">
                            <option label="Heavy" value="Heavy">
                            <option label="Jazz" value="Jazz">
                            <option label="Soul" value="Soul">
                        </select>
                        <label for="listagenero">Privacidad</label>
                        <select name="privacidad" id="privacidad">
                            <option label="Private" value="Private">
                            <option label="Public" value="Public">

                        </select>

                        <input type="submit" id="botonsubirfile" />

                    </form>
                    <p id="cierre"><a href="logout.php">LogOut</a></p>
                                                     <div id="borrado">
                               <?php if($user->getNombre() == "admin"){
                   echo "<a href='menuborraradmin.php'><div id='menuborraradmin'>Delete Sogns</div></a>";
                   
                   }else{
                    echo "<a href='menuborrar.php'><div id='menuborrar'>Delete Sogns</div></a>";
                   } 
                   ?>         
            </div>
                    <audio controls autoplay>
                        <source src="<?php echo utf8_decode($param) ?>" type="audio/mp3">
                    </audio>
                </div>

                <div id="areamusica">
                        <div class="titulosecciones"><p id="textostandar1">List of songs.</p></div>
                     <ul class="listadodemusica">       

                        <?php
                        echo Listpodcast::listar($user->getNombre(), "Rock", "private", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Pop", "private", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Heavy", "private", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Jazz", "private", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Soul", "private", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Rock", "public", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Pop", "public", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Heavy", "public", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Jazz", "public", $nombre);
                        echo Listpodcast::listar($user->getNombre(), "Soul", "public", $nombre);
                        ?>
                    </ul>
                </div>
                 <div id="listadeusuarios">
                    <div class="titulosecciones"><p id="textostandar1">Users</p></div>
                    <ul class="listadodemusica">       

                        <?php
                        echo Listpodcast::mostrarusuarios($user->getNombre());
                        ?>
                    </ul>         
                </div>
                
                <div id="ultimostitulos">
                    <div id="tituloseccion"><p id="textostandar1">Latest Uploads</p></div>
                    <ul class="listadodemusica2">       
<?php
                        $string = "";                      
                        function ListFilesPath($dir) {
                            if($dh = opendir($dir)) {
                                $files = Array();                             
                                $inner_files = Array();
                                while($file = readdir($dh)) {
                                    if($file != "." && $file != ".." && $file[0] != '.') {
                                        if(is_dir($dir . "/" . $file)) {
                                            $inner_files = ListFilesPath($dir . "/" . $file);
                                            if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
                                        } else {
                                            array_push($files, $dir . "/" . $file);
                                        }
                                    }
                                }
                                for ($index = 0; $index < count($files); $index++) {
                                    if(strpos($files[$index], "avatar.jpg") == true){
                                       unset($files[$index]);
                                   }
                                }
                                ksort($files);                           
                                closedir($dh);
         
                                if(empty($files)){
                                    return false;
                                }
                                return $files;                         
                           }
                        }
                        
                        function ListFilesShort($dir) {
                            if($dh = opendir($dir)) {
                                $newshortfiles = Array();
                                $files = Array();                             
                                $inner_files = Array();
                                while($file = readdir($dh)) {
                                    if($file != "." && $file != ".." && $file[0] != '.') {
                                        if(is_dir($dir . "/" . $file)) {
                                            $inner_files = ListFilesPath($dir . "/" . $file);
                                            if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
                                        } else {
                                            array_push($files, $dir . "/" . $file);
                                        }
                                    }
                                }
                                ksort($files);                           
                                closedir($dh);                              
                                for ($index = 0; $index < count($files); $index++) {
                                    if(strpos($files[$index], "avatar.jpg") == true){
                                       unset($files[$index]);
                                   }                            
                                    for ($index = 0; $index < count($files); $index++) {
                                      $newshortfiles[$index] = basename($files[$index]);
                                   }
                                                                  
                                }
                                if(empty($newshortfiles)){
                                    return false;
                                }
                                return $newshortfiles;  
                           }
                        }        
                        
                        
                     $arraynormal = ListFilesPath('mp3');                    
                     $arrayshortpath = ListFilesShort('mp3');                  
                     $cont=0;
                     if($arraynormal == false && $arrayshortpath == false){
                         echo "Lista Vacia";
                     }else{
                        for ($index = 0; $index < count($arrayshortpath); $index++) {
                            $string = "<li><a href=user.php?song=$arraynormal[$index]>".$arrayshortpath[$index]."</a></li>";
                            $cont++;
                            if($cont == 10){
                                break;
                            }
                        echo $string;
                        
                        }
                        }?>    
                    </ul>         
                </div>
          
            </div>
        </div>

        <footer>
            <div id="contenidopie">
                <div class="infopie">
                    <p id="copy">© EIDOSDESIGN ESTUDIO · 2015 · ALL RIGHTS RESERVED</p>
                    <p id="web2">www.eidosdesign.es</p>
                </div>

            </div>          
        </footer>
        
    </body>

</html>
