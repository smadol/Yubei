<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\service;

use app\model\Asset;
use app\model\AssetCash;
use app\model\AssetChange;
use app\model\UserAccount;
use think\Db;
use think\Exception;
use think\Log;
use think\Request;

class AssetService
{
    /**
     * 获取资产变动记录
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function page(){

        $data 	= Request::instance()->get();
        $where 	= [];
        //接收时间
        if (!empty($data['time'])){
            $time = explode("/",$data['time']);
            $where['create_time'] = [ 'between', [strtotime($time['0']), strtotime($time['1'])] ];
        }
        //商户UID查询
        $where['uid']   = session('user_id');
        //封装where查询条件
        (empty($data['status']) 	|| $data['status'] == '')	|| $where['status'] 	= 	$data['status'];
        empty($data['assets_no'])|| $where['assets_no']		= 	['like','%'.$data['assets_no'] ];

        return AssetChange::where($where)->order(['id'=>'desc','create_time'=>'desc'])->paginate(10);
    }


    /**
     * 取现记录
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function cash(){
        $data 	= Request::instance()->get();
        $where 	= [];
        //接收时间
        if (!empty($data['time'])){
            $time = explode("/",$data['time']);
            $where['create_time'] = [ 'between', [strtotime($time['0']), strtotime($time['1'])] ];
        }
        //商户UID查询
        $where['uid']   = session('user_id');
        //封装where查询条件
        (empty($data['status']) 	|| $data['status'] == '')	|| $where['status'] 	= 	$data['status'];
        (empty($data['account']) 	|| $data['account'] == '')	|| $where['account'] 	= 	$data['account'];
        empty($data['assets_no'])   || $where['assets_no']		= 	['like','%'.$data['assets_no'] ];

        return AssetCash::where($where)->order('create_time desc')->paginate(10);
    }

    /**
     * 获取资金信息
     * @return Asset|null
     * @throws \think\exception\DbException
     */
    public function detail(){
        return Asset::get(['uid'=>session('user_id')]);
    }
    /**
     * 获取取现账户集合
     * @return UserAccount[]|false
     * @throws \think\exception\DbException
     */
    public function account(){
        return UserAccount::all(['uid'=>session('user_id')]);
    }

    public function addaccount($data){
        Db::startTrans();
        try{
            $account = new UserAccount();
            $account->uid = session('user_id');
            $account->bank = $data['bank'];
            $account->name = $data['name'];
            $account->remarks = $data['remarks'];
            $account->account = $data['account'];
            $account->save();
            Db::commit();
            return result(1,'添加账户成功');
        }catch (Exception $e){
            Db::rollback();
            Log::record($e->getMessage());
            return result(0,'添加账户失败');
        }

    }
    /**
     * 申请提现
     * @param $data
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function save($data){
        /**
         * 1.检查可提现余额
         * 2.扣除余额
         * 3.存入库
         * 4.完成
         */
        $asset =(new Asset())->getAsset();
        if ($asset['asset'] <= $data['amount'] || $data['amount'] <= 99){
            return result(0,'可提现余额不足，请等待系统结算！');
        }
        Db::startTrans();
        try{
            //开始扣减金额
            Asset::redAsset($data['amount']);
            //TODO  这里应该在后台处理的时候 处理完成之后再进行记录
            //处理资金扣减操作记录
            $change = new AssetChange();
            $change->uid = session('user_id');
            $change->assets_no = date('YmdHis').mt_rand(1000,9999);
            $change->preinc = $asset['asset'];
            $change->increase = '';
            $change->reduce = $data['amount'];
            $change->suffixred = $asset['asset']-$data['amount'];
            $change->remarks = $data['remarks'];
            $change->save();
            //写入提现数据表
            $cash = new AssetCash();
            $cash->uid = session('user_id');
            $cash->assets_no = date('YmdHis').mt_rand(1000,9999);
            $cash->amount = $data['amount'];
            $cash->account = $data['bank'] ;//获取对应的提现账户
            $cash->remarks = $data['remarks'];
            $cash->save();
            Db::commit();
            return result(1,'提现申请成功，请等待收款...');
        }catch (Exception $e){
            Db::rollback();
            Log::record($e->getMessage());
            return result(0,'提现申请失败，请稍后重试...');
        }
    }
}