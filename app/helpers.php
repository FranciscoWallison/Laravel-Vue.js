<?php

function isRouteActive($name)
{
	return  Route::currentRouteName($name);
}