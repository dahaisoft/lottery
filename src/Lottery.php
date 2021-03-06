<?php

/**
 * @license MIT
 */

namespace dahai;

/**
 * 随机抽取一个奖品类
 *
 * @author Haiwei Long <haiwei.free@gmail.com>
 */

class Lottery
{
    /**
     * 获得抽中奖品结果
     *
     * @param $list[] 奖品列表
     *
     * @return array 返回奖品信息
     */

    static public function rock($list)
    {
        foreach ($list as $key => $val) {
            $list[$key]['id'] = $key + 1;
            $arr[$key + 1] = $val['odds'];
        }

        $randId = self::rand($arr);

        $res['yes'] = $list[$randId-1];

        return $res['yes'];
    }

    /**
     * 抽奖
     *
     * @param $oddsList[] 奖品列表
     * @return int 返回奖品ID
     */
    static private function rand($oddsList)
    {
        $result = '';

        $oddsSum = array_sum($oddsList);

        foreach ($oddsList as $key => $value) {
            $randNum = mt_rand(1, $oddsSum);
            if ($randNum <= $value) {
                $result = $key;
                break;
            } else {
                $oddsSum -= $value;
            }
        }
        unset ($oddsList);

        return $result;
    }
}
