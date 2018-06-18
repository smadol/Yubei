<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\PHPTutorial\WWW\yubei\admin\public/../app/view\channel\create.html";i:1528535821;}*/ ?>
	<!-- Imported scripts on this page -->
<!-- 	<script src="__STATIC__/js/jquery-validate/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="__STATIC__/css/xenon-forms.css"> -->


<form class="validate add-form" novalidate="novalidate">

	<div class="row">
		<div class="col-md-4">
			
			<div class="form-group">
				<label class="control-label">渠道编号</label>
				<input type="text" class="form-control" name="sn" placeholder="渠道编号（3位数字例如999）">
			</div>	
			
		</div>
		<div class="col-md-4">
			
			<div class="form-group">
				<label class="control-label">渠道名称</label>
				<input type="text" class="form-control" name="channel" placeholder="渠道名称" >
			</div>	
		
		</div>
		<div class="col-md-4">

			<div class="form-group">
				<label class="control-label">渠道费率</label>
				<input type="text" class="form-control" name="rate" placeholder="渠道费率 ： 0.8" >
			</div>

		</div>
	</div>
    <div class="row">   
		<div class="col-md-12">
			<div class="form-group">
                <label class="control-label">appid</label>
                <input type="text" class="form-control" name="appid" placeholder="商户Appid" >
			</div>
		</div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">private_key</label>
                <input type="text" class="form-control" name="private_key" placeholder="商户私钥" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">public_key</label>
                <input type="text" class="form-control" name="public_key" placeholder="平台私钥" >
            </div>
            <p class="help-block">微信支付请将公钥私钥填写一致.</p>
        </div>
    </div>

	<div class="row">
		<div class="col-sm-12">
			<label class="control-label">备注</label>
			<textarea name="remark" class="form-control" cols="5" ></textarea>
		</div>
	</div>

    <div class="row">   
		<div class="col-md-8">
			<div class="form-group">
                <label class="control-label">状态</label>
                <select class="form-control" name="status">
                    <option value="0" >禁用</option>
                    <option value="1" >启用</option>
                </select>  
			</div>
		</div>
    </div>
	
</form>