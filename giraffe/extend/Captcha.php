<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:
    |-----------------------------------------------------------------------------------
*/
namespace giraffe\extend;
class Captcha
{
    private $fontfile;
    private $fontsize = 30;
    private $imgwidth = 120;
    private $imgheight = 50;
    private $length = 4;
    private $snow = 0;
    private $pixel = 100;
    private $line = 5;
    private $arc = 3;
    private $image;

    public function __construct($config = array())
    {
        if (is_array($config)&&count($config)>0) {
            if (isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])) {
                $this->fontfile = $config['fontfile'];
            }else{
                return false;
            }
            if (isset($config['imgwidth'])&&$config['imgwidth']>0) {
                $this->imgwidth = intval($config['imgwidth']);
            }
            if (isset($config['imgheight'])&&$config['imgheight']>0) {
                $this->imgheight = intval($config['imgheight']);
            }
            if (isset($config['fontsize'])&&$config['fontsize']>0) {
                $this->fontsize = intval($config['fontsize']);
            }
            if (isset($config['length'])&&$config['length']>0) {
                $this->length = intval($config['length']);
            }
            if (isset($config['snow'])&&$config['snow']>0) {
                $this->snow = intval($config['snow']);
            }
            if (isset($config['pixel'])&&$config['pixel']>0) {
                $this->pixel = intval($config['pixel']);
            }
            if (isset($config['line'])&&$config['line']>0) {
                $this->line = intval($config['line']);
            }
            if (isset($config['arc'])&&$config['arc']>0) {
                $this->arc = intval($config['arc']);
            }
            $this->image = imagecreatetruecolor($this->imgwidth, $this->imgheight);
            return $this->image;
        }else{
            return false;
        }
    }
    public function getCaptcha()
    {
        $white = imagecolorallocate($this->image, 255, 255, 255);
        imagefilledrectangle($this->image, 0, 0, $this->imgwidth, $this->imgheight, $white);
        $str = $this->generateStr();
        if ($str === false) {
            return false;
        }
        $fontfile = $this->fontfile;

        for ($i=0; $i < $this->length; $i++) {
            $size = mt_rand($this->fontsize-10,$this->fontsize);
            $angle = mt_rand(-30,30);
            $x = ceil($this->imgwidth/$this->length)*$i+mt_rand(5,10);
            $y = ceil($this->imgheight/1.5);
            $color = $this->getRandColor();
            $text = substr($str,$i,1);
            imagettftext($this->image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }
        //exit();
        if ($this->snow) {
            $this->setSnow();
        }
        if ($this->pixel) {
            $this->setPixel();
        }
        if ($this->line) {
            $this->setLine();
        }
        if ($this->arc) {
            $this->setArc();
        }
        header("content-type:image/png");
        imagepng($this->image);
        imagedestroy($this->image);
        return strtolower($str);
    }
    private function generateStr()
    {
        if ($this->length<1 || $this->length>30) {
            return false;
        }
        $str = implode('',array_rand(array_flip(array_merge(range(0, 9),range('a', 'z'),range('A', 'Z'))),$this->length));
        return $str;
    }
    private function getRandColor()
    {
        return imagecolorallocate($this->image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
    }
    private function setSnow()
    {
        for ($i=0; $i <= $this->snow; $i++) {
            imagestring($this->image, 1, mt_rand(0,$this->imgwidth), mt_rand(0,$this->imgheight), '*', $this->getRandColor());
        }
    }
    private function setPixel()
    {
        for ($i=0; $i < $this->pixel; $i++) {
            imagesetpixel($this->image, mt_rand(0,$this->imgwidth), mt_rand(0,$this->imgheight),$this->getRandColor());
        }
    }
    private function setLine()
    {
        for ($i=0; $i < $this->line; $i++) {
            imageline($this->image, mt_rand(0,$this->imgwidth), mt_rand(0,$this->imgheight), mt_rand(0,$this->imgwidth), mt_rand(0,$this->imgheight), $this->getRandColor());
        }
    }
    private function setArc()
    {
        for ($l=1; $l <= $this->arc; $l++) {
            imagearc($this->image, mt_rand(0,$this->imgwidth/2),  mt_rand(0,$this->imgheight/2), mt_rand(0,$this->imgwidth/4),  mt_rand(0,$this->imgheight/4), mt_rand(0,360), mt_rand(0,360), $this->getRandColor());
        }
    }
}