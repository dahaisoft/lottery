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

        $randId = self::randFlash($arr);

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

    static private function randFlash($oddsList)
    {
        $result = '';

        $oddsSum = array_sum($oddsList);

        $randNum = mt_rand(1, $oddsSum);
        foreach ($oddsList as $key => $value) {
            if ($randNum <= $value) {
                $result = $key;
                break;
            } else {
                $oddsSum -= $value;
                $randNum -= $value;
            }
        }
        unset ($oddsList);

        return $result;
    }

    static private function randomOrg($oddsList)
    {
        $result = '';

        $oddsSum = array_sum($oddsList);

        $apiKey = '28e61670-721e-48d5-895e-4f0de7dd51bf';
        $random = new \RandomOrg\Random($apiKey);
        $random->client->verifyPeer = false;
        $result = $random->generateIntegers(1, 1, $oddsSum, false);
        $randNum = $result['result']['random']['data'][0];

        foreach ($oddsList as $key => $value) {
            if ($randNum <= $value) {
                $result = $key;
                break;
            } else {
                $oddsSum -= $value;
                $randNum -= $value;
            }
        }
        unset ($oddsList);

        return $result;
    }
}
