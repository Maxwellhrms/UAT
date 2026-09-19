<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col">
					<h3 class="page-title">Email Logs</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
						<li class="breadcrumb-item active">Email Log Details</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

<div class="row" style="margin-top: 10px;">
	<div class="col-sm-12">
		<div class="card mb-0">
			<div class="card-header">
				<h4 class="card-title mb-0">Email Logs Details</h4>
			</div>
			<div class="card-body" id="displaymenushere">	
                <!--cut-->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                    			<?php 
                    			foreach ($showlist[0] as $key => $grvalue) { ?>
                    			<tr>
                    			    <td><?php echo str_replace("_"," ",ucfirst($key)); ?></td>
                    			    <?php if($key == 'email_sent'){ ?>
                    				<td><pre><?php echo prettyPrint($grvalue); ?></pre></td>
                    				<?php } else if($key == 'email_response'){ ?>
                    				<td><?php if($grvalue == '1'){ echo 'Sent';}else{ echo $grvalue; } ?></td>
                    				<?php }else{ ?>
                    				<td><?php echo $grvalue; ?></td>
                    				<?php } ?>
                    			</tr>
                    			<?php } ?>
                    	</table>
                    </div>
                     <!--cut-->
			</div>
		</div>
	</div>
</div>


	</div>			
</div>
<?php 
function prettyPrint( $json )
{
    $result = '';
    $level = 0;
    $in_quotes = false;
    $in_escape = false;
    $ends_line_level = NULL;
    $json_length = strlen( $json );

    for( $i = 0; $i < $json_length; $i++ ) {
        $char = $json[$i];
        $new_line_level = NULL;
        $post = "";
        if( $ends_line_level !== NULL ) {
            $new_line_level = $ends_line_level;
            $ends_line_level = NULL;
        }
        if ( $in_escape ) {
            $in_escape = false;
        } else if( $char === '"' ) {
            $in_quotes = !$in_quotes;
        } else if( ! $in_quotes ) {
            switch( $char ) {
                case '}': case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;

                case '{': case '[':
                    $level++;
                case ',':
                    $ends_line_level = $level;
                    break;

                case ':':
                    $post = " ";
                    break;

                case " ": case "\t": case "\n": case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
            }
        } else if ( $char === '\\' ) {
            $in_escape = true;
        }
        if( $new_line_level !== NULL ) {
            $result .= "\n".str_repeat( "\t", $new_line_level );
        }
        $result .= $char.$post;
    }

    return $result;
}
?>