<?php
/**
 * Author: 勇敢的小笨羊
 * Github: https://github.com/SingleSheep
 */

namespace app\model;

use think\Db;
use think\Model;

class BaseModel extends Model
{
    // 是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型
    protected $autoWriteTimestamp = true;
    // 创建时间字段
    protected $createTime = 'create_time';
    // 更新时间字段
    protected $updateTime = 'update_time';

    /**
     * 连接查询
     */
    protected $join = [];

    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {

        $status = [-1 => '删除', -0 => "<span class='badge bg-red'>禁用</span>", 1 => "<span class='badge bg-green'>启用</span>"];

        return $status[$this->data['status']];
    }

    /**
     * 设置数据
     */
    final protected function setInfo($data = [], $where = [])
    {

        $pk = $this->getPk();

        if (empty($data[$pk])) {

            $this->allowField(true)->save($data, $where);

            return $this->getQuery()->getLastInsID();

        } else {

            is_object($data) && $data = $data->toArray();

            !empty($data['create_time']) && is_string($data['create_time']) && $data['create_time'] = strtotime($data['create_time']);

            $default_where[$pk] = $data[$pk];

            return $this->updateInfo(array_merge($default_where, $where), $data);
        }
    }

    /**
     * 更新数据
     */
    final protected function updateInfo($where = [], $data = [])
    {

        $data['update_time'] = time();

        return $this->allowField(true)->save($data, $where);
    }

    /**
     * 统计数据
     */
    final protected function stat($where = [], $stat_type = 'count', $field = 'id')
    {

        return $this->where($where)->$stat_type($field);
    }

    /**
     * 设置数据列表
     */
    final protected function setList($data_list = [], $replace = false)
    {

        $return_data = $this->saveAll($data_list, $replace);

        return $return_data;
    }

    /**
     * 设置某个字段值
     */
    final protected function setFieldValue($where = [], $field = '', $value = '')
    {

        return $this->updateInfo($where, [$field => $value]);
    }

    /**
     * 删除数据
     */
    final protected function deleteInfo($where = [], $is_true = false)
    {

        if ($is_true) {

            $return_data = $this->where($where)->delete();

        } else {

            $return_data = $this->setFieldValue($where, 'status', -1);
        }

        return $return_data;
    }

    /**
     * 获取某个列的数组
     */
    final protected function getColumn($where = [], $field = '', $key = '')
    {

        return Db::name($this->name)->where($where)->column($field, $key);
    }

    /**
     * 获取某个字段的值
     */
    final protected function getValue($where = [], $field = '', $default = null, $force = false)
    {

        return Db::name($this->name)->where($where)->value($field, $default, $force);
    }

    /**
     * 获取单条数据
     */
    final protected function getInfo($where = [], $field = true)
    {

        $query = !empty($this->join) ? $this->join($this->join) : $this;

        $info = $query->where($where)->field($field)->find();

        $this->join = [];

        return $info;
    }

    /**
     * 获取列表数据
     * 若不需要分页 $paginate 设置为 false
     */
    final protected function getList($where = [], $field = true, $order = '', $paginate = 0)
    {

        empty($this->join) && !isset($where['status']) && $where['status'] = ['neq', -1];

        if (empty($this->join)) {

            !isset($where['status']) && $where['status'] = ['neq', -1];

            $query = $this;

        } else {

            $query = $this->join($this->join);
        }

        $query = $query->where($where)->order($order)->field($field);

        !empty($this->limit) && $query->limit($this->limit);
        !empty($this->group) && $query->group($this->group);

        if (false === $paginate) {

            $list = $query->select();

        } else {

            $list_rows = empty($paginate) ? 15 : $paginate;

            $list = $query->paginate(input('list_rows', $list_rows), false, ['query' => request()->param()]);
        }

        $this->join = []; $this->limit = []; $this->group = [];

        return $list;
    }

    /**
     * 原生查询
     */
    final protected function query($sql = '')
    {

        return Db::query($sql);
    }

    /**
     * 原生执行
     */
    final protected function execute($sql = '')
    {

        return Db::execute($sql);
    }

    /**
     * 重写获取器 兼容 模型|逻辑|验证|服务 层实例获取
     */
    public function __get($name)
    {

        $layer = $this->getLayerPre($name);

        if (false === $layer) {

            return parent::__get($name);
        }

        $model = sr($name, $layer);

        return VALIDATE_LAYER_NAME == $layer ? validate($model) : model($model, $layer);
    }

    /**
     * 获取层前缀
     */
    public function getLayerPre($name)
    {

        $layer = false;

        $layer_array = [MODEL_LAYER_NAME, LOGIC_LAYER_NAME, VALIDATE_LAYER_NAME, SERVICE_LAYER_NAME];

        foreach ($layer_array as $v)
        {
            if (str_prefix($name, $v)) {

                $layer = $v;

                break;
            }
        }

        return $layer;
    }
}