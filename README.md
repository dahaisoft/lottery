# 一个抽奖类

跟据设置的概率随机抽取，概率偏差在+-2之间，偶尔之上

## 安装

```bash
$ composer require dahaisoft/lottery
```

## 使用

```php
<?php

use dahai\Lottery;

$list = [
    [
        'prize'=>'奖品名1', //奖品名
        'odds'=> 50, //概率
        'data' => [] //数据
    ],
    [
        'prize'=>'奖品名2',
        'odds'=> 50,
        'data' => []
    ],
];
$prize = Lottery::rock($list);

?>
```
