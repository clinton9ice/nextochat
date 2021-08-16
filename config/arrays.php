<?php
session_start();


//Define directory
$dir =  str_replace("\\","/", __DIR__);

define("root", pathinfo($dir, 1));

//Define stylesheets
const stylesheets = [
    array("url" => "browser/css/main.css")
];


//Define a script
const script = [
    array("url" => "browser/vendor/jquery-3.3.1.min.js")
];


//Bottom Script
const bottom_js = [
    array("url" => "browser/js/main.js")
];

//Define database configuration
const settings = [
    "version" => "1.0",
    "admin" => "Clinton",
    "password" => "",
];


//Define Meta tags
const meta = [
    array("charset" => "UTF-8"),
    array("http-equiv" => "X-UA-Compatible", "content" => "IE=edge,chrome=1"),
    array("name" => "author", "content" => settings["admin"]),
    array("name" => "viewport", "content" => "width=device-width, initial-scale=1.0")
];


// const database = [
//     "db" => "heroku_c19be1cbb8368d8",
//     "host" => "us-cdbr-east-04.cleardb.com",
//     "name" => "root",
//     "password" => ""
// ];

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

define("database", [
    "db" => $cleardb_server,
    "host" => $cleardb_db,
    "name" => $cleardb_username,
    "password" => $cleardb_password
]);