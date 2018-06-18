<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\channel\edit.html";i:1528539449;}*/ ?>
<!-- Imported scripts on this page -->
<!-- 	<script src="__STATIC__/js/jquery-validate/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css"> -->


<form class="validate add-form" novalidate="novalidate">

    <div class="row">
        <div class="col-md-4">

            <div class="form-group">
                <label class="control-label">渠道编号</label>
                <input type="text" class="form-control" value="<?php echo $info['sn']; ?>" readonly>
            </div>

        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label class="control-label">渠道名称</label>
                <input type="text" class="form-control" name="channel" value="<?php echo $info['channel']; ?>" placeholder="渠道名称" >
            </div>

        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label class="control-label">渠道费率</label>
                <input type="text" class="form-control" name="rate" value="<?php echo $info['rate']; ?>" placeholder="渠道费率 ： 0.8" >
            </div>

        </div>
    </div>
    <div class="row">
        <?php if(is_array($app) || $app instanceof \think\Collection || $app instanceof \think\Paginator): if( count($app)==0 ) : echo "" ;else: foreach($app as $k=>$vo): ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label"><?php echo $k; ?></label>
                <input type="text" class="form-control" name="<?php echo $k; ?>" value="<?php echo $vo; ?>" placeholder="商户Appid" >
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">状态</label>
                <select class="form-control" name="status">
                    <option value="0" <?php if($info['status'] == '0'): ?> selected="selected" <?php endif; ?> >禁用</option>
                    <option value="1" <?php if($info['status'] == '1'): ?> selected="selected" <?php endif; ?> >启用</option>
                </select>
            </div>
        </div>
    </div>

</form>