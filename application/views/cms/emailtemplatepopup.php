<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Division</label>
			<select class="select2 form-control" style="width: 100%;" name="division" id="division">
			    <option value="">All</option>
				<?php 
					foreach($divisionjob as $keyv=>$asvalue){   
						if($keyv == $list[0]->email_division){
								$sel = "selected";
							}else{
								$sel = "";
							}	?>
						<option <?php echo $sel; ?> value="<?php echo $keyv; ?>" > <?php echo $asvalue; ?></option>
				<?php	}	?>
			</select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" type="text" name="title" id="title" value="<?php echo $list[0]->email_title ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Subject</label>
            <input class="form-control" type="text" name="subject" id="subject" value="<?php echo $list[0]->email_subject ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>To</label>
            <input class="form-control" type="text" name="to" id="to" value="<?php echo $list[0]->email_to ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>CC</label>
            <input class="form-control" type="text" name="cc" id="cc" value="<?php echo $list[0]->email_cc ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>BCC</label>
            <input class="form-control" type="text" name="bcc" id="bcc" value="<?php echo $list[0]->email_bc ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Show in Letters</label>
            <input name="showinletters" id="showinletters" value="1" type="checkbox" <?php if($list[0]->showinletters  == 1){ echo 'checked';} ?>>
        </div>
    </div>
    
    
    <span><span style="color:red">Note:</span> Please add Mutiple <span style="color:red"><b>To (or) Cc (or) Bcc</b></span> as Test@gmail.com<span style="color:red"><b>,</b></span>Test2@gmail.com (Dont forget use , when there are Mutiples. If single Don't use ,)</span>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="desc" name="desc"><?php echo $list[0]->email_body ?></textarea>
        </div>
    </div>
</div>
<input type="hidden" name="id" value="<?php echo $list[0]->id ?>">
<p>
<span style="color:red">Tags:-</span> 
<?php 
if(!empty($list[0]->email_tags)){
$ex = explode(',',$list[0]->email_tags);
foreach($ex as $key => $val){ ?>
<a onclick="appendtags('<?php echo $val ?>')" type="button" class="btn btn-primary" value="<?php echo $val ?>"><?php echo str_replace(array('{', '}'), array('', ''), $val); ?></a>
<?php 
}
}
?>
</p>
<div class="submit-section">
    <button class="btn btn-primary submit-btn">Submit</button>
</div>
<script>
    function appendtags(val){
        CKEDITOR.instances['desc'].insertHtml(val);
    }
</script>