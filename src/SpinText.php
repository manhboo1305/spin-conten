<?php

namespace ManhND\TextSpinner;

class SpinText
{
    public static function spin($text)
    {
        if (!preg_match('/\{(.*)\}/si', $text)) {
            return self::removeExtraSpaces($text);
        } else {
            preg_match_all('/\{([^{}]*)\}/si', $text, $matches);
            $occur = count($matches[1]);
            for ($i = 0; $i < $occur; ++$i) {
                $words = explode('|', $matches[1][$i]);
                shuffle($words);
                $text = self::replaceOnce($matches[0][$i], $words[0], $text);
            }

            return    self::spin($text);
        }
    }
    protected static function replaceOnce( $search,  $replace,  $subject)
    {
        $firstChar = strpos($subject, $search);
        if (false !== $firstChar) {
            $beforeStr = substr($subject, 0, $firstChar);
            $afterStr = substr($subject, $firstChar + strlen($search));
            return $beforeStr.$replace.$afterStr;
        } else {
            return $subject;
        }
    }

    protected static function removeExtraSpaces( $text)
    {
        return preg_replace('/\s+/', ' ', $text);
    }
    public static function formatTextSpin(array  $data, $str){
        foreach ($data as $value){
            $res  = explode('|',ltrim(rtrim($value,'}'),'{'));
            if (count($res)>0){
                foreach ($res as $re){
                    $re1 = '/(?i)'. $re .'/m';
                    preg_match_all($re1, $str, $matches, PREG_SET_ORDER, 0);
                   if (preg_match_all('~\b'.$re.'\b~',$str,$matches)>0){
                       if (count($matches)>0){
                           $str = str_replace($matches[0][0],'<span class="marker">'.$value.'</span>',$str);
                       }
                   }
                }
            }
        }
        return $str;
    }
}
