<?php

use dahai\Lottery;

class LotteryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * 1000次 百分百抽中测试
     */
    public function testGetPrize100()
    {
        //机率各100%
        $list = [
            [
                'id' => 1,
                'prize' => 'a',
                'odds' => 100,
            ],
            [
                'id' => 2,
                'prize' => 'b',
                'odds' => 0,
            ],
        ];

        //抽1000次
        for ($i = 0; $i < 1000; $i++) {
            $result = Lottery::rock($list);

            $this->assertEquals($result['id'], 1);
        }
    }

    /**
     * 1000次 概率测试变化范围+-2
     */
    public function testGetPrize50()
    {
        //机率各50%
        $list = [
            [
                'id' => 1,
                'prize' => 'a',
                'odds' => 50,
            ],
            [
                'id' => 2,
                'prize' => 'b',
                'odds' => 50,
            ],
        ];

        $result = Lottery::rock($list);
        codecept_debug($result);
        $this->assertTrue(in_array($result, $list));

        //抽1000次
        $total = [];
        for ($i = 0; $i < 1000; $i++) {
            $result = Lottery::rock($list);

            if (!isset($total[$result['id']])) {
                $total[$result['id']] = 1;
            } else {
                $total[$result['id']] += 1;
            }
        }
        codecept_debug($total);

        $rs = round($total[1] / 1000 * 100);
        $this->assertTrue(in_array($rs, range(48, 52)));

        $rs = round($total[2] / 1000 * 100);
        $this->assertTrue(in_array($rs, range(48, 52)));
    }
    
    /**
     * 1000次 概率测试变化范围+-2
     */
    function testGetPrizeOdds()
    {
        //机率各10% 90%
        $list = [
            [
                'id' => 1,
                'prize' => 'a',
                'odds' => 10,
            ],
            [
                'id' => 2,
                'prize' => 'b',
                'odds' => 90,
            ],
        ];

        $result = Lottery::rock($list);
        codecept_debug($result);
        $this->assertTrue(in_array($result, $list));

        //抽1000次
        $total = [];
        for ($i = 0; $i < 1000; $i++) {
            $result = Lottery::rock($list);

            if (!isset($total[$result['id']])) {
                $total[$result['id']] = 1;
            } else {
                $total[$result['id']] += 1;
            }
        }
        codecept_debug($total);

        $rs = round($total[1] / 1000 * 100);
        $this->assertTrue(in_array($rs, range(8,12)));

        $rs = round($total[2] / 1000 * 100);
        $this->assertTrue(in_array($rs, range(88,92)));
    }

    /**
     * 附带数据是否正确
     */
    function testGetPrizeData()
    {
        //机率各100%
        $list = [
            [
                'id' => 1,
                'prize' => 'a',
                'odds' => 100,
                'data' => range(1, 9),
            ],
            [
                'id' => 2,
                'prize' => 'b',
                'odds' => 0,
            ],
        ];

        $result = Lottery::rock($list);
        codecept_debug($result);
        $this->assertTrue($result['data'] == range(1, 9));
    }
}
