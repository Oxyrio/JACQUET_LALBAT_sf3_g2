<?php

namespace AppBundl\Antispam;
/**
 * Created by PhpStorm.
 * User: aymejacquet
 * Date: 30/03/2016
 * Time: 17:04
 */
class Antispam
{
    public function isSpam($text)
    {
        return strlen($text) > 50;
    }
}