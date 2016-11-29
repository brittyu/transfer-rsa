<?php
namespace Transfer;

interface TransferInterface
{
    public function decrypt($text);

    public function encrypt($text);
}
