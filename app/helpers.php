<?php 

// verificar se a rota é aque está ativa ou não
function isRouteActive($name){

    return Route::currentRouteNamed($name);

} 