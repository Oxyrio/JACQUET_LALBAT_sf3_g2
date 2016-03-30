<?php

namespace AppBundle\Antispam;
/**
 * Created by PhpStorm.
 * User: aymejacquet
 * Date: 30/03/2016
 * Time: 17:04
 */
class Antispam
{
    private $antispamLength;

    public function __construct($antispamLength)
    {
        $this->antispamLength = $antispamLength;
    }

    public function isSpam($text)
    {
        return strlen($text) > $this->antispamLength;
    }
}