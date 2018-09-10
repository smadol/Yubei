<?php
/**
 * +---------------------------------------------------------------------+
 * | Yubei      | [ WE CAN DO IT JUST THINK ]
 * +---------------------------------------------------------------------+
 * | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 * +---------------------------------------------------------------------+
 * | Author     | Brian Waring <BrianWaring98@gmail.com>
 * +---------------------------------------------------------------------+
 * | Company    | 小红帽科技      <Iredcap. Inc.>
 * +---------------------------------------------------------------------+
 * | Repository | https://github.com/BrianWaring/Yubei
 * +---------------------------------------------------------------------+
 */

namespace app\model;


class Balance extends BaseModel
{

    /**
     * 自增金额
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param int $uid 商户ID
     * @param integer $amount
     * @param bool $field
     * @return int|true
     * @throws \think\Exception
     *
     */
    public function incBalance($uid,$amount,$field = false){

       return self::where(['uid'=>$uid])->setInc($field ? 'available':'disable',$amount);
    }

}