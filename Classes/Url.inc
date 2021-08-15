<?php
namespace links;

use  stdClass;

class  Url
{
    public static string $base = "../";

    /**
     * @return string
     */
    public static function getBase(): string
    {
       return self::$base;
    }

    public static function folder():object
    {
        $object = new  stdClass();
        $object->browser = self::getBase() ."browser/";
        $object->model = self::getBase() . "model/";
        $object->module = self::getBase() . "module/";
        $object->view = self::getBase() . "view/";
        $object->widgets = self::getBase() . "widgets/";
        return $object;
    }

    public function scanDir($dir)
    {
        $result = [];
        if ((is_dir($dir))) {
            $file = opendir($dir) or die("Folder can't be opened");
            while (($i = readdir($file)) !== false) {
                array_push( $result, $i);
            }
            closedir();
        }
        else {
            $result = "No such directory in your projects";
        }
        return $result;
    }

}