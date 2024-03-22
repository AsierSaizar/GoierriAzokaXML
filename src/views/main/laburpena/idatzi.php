<?php
$env = parse_ini_file(__DIR__ . '/../../.env');
$APP_DIR = $env["APP_DIR"];
define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . $APP_DIR); //Aplikazioaren karpeta edozein lekutatik atzitzeko.
define('HREF_APP_DIR', $APP_DIR); //Aplikazioaren views karpeta edozein lekutatik deitzeko

idatziComentarioa();

function idatziComentarioa()
{

    if (isset ($_POST["izena"]) && isset ($_POST["email"]) && isset ($_POST["mezua"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $izena = $_POST["izena"];
        $email = $_POST["email"];
        $mezua = $_POST["mezua"];


        if (isset ($_POST["kurtsoa"])) {
            $kurtsoa = $_POST["kurtsoa"];
        } else {
            $kurtsoa = 1;
        }




        $xml = simplexml_load_file("../coment.xml");


        $comentarioBerria = $xml->addChild('comentarioa');
        $comentarioBerria->addChild('izena', $izena);
        $comentarioBerria->addChild('email', $email);
        $comentarioBerria->addChild('mezua', $mezua);
        $comentarioBerria->addChild('kurtsoa', $kurtsoa);
        $comentarioBerria->addChild('data', date("Y-m-d H:i:s"));

        $xml->asXML("../coment.xml");
        $location = HREF_APP_DIR . "/GarapenIngurunea/7.EntregaXML/GoierriAzokaXML/src/views/main/index.php";

        header('Location: ' . $location);
    }
}



?>