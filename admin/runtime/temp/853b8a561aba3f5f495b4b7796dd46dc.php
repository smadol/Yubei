<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\user\edit.html";i:1528529974;}*/ ?>
	<!-- Imported scripts on this page -->
<!-- 	<script src="__STATIC__/js/jquery-validate/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css"> -->




<form class="validate edit_from" novalidate="novalidate">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="field-1" class="control-label">员工编号</label>
				<input type="hidden" name="id" value="<?php echo $info['id']; ?>">
				<input type="hidden" name="sn" value="<?php echo $info['sn']; ?>">
				<input type="text" class="form-control" name="sn" placeholder="员工编号" value="<?php echo $info['sn']; ?>" disabled="disabled">
			</div>	
		</div>
		
		<div class="col-md-6">
			
			<div class="form-group">
				<label class="control-label">员工姓名</label>
				<input type="text" class="form-control" name="truename" placeholder="员工姓名" value="<?php echo $info['truename']; ?>">
			</div>	
		
		</div>
	</div>

    <div class="row">   
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">角色</label>
                <select class="form-control" name="role">
                        <option value="0" >默认</option>
                        <?php if(is_array($role) || $role instanceof \think\Collection || $role instanceof \think\Paginator): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['id']; ?>" <?php if($info['role'] == $vo['id']): ?> selected="selected" <?php endif; ?>><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>  
            </div>
        </div>        
    </div>

    <div class="row">
<!-- 		<div class="col-md-6">
			<div class="form-group">
                <label class="control-label">登录账户</label>
                <input type="text" class="form-control" name="username" placeholder="登录账户" value="<?php echo $info['username']; ?>">
			</div>
		</div> -->

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">登录密码</label>
                <input type="password" class="form-control" name="password" placeholder="留空则不更改密码">
            </div>
        </div>        
    </div>

    <div class="row">   
		<div class="col-md-6">
			<div class="form-group">
                <label class="control-label">员工状态</label>
                <select class="form-control" name="status">
                    <option value="0" <?php if($info['status'] == '0'): ?> selected="selected" <?php endif; ?> >禁用</option>
                    <option value="1" <?php if($info['status'] == '1'): ?> selected="selected" <?php endif; ?> >启用</option>
                </select>
			</div>
		</div>
    </div>


	
</form>