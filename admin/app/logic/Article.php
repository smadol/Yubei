<?php
/**
 *  +---------------------------------------------------------------------+
 *  | Yubei      | [ WE CAN DO IT JUST THINK ]
 *  +---------------------------------------------------------------------+
 *  | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )
 *  +---------------------------------------------------------------------+
 *  | Author     | Brian Waring <BrianWaring98@gmail.com>
 *  +---------------------------------------------------------------------+
 *  | Company    | 小红帽科技      <Iredcap. Inc.>
 *  +---------------------------------------------------------------------+
 *  | Repository | https://github.com/BrianWaring/Yubei
 *  +---------------------------------------------------------------------+
 */

namespace app\logic;
use think\Db;
use think\Log;


class Article extends BaseLogic
{
    /**
     * 获取文章列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $where
     * @param bool $field
     * @param string $order
     * @return mixed
     */
    public function getArticleList($where = [], $field = true, $order = '')
    {
        return $this->modelArticle->getList($where, $field, $order);
    }

    /**
     * 获取文章信息
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $where
     * @param bool $field
     * @return mixed
     */
    public function getArticleInfo($where = [], $field = true)
    {
        
        return $this->modelArticle->getInfo($where, $field);
    }

    /**
     * 文章信息编辑
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $data
     * @return array|string
     */
    public function editArticle($data = [])
    {

        $validate = $this->validateArticle->scene('edit')->check($data);

        if (!$validate) {

            return $this->validateArticle->getError();
        }

        Db::startTrans();
        try{
            $this->modelArticle->setInfo($data);
            Db::commit();
            return [1,'文章编辑成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }

    }

    /**
     * 文章删除
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param array $where
     * @return array|string
     */
    public function delArticle($where = [])
    {
        Db::startTrans();
        try{
            $this->modelArticle->deleteInfo($where);
            Db::commit();
            return [1,'文章删除成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }

    /**
     * 改变文章状态
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @param string $id 文章ID
     * @param int $value 状态值
     * @return array|string
     */
    public function setChannelStatus($id,$value = 0){
        Db::startTrans();
        try{
            $this->modelArticle->setFieldValue(['id'=>$id], $field = 'status', $value);
            Db::commit();
            return [1,'修改成功'];
        }catch (\Exception $ex){
            Db::rollback();
            Log::error($ex->getMessage());
            return [0,'未知错误'];
        }
    }
}
