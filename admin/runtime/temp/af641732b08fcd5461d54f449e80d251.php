<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\customer\edit.html";i:1528637943;}*/ ?>
	<!-- Imported scripts on this page -->
<!-- 	<script src="__STATIC__/js/jquery-validate/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css"> -->




<form class="validate edit_from" novalidate="novalidate">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">商户编号</label>
				<input type="text" class="form-control" name="uid" placeholder="商户编号" value="<?php echo $info['uid']; ?>" disabled="disabled">
			</div>	
		</div>
		
		<div class="col-md-6">
			
			<div class="form-group">
				<label class="control-label">商户姓名</label>
				<input type="text" class="form-control" name="realname" placeholder="商户姓名" value="<?php echo $info['realname']; ?>">
			</div>	
		
		</div>
	</div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">登录密码</label>
                <input type="password" class="form-control" name="password" placeholder="留空则不更改密码">
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">手机号码</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $info['phone']; ?>" placeholder="手机号码">
            </div>
        </div>
    </div>

    <div class="row">   
		<div class="col-md-6">
			<div class="form-group">
                <label class="control-label">商户状态</label>
                <select class="form-control" name="status">
                    <option value="0" <?php if($info['status'] == '0'): ?> selected="selected" <?php endif; ?> >禁用</option>
                    <option value="1" <?php if($info['status'] == '1'): ?> selected="selected" <?php endif; ?> >启用</option>
                </select>
			</div>
		</div>
    </div>


	
</form>