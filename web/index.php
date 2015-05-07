<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */
require_once '../vendor/autoload.php';

use Hj\Application;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app = new Application();

$app->handle($request)->send();
 