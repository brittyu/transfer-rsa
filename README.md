## transfer-rsa

相关的使用可以查看test下的用例


```bash
git clone https://github.com/brittyu/transfer-rsa.git
cd transfer-rsa/test

```

执行test下面的脚本进行测试

### 直接使用composer 安装

```bash
composer require "brittyu/transfer-rsa:dev-master"
```

### 写到compser.json文件中

```bash
{
    "require": {
        "brittyu/transfer": "dev-master"
    }
}
```

### 使用

run.php 文件编写

``` bash
<?php
require_once "vendor/autoload.php";

use Transfer\Client;
use Transfer\Server;

$config = require_once '/config.php';

$client = new Client($config);
$server = new Server($config);

// 客户端加密，服务端解密
$secret = $client->encrypt('ceshi');
echo $server->decrypt($secret);

echo "\n";

// 服务端加密，客户端解密
$secret = $server->encrypt('ceshi');
echo $client->decrypt($secret);

```

config.nhp 文件编写

```bash
<?php
return [
    // string which would be encrypted can has a pre
    'pre' => '',

    // string contrain a timestamp which can check the signature out of date of not
    'alive' => 60,

    'sign' => 'spider',

    // .ssh pub key file path
    'pubKeyFilePath' => '',

    // .ssh pri key file path
    'priKeyFilePath' => '',

    // generate key config
    'generate_key_config' => [
        'private_key_bits' => 1024
    ],

    'basePath' => __DIR__
];
```

也可以通过该脚本生成公钥和私钥

```bash
require_once "vendor/autoload.php";

use Transfer\GenerateKey;

$config = require_once '/config.php';

$generateClass = new GenerateKey($config);
$generateClass->generateOne();
```

生成的钥匙放在当前的目录下，**id_rsa** 和 **id_rsa.pub** 文件中

### 更多

[My blog](http://brittyu.xyz)

### License

MIT
