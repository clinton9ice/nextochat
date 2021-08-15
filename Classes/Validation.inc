<?php

namespace application\validation;

use stdClass;

class Validation{

    public static function sanitize($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function fullname($str){
        if(preg_match("/^[A-Za-z]{3,20} [A-Za-z]{3,20}+$/",$str)){
            return false;
        }
        return true;
    }

    public static function name($str){
        if(preg_match("/^[A-Za-z]{3,20}+$/",$str)){
            return false;
        }
        return true;
    }

    public static function username($str){
        if(preg_match("/^[A-Za-z0-9]{3,20}+$/",$str)){
            return false;
        }
        return true;
    }

    public static function city($str): bool{
        if(preg_match("/^[A-Za-z\-, ]{2,60}+$/",$str)){
            return false;
        }
        return true;
    }


    public static function email($str): bool{
        $str = filter_var($str, FILTER_SANITIZE_EMAIL);
        if(!filter_var($str,FILTER_VALIDATE_EMAIL)===false){
            return false;
        }
        return true;
    }

    public static function email_domain($email): bool{
        $exp = "/^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/i";
        if(preg_match($exp,$email)){
            $var = explode("@",$email);
            $domain = array_pop($var);
            return checkdnsrr($domain,"MX");
        }
        return false;
    }

    public static function emails($emails, $delimeter=','): bool{
        $res = false;
        $emailArr = explode($delimeter,$emails);
        foreach ($emailArr as $item){
            if(self::email($item)){
                $res = true;
                break;
            }
        }
        return $res;
    }

    public static function password($str): bool{
        if(strlen($str)>=6 and strlen($str)<=50){
            if(preg_match("#^[ -~£±§]*$#",$str) === 1){
                return false;
            }
        }
        return true;
    }

    public static function LoginId($str): bool{
        if(preg_match("/^[0-9]{1,10}+$/",$str)){
            return true;
        }
        return false;
    }

    public static function LoginHash($hash){
        if(preg_match("/^[a-z0-9\-\_]{15,22}+$/",$hash)){
            return true;
        }
        return false;
    }


    public static function text($text,int $min=3, $max=null,bool $optional=false):bool{

        if($optional and empty($text)){
            return true;
        }

        $length = (is_null($max))? (strlen($text)>=$min) : (strlen($text)>=$min and strlen($text)<=$max);
        if($length){
            if(preg_match("#^[ -~£±§\"'‘’“”\r\n]*$#",$text)){
                return true;
            }
        }
        return false;
    }

    public static function words($text,int $min=3, $max=null,bool $optional=false):bool{

        if($optional and empty($text)){
            return true;
        }

        $wordArr = explode(" ",$text);
        $wordArr = array_filter($wordArr,function($word){ return !(is_null($word) OR !self::text($word,1)); });
        $wordLength = count($wordArr);

        return (is_null($max))? ($wordLength>=$min) : ($wordLength>=$min and $wordLength<=$max);

    }

    public static function number($num,int $min=0, $max=null,bool $optional=false){
        if($optional and empty($num)){
            return true;
        }
        $num = intval($num);
        if(is_int($num)){
            return (is_null($max))?
                ($num>=$min) :
                ($num>=$min && $num<=$max);
        }
        return false;
    }

    public static function numberOnly($num,int $min=0, $max=null,bool $optional=false){
        if($optional and empty($num)){
            return true;
        }
        if(is_int($num)){
            return (is_null($max))?
                ($num>=$min) :
                ($num>=$min && $num<=$max);
        }
        return false;
    }

    public static function longnumber($num,int $min = 0, $max=null,bool $optional=false){
        if($optional and empty($num)){
            return true;
        }

        if(is_float($num)){
            return (is_null($max))? ($num>=$min) : ($num>=$min && $num<=$max);
        }
        return false;
    }

    public static function check_valid_url($url){

        $c=curl_init();
        curl_setopt($c,CURLOPT_URL,$url);
        curl_setopt($c,CURLOPT_HEADER,1);//get the header
        curl_setopt($c,CURLOPT_NOBODY,1);//and *only* get the header
        curl_setopt($c,CURLOPT_RETURNTRANSFER,1);//get the response as a string from curl_exec(), rather than echoing it
        curl_setopt($c,CURLOPT_FRESH_CONNECT,1);//don't use a cached version of the url
        if(!curl_exec($c)){
            return false;
        }else{
            return true;
        }
        //$httpcode=curl_getinfo($c,CURLINFO_HTTP_CODE);
        //return ($httpcode<400);
    }

    public static function url($url){
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
            return true;
        }
        return false;
    }

    public static function ValidateFile($attach,$mimef = ["image/jpg", "image/jpeg", "image/png", "application/zip"],$maxsize=10000000):stdClass{
        $result = new stdClass();
        $result->status = false;
        $result->error = false;
        $result->size = true;
        $result->format = true;
        $attachName = ((isset($attach['name']))?$attach['name']:null);
        $attachType = ((isset($attach['type']))?$attach['type']:null);
        $attachSize = ((isset($attach['size']))?$attach['size']:null);
        $attachError = ((isset($attach['error']))?$attach['error']:null);
        $attachTemp = ((isset($attach['tmp_name']))?$attach['tmp_name']:null);

        if($attachError == 0) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $attachTemp);
            if(in_array($mime,$mimef) and in_array($attachType,$mimef)){
                if(($attachSize<=$maxsize) or $maxsize==null){
                    $result->status = true;
                }else{
                    $result->size = false;
                }
            }else{
                $result->format = false;
            }
        }else{
            $result->error = true;
            switch ($attachError){
                default:
                    $result->info = "file is not valid";
            }
        }
        return $result;
    }

    public static function ValidateFileFormat($fileurl,$mimef = ["image/jpg", "image/jpeg", "image/png", "application/zip"],$maxsize=10000000){
        $result = false;
        if(Url::fileExist($fileurl)){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $fileurl);
            if(in_array($mime,$mimef)){
                if((filesize($fileurl)<=$maxsize)){
                    $result = true;
                }
            }
        }
        return $result;
    }

    public static function sanitizeObject(&$data){
        if(!is_null($data)) {
            array_walk($data, function (&$index) {
                $index = self::removeUnwanted($index);
            });
        }
    }

    private static function removeUnwanted($value){
        $chars = [
            // control characters
            chr(0), chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), chr(9), chr(10),
            chr(11), chr(12), chr(13), chr(14), chr(15), chr(16), chr(17), chr(18), chr(19), chr(20),
            chr(21), chr(22), chr(23), chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30),
            chr(31),
            // non-printing characters
            chr(127)];
        $value = preg_replace("’","&#8216;",$value);
        $value = str_replace("`","&#96;",$value);
        $value = str_replace("’","&#8217;",$value);
        $value = str_replace("‘","&#8216;",$value);
        $value = str_replace("“","&#8220",$value);
        $value = str_replace("”","&#8221",$value);
        $value = str_replace("~","&#126;",$value);
        $value = str_replace("—","&#8212;",$value);
        $value = str_replace($chars,"",$value);
        return $value;
    }

    public static function convertToHtmlEntities($value){
        $chars = [
            // control characters
            chr(0), chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), chr(9), chr(10),
            chr(11), chr(12), chr(13), chr(14), chr(15), chr(16), chr(17), chr(18), chr(19), chr(20),
            chr(21), chr(22), chr(23), chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30),
            chr(31),
            // non-printing characters
            chr(127)];
        $value = preg_replace("’","&#8216;",$value);
        $value = str_replace("`","&#96;",$value);
        $value = str_replace("’","&#8217;",$value);
        $value = str_replace("‘","&#8216;",$value);
        $value = str_replace("“","&#8220",$value);
        $value = str_replace("”","&#8221",$value);
        $value = str_replace("~","&#126;",$value);
        $value = str_replace("—","&#8212;",$value);
        $value = str_replace("™","&#8482;",$value);
        $value = str_replace($chars,"",$value);
        return $value;
    }

    private static function mb_str_replace($needle, $replacement, $haystack) {
        return implode($replacement, mb_split($needle, $haystack));
    }


    public static function filterNormalText($text,$format="/[^A-Za-z0-9 ]/"){
        $text = preg_replace("/&quot;/","",$text);
        return preg_replace($format,"",$text);
    }

    public static function filterFromHtmlText($text,$format="/[^A-Za-z0-9 ]/"){
        $text = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $text = preg_replace("/&quot;/","",$text);
        $text = preg_replace($format,"",$text);
        return preg_replace("/nbsp/","",$text);
    }

    public static function pickWords($text,$to=10,$from=0,$glue=" "){
        $wordArr = explode(" ",$text);
        $wordArr = array_slice($wordArr,$from,$to);
        array_walk($wordArr, function (&$item){
            $item = trim($item);
            $item = str_replace([",","(",")","”","“"],"",$item);
            $item = (empty($item))? null : $item;
        });
        $wordArr = array_filter($wordArr);
        $text = implode($glue,$wordArr);
        return $text;
    }

    public static function sanitizeFilename($filename){
        $filename = self::filterNormalText($filename,"/[^A-Za-z0-9. ]/");
        $filename = str_replace(" ","_",$filename);
        return $filename;
    }

    public static function addHtmlBreaks(&$text, $openTag="<p>", $closeTag="</p>", $singleTag ="<br/>"){
        $paragraphs = explode("\n",$text);
        if(count($paragraphs)){
            $result = "";
            foreach ($paragraphs as $paragraph){
                $paragraph = trim($paragraph);
                if(self::text($paragraph,1)){
                    $result .= $openTag.$paragraph.$closeTag;
                }else{
                    $result .= $singleTag;
                }
            }
            $text = $result;
        }
    }

    public static function removeHtmlBreaks(&$text, $openTag="<p>", $closeTag="</p>", $singleTag ="<br/>"){
        $text = str_replace($openTag,"", $text);
        $text = str_replace($singleTag,"\n", $text);
        $text = str_replace($closeTag,"\n", $text);
    }

}