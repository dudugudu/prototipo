<?php
/**
 * Arquivo de configuração do sistema.
 */



$separador = DIRECTORY_SEPARATOR;
$root = dirname((__FILE__).$separador);

/**
 * Define o caminho raiz do projeto
 * 
 */
define('ROOT', $root . $separador);


/**
 * Define o caminho para a pasta de classes do sistema
 * 
 */
define('SRC', ROOT. 'src' . $separador);


define('ROOT_URL', '/prototipo/'); // Se o site estiver em um subdiretório, inclua-o aqui
define('IMG_URL', '/prototipo/assets/'); // Se o site estiver em um subdiretório, inclua-o aqui
define('VIEWS_URL', '/prototipo/src/views/'); // Se o site estiver em um subdiretório, inclua-o aqui
define('CONTROLLERS_URL', '/prototipo/src/controllers/'); // Se o site estiver em um subdiretório, inclua-o aqui



?>