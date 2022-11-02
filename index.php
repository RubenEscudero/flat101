<?

function __autoload($class) {
    require_once str_replace('_', '/', $class) . '.php';
}

$originalPaths = explode(DIRECTORY_SEPARATOR, get_include_path());
$include = array(
    './library'
);

set_include_path(implode(DIRECTORY_SEPARATOR, array_merge($originalPaths, $include)));

// Bootstrap
$app = new Test_Application();
$app->run();