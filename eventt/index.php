<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

session_start();

const INCLUDES_DIR   = __DIR__ . '/includes';
const ROUTE_DIR      = __DIR__ . '/routes';
const TEMPLATES_DIR  = __DIR__ . '/templates';

require_once INCLUDES_DIR . '/database.php';
require_once INCLUDES_DIR . '/router.php';
require_once INCLUDES_DIR . '/view.php';


/*
|--------------------------------------------------------------------------
| Normalize URI
|--------------------------------------------------------------------------
*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/index.php', '', $uri);
$uri = $uri === '' ? '/' : $uri;

/*
|--------------------------------------------------------------------------
| Dispatch ทุก route โดยไม่ตรวจ session
|--------------------------------------------------------------------------
*/
dispatch($uri, $_SERVER['REQUEST_METHOD']);