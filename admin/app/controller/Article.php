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

namespace app\controller;

/**
 * 文章控制器
 */
class Article extends Base
{

    /**
     * 文章列表
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function index()
    {

        $where = [];

        !empty($this->request->param('keywords')) && $where['title|describe']
            = ['like', '%'.$this->request->param('keywords').'%'];
        
        $this->assign('list', $this->logicArticle->getArticleList($where));
        
        return $this->fetch();
    }

    /**
     * 文章添加
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function add()
    {
        
        $this->articleCommon();
        
        return $this->fetch();
    }

    /**
     * 文章编辑
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     * @return mixed
     */
    public function edit()
    {
        
        $this->articleCommon();
        
        $article = $this->logicArticle->getArticleInfo(['id' => $this->request->param('id')]);

        !empty($article) && $article['img_ids_array'] = str2arr($article['img_ids']);
        
        $this->assign('article', $article);
        
        return $this->fetch();
    }

    /**
     * 文章添加与编辑通用方法
     *
     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>
     *
     */
    public function articleCommon()
    {
        $this->request->isPost() && $this->result($this->logicArticle->editArticle($this->request->param()));
    }

    /**
     * 数据状态设置
     */
    public function changeStatus()
    {
        $this->result($this->logicArticle->setStatus('Article', $this->request->param()));
    }
}
