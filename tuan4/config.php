<?php
const DEV = true;
const _NGOC = true;

// declare database config
const _HOST = "localhost";
const _PORT = "3306";
const _DB = "my_sql";
const _USER = "root";
const _PASS = "";
const _DRIVER = "mysql";

// error debug
const _DEBUG = true;

// host setup
const _DEV_HOST_URL = "https://laughing-succotash-69w664w66v7q3r7r-80.app.github.dev/manager_coursee";
const BASE_DIR = '/manager_coursee';

define("_HOST_URL", DEV ? _DEV_HOST_URL : "http://".$_SERVER["HTTP_HOST"]."/manager_coursee");
define("_HOST_URL_PUBLIC", _HOST_URL."/public");
define("_HOST_URL_VIEWS", _HOST_URL."/src/Views");

// path setup
define('_PROJECT_ROOT', dirname(__DIR__));
define('_PATH_URL_SRC', _PROJECT_ROOT.'/src');
define('_PATH_URL_CONTROLLERS', _PROJECT_ROOT.'/src/Controllers');
define('_PATH_URL_CORE', _PROJECT_ROOT.'/src/Core');
define('_PATH_URL_VIEWS', _PROJECT_ROOT.'/src/Views');
