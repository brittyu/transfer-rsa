<?php
namespace Transfer\TransferTrait;

trait Validate
{
    public function validateForm($text)
    {
        list($sign, $time, $category) = explode('=', $text);

        if ($this->checkTime($time) == false ||
            $this->checkSign($sign) == false) {
            return '';
        }

        return $category;
    }

    public function checkTime($time)
    {
        $diffTime = $_SERVER['REQUEST_TIME'] - $time;

        if ($diffTime > $this->config['alive']) {
            return false;
        }

        return true;
    }

    public function checkSign($sign)
    {
        if ($this->config['sign'] != $sign) {
            return false;
        }

        return true;
    }
}
