<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\user\role_add.html";i:1529332576;}*/ ?>
<!-- Imported scripts on this page -->
<!-- 	<script src="__STATIC__/js/jquery-validate/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css"> -->


<form class="validate add-form" novalidate="novalidate">

    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label class="control-label">管理编号</label>
                <input type="text" class="form-control" name="sn" placeholder="员工编号" value="<?php echo date('ymdhis',time()); ?><?php echo rand(10000,99999); ?>">
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label class="control-label">管理姓名</label>
                <input type="text" class="form-control" name="truename" placeholder="员工姓名" >
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">登录账户</label>
                <input type="text" class="form-control" name="username" placeholder="登录账户" >
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">登录密码</label>
                <input type="text" class="form-control" name="password" placeholder="密码" >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">管理状态</label>
                <select class="form-control" name="status">
                    <option value="0" >禁用</option>
                    <option value="1" >启用</option>
                </select>
            </div>
        </div>
    </div>

</form>