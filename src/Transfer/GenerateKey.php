<?php
namespace Transfer;

class GenerateKey
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function generateOne()
    {
        $resource = openssl_pkey_new($this->config['generate_key_config']);
        
        openssl_pkey_export($resource, $priKey);

        $pubKey = openssl_pkey_get_details($resource);
        $pubKey = $pubKey["key"];

        $this->savePubAndPri($pubKey, $priKey);
    }

    public function savePubAndPri($pubKey, $priKey)
    {
        $this->saveFile('id_rsa.pub', $pubKey);
        $this->saveFile('id_rsa', $priKey);
    }

    public function saveFile($fileName, $text)
    {
        $file = fopen($this->config['basePath'] . '/' . $fileName, 'w');
        fwrite($file, $text);
        fclose($file);
    }
}
