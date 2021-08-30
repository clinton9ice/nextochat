<?php
session_start();


//Define directory
$dir =  str_replace("\\","/", __DIR__);

define("root", pathinfo($dir, 1));

//Define stylesheets
const stylesheets = [
    array("url" => "browser/vendor/css/display.css"),
    array("url" => "browser/vendor/remix/fonts/remixicon.css"),
    array("url" => "browser/css/style.css"),
    array("url" => "browser/vendor/css/bootstrap.css"),
    array("url" => "browser/vendor/css/fonts.css"),
    array("url" => "browser/vendor/emojionearea/dist/emojionearea.css"),
];


//Define a script
const script = [
    array("url" => "browser/vendor/jquery-3.3.1.min.js"),
    array("url" => "browser/js/app-v2.js"),
    array("url" => "browser/vendor/emojionearea/dist/emojionearea.js")
];


//Bottom Script
const bottom_js = [
    array("url" => "browser/js/main.js"),
    array("url" => "browser/vendor/node_modules/sweetalert/dist/sweetalert.min.js"),
//    array("url" => "browser/vendor/node_modules/bootstrap/dist/js/bootstrap.js")
];

//Define database configuration
const settings = [
    "VERSION" => "1.0",
    "ADMIN" => "Clinton",
    "PASSWORD" => "",
    "SITE_STATUS"=> 200
];


//Define Meta tags
const meta = [
    array("charset" => "UTF-8"),
    array("http-equiv" => "X-UA-Compatible", "content" => "IE=edge,chrome=1"),
    array("name" => "author", "content" => settings["ADMIN"]),
    array("name" => "app-version", "content" => settings["VERSION"]),
    array("name" => "viewport", "content" => "width=device-width, initial-scale=1.0")
];


// const database = [
//     "db" => "heroku_c19be1cbb8368d8",
//     "host" => "us-cdbr-east-04.cleardb.com",
//     "name" => "root",
//     "password" => ""
// ];


const database = [
    "db" => "sql4431286",
    "hostname" => "sql4.freemysqlhosting.net",
    "name" => "sql4431286",
    "password" => "wvsHK65t8S",
    "port"=> 3306
];
//