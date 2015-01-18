<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Transformer;

/**
 * Class StringTransformer
 * @package Hj\Transformer
 */
class StringTransformer
{
    /**
     * @param string $str
     * @param bool $uppercaseFirst
     * @param array $exclude
     *
     * @return string
     */
    public static function camelCase($str, $uppercaseFirst = false, $exclude = array())
    {
        $str = self::replaceAccents($str);

        $str = preg_replace(
            '/[^a-z0-9' . implode("", $exclude) . ']+/i',
            ' ',
            $str
        );

        $str = ucwords(trim($str));

        $str = lcfirst(str_replace(" ", "", $str));

        if (true === $uppercaseFirst) {
            $str = ucfirst($str);
        }

        return $str;
    }

    /**
     * @param string $str
     *
     * @return string $str
     */
    private static function replaceAccents($str)
    {
        $search = explode(
            ",",
            "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ"
        );

        $replace = explode(
            ",",
            "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE"
        );

        return str_replace($search, $replace, $str);
    }
}