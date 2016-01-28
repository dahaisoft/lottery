# 跟据设置的概率随机抽取一个奖品类

```
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
```
