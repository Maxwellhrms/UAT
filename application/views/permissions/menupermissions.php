<?php 
$rolemenu = array();
$rolesubmenu = array();
if(count($existdata) > 0){
	foreach($existdata as $key => $val){
		array_push($rolemenu, $val->maxper_menuid);
	}
}

if(count($subexistdata) > 0){
	foreach($subexistdata as $key => $val){
		array_push($rolesubmenu, $val->maxsubwise_submenu_id);
	}
}
?>
<div class="container">
	<?php foreach ($mainmenus as $key => $res) {
		if(in_array($res->maxgp_id, $rolemenu)){
			$checked = "checked";
			$menuclass = "show";
		}else{
			$checked = "";
			$menuclass = "hide";
		}
	?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel-group btn btn-secondary" style="width: 100%;">
        <div class="panel panel-default">
          <div class="panel-heading">
            <!-- <h4 class="panel-title"> -->
            <div class="text-left">
            <?php echo $res->maxgp_name ?>
          	</div>
          	<!----MENU RADIO BUTTONS--->
            <div class="text-right">
      			 <input name="menu[]" type="checkbox" class="menu_checkbox" value="<?php echo $res->maxgp_id ?>" data-toggle="collapse" data-target="#collapseOne_<?php echo $key ?>" <?php echo $checked; ?> /> Yes
      		</div>
          	<!----!MENU RADIO BUTTONS--->
            <!-- </h4> -->
          </div>
          <div id="collapseOne_<?php echo $key ?>" class="panel-collapse collapse <?php echo $menuclass; ?>">
            <div class="panel-body">
            	<?php foreach($submenus as $key1 => $row){ 
            		if($res->maxgp_id == $row->maxpg_gp_id){ 
            			if(in_array($row->maxpg_id,$rolesubmenu)){
            				$subchecked = "checked";
            			}else{
            				$subchecked = "";
            			}
            			?>
              			<input type="checkbox" class="sub_menu_checkbox" name="submenu_<?php echo $res->maxgp_id ?>[]" value="<?php echo $row->maxpg_id ?>" <?php echo $subchecked ?> > <?php echo $row->maxpg_name ?>
              		<?php } ?>
          		<?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
<?php } ?>
</div>