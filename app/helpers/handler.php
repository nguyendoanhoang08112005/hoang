<?php
Use eftec\bladeone\BladeOne;
function view($pathView,$data=[]){
    $views = __DIR__ . '/../Views';
    $cache = __DIR__ . '/../cache';
    $blade=new BladeOne($views,$cache,BladeOne::MODE_AUTO);
    return $blade->run($pathView,$data);
}
// ham debug
function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}
//chuyen huong webiste
function redirect($path){
    $path=APP_URL.$path;
    header("Location: $path");
    die;
}