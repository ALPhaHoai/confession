<?php
/**
 * Created by PhpStorm.
 * User: Long
 * Date: 10/2/2018
 * Time: 2:13 PM
 */

function getLinkinText($str){//all link start with http ftp
    $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if($num_found = preg_match_all($pattern,$str , $out))
    {
//        echo "FOUND ".$num_found." LINKS:\n";
        return array_unique($out[0]);
    } else return null;
}

function getLinkinTextStartwithSpace($str){//all link start with [space]http [space]ftp
    $pattern = "/(\s+|^)(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    if($num_found = preg_match_all($pattern,$str , $out))
    {
//        echo "FOUND ".$num_found." LINKS:\n";
        return array_unique($out[0]);
    } else return null;
}

 function getTextContent($content){
    $links = getLinkinTextStartwithSpace($content);
    if(is_array($links) && count($links) > 0) {
        foreach ($links as $link){
            $trimLink = trim($link);
            $content = str_replace($link, " <a target='_blank' href='$trimLink'>$trimLink</a> ", $content);
        }
    }
    $content = str_replace("\n", "<br>", $content);
    return $content;
}


/**
 * is string $haystack starts with $needle
 */
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}