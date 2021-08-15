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


const database = [
    "db" => "g-strip",
    "host" => "localhost",
    "name" => "root",
    "password" => ""
];
