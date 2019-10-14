<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
spl_autoload_register(function($class) {
    getController("./", $class);
});

function getController($dir, $class){
    if ($diretorio = opendir($dir))
    {
        while(false !== ($pasta = readdir($diretorio)))
        {
            if(is_dir($dir.$pasta) and ($pasta != ".") and ($pasta != ".."))
            {
                if (file_exists($dir.$pasta."/$class.php")) {
                    require_once $dir.$pasta."/$class.php";
                    return true;
                }else{
                    getController($dir.$pasta."/", $class);
                }
            }
        }
        closedir($diretorio);
    }
}

if (!$_GET) {
    $_GET['controller'] = 'ConsultaImovelController';
    $_GET['method'] = 'index';
}
$type = isset($_GET['type']) ? $_GET['type'] : null;
if($type == null){
    ?>
    <html>
    <head>
        <script src="js/jquery-1.9.0.js" type="text/javascript"></script>
        <script src="semantic/semantic.js" type="text/javascript"></script>
        <link href="semantic/semantic.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="ui container">
        <div class="ui content">
            <div class="ui inverted menu">
                <div class="header item">Desafio</div>
                <a class="item" href="?controller=ConsultaImovelController&method=index">Consultar Imóveis</a>
                <a class="item" id="menucidade" href="?controller=CidadeController&method=listar">Cidades</a>
                <a class="item" id="menubairro" href="?controller=BairroController&method=listar">Bairros</a>

            </div>
            <?php
            $status = isset($_GET['status']) ? $_GET['status'] : null;
            $mess = isset($_GET['mess']) ? $_GET['mess'] : null;
            ?>
            <?php if($status && $mess){ ?>
                <div class="ui ignored <?php echo $status ?> message">
                    <?php echo $mess ?>
                </div>
            <?php } ?>
            <?php content() ?>
        </div>
    </div>
    </body>
    </html>
<?php }else{  ?>
    <?php content() ?>
<?php }  ?>

<?php
function content(){
    if ($_GET) {
        $controller = isset($_GET['controller']) ? ((class_exists($_GET['controller'])) ? new $_GET['controller'] : NULL ) : null;
        $method     = isset($_GET['method']) ? $_GET['method'] : null;
        if ($controller && $method) {
            if (method_exists($controller, $method)) {
                $parameters = $_GET;
                unset($parameters['controller']);
                unset($parameters['method']);
                call_user_func(array($controller, $method), $parameters);
            } else {
                echo "Método não encontrado!";
            }
        } else {
            echo "Controller não encontrado!";
        }
    }
}
?>
