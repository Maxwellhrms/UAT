<?php if(count($alldata) == 0){
    echo '<center><h4>NO FILES ADDED</h4></center>'; exit();
} ?>
<?php 
$thumb = array(
	'pdf' => 'fa fa-file-pdf-o',
	'docx' => 'fa fa-file-word-o',
	'png' => 'fa fa-file-image-o',
	'xls' => 'fa fa-file-excel-o',
	'ppt' => 'fa fa-file-powerpoint-o',
	'mp3' => 'fa fa-file-audio-o',
	'psd' => 'fa fa-file-image-o',
	'txt' => 'fa fa-file-text-o',
	'mp4' => 'fa fa-file-video-o',
	'html' => 'fa fa-file-code-o',
	'xlsx' => 'fa fa-file-excel-o',
	'pptx' => 'fa fa-file-powerpoint-o',
);
?>
<div class="file-body">
	<div class="file-scroll">
		<div class="file-content-inner">
			<?php 
			if(count($alldata) > 0){
				
				if(count($alldata) > 4){
					$count = 4;
				}else{
					$count = count($alldata);
				}
			 ?>
			<h4>Recent Files</h4>
			<div class="row row-sm">
				<?php for ($i=0; $i < $count; $i++) { ?>
				<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
					<div class="card card-file">
						<div class="dropdown-file">
							<a class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?php echo base_url() . $alldata[$i]['mxapfile_link'] ?>" target="_blank" class="dropdown-item">Download</a>
								<a class="dropdown-item" onclick="deletefiles('<?php echo $alldata[$i]['mxapfile_id']; ?>')" >Delete</a> 
							</div>
						</div>
						<div class="card-file-thumb">
							<?php if(array_key_exists($alldata[$i]['mxapfile_extension'], $thumb)){ ?>
							<i class="<?php echo $thumb[$alldata[$i]['mxapfile_extension']]; ?>"></i>
							<?php } ?>
						</div>
						<div class="card-body">
							<h6><a><?php echo $alldata[$i]['mxapfile_name'] .'.'. $alldata[$i]['mxapfile_extension']  ?></a></h6>
							<span><?php echo $alldata[$i]['mxapfile_size'] ?></span>
						</div>
						<div class="card-footer"><?php echo time_elapsed_string($alldata[$i]['mxapfile_createdtime']); ?></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>

<?php if(count($alldata) > 4){ ?>
			<h4>Files</h4>
			<div class="row row-sm">
				<?php for ($i=4; $i < count($alldata); $i++) { ?>
				<div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
					<div class="card card-file">
						<div class="dropdown-file">
							<a href="" class="dropdown-link" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?php echo base_url() . $alldata[$i]['mxapfile_link'] ?>" target="_blank" class="dropdown-item">Download</a>
								<a class="dropdown-item" onclick="deletefiles('<?php echo $alldata[$i]['mxapfile_id']; ?>')" >Delete</a> 
							</div>
						</div>
						<div class="card-file-thumb">
							<?php if(array_key_exists($alldata[$i]['mxapfile_extension'], $thumb)){ ?>
							<i class="<?php echo $thumb[$alldata[$i]['mxapfile_extension']]; ?>"></i>
							<?php } ?>
						</div>
						<div class="card-body">
							<h6><a><?php echo $alldata[$i]['mxapfile_name'] .'.'. $alldata[$i]['mxapfile_extension']  ?></a></h6>
							<span><?php echo $alldata[$i]['mxapfile_size'] ?></span>
						</div>
						<div class="card-footer"><?php echo time_elapsed_string($alldata[$i]['mxapfile_createdtime']); ?></div>
					</div>
				</div>
				<?php } ?>
			</div>
<?php } ?>
		</div>
	</div>
</div>

<?php 
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>