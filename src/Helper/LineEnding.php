<?php

namespace Pulli\Mime\Helper;

/*
 * @author PuLLi <the@pulli.dev>
 *
 * Inspired by PHPMailer
 */
trait LineEnding
{
    public function normalize(string $text): string
    {
        $breakType = "\r\n";
        //Normalize to \n
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        //Now convert LE as needed
        return str_replace("\n", $breakType, $text);
    }
}
