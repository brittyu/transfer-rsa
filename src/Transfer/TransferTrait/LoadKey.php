<?php
namespace Transfer\TransferTrait;

trait LoadKey
{
    private function loadKey($filePath)
    {
        if (file_exists($filePath)) {
            try {
                $key = file_get_contents($filePath);

                return $key;
            } catch (\Exception $e) {
                echo "please use sshkey generate your pub key";
            }
        }
    }

    public function loadPubKey()
    {
        if (isset($this->config['pubKeyFilePath']) && 
            $this->config['pubKeyFilePath'] != '') {
            $keyPath = $this->config['pubKeyFilePath'];
        } else {
            $keyPath = $this->config['basePath'] . '/' . 'id_rsa.pub';
        }

        $pubKey = $this->loadKey($keyPath);
        $resource = openssl_pkey_get_public($pubKey);

        return $resource;
    }

    public function loadPriKey()
    {
        if (isset($this->config['priKeyFilePath']) && 
            $this->config['priKeyFilePath'] != '') {
            $keyPath = $this->config['priKeyFilePath'];
        } else {
            $keyPath = $this->config['basePath'] . '/' . 'id_rsa';
        }

        $priKey = $this->loadKey($keyPath);
        $resource = openssl_pkey_get_private($priKey);

        return $resource;
    }
}
