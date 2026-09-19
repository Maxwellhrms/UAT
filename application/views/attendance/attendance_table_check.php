<!-- Short leaves tables -->
<div class="row">
    <div class="col-md-12">
	<div class="table-responsive">
            <table class="table table-striped custom-table mb-0 datatable" id ="dataTables-example">
	    <thead>
		<tr>
                    <th>Sno</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Assign Employee Attandance </th>
		</tr>
	    </thead>
            <tbody id="shrt_tbody">
                <?php $i=0;
                foreach($att as $q){ $i++;
                ?>
		        <tr id="shrt_tr_1">
                    <td id="id"><?php echo $i; ?></td>
                    <td id="year" ><?php echo $q['year']; ?></td>
                    <td id="month"><?php echo $q['month']; ?></td>
                    <?php if( $q['flag']==1){ ?>
                    <td style="color: green">Table Already Exist</td>
                   <td></td>
                    <?php }else{ ?>
                    <td style="color: red">Create Table</td>
                    <td><button type="button" value="<?php echo $q['year'].'_'.$q['m'] ?>" id="cretab" class="btn btn-primary create_tab">Create Table</button></td>
                    <?php } ?>
                    <?php if($q['catt']==1 && $q['flag']==0 ){ ?>
                        <td><button type="button" value="<?php echo $q['year'].'_'.$q['m'] ?>" id="crtab" class="btn btn-primary create_attend_tab" disabled >Assign Emp Att</button></td>
                    <?php }else if($q['catt']==1){ ?>
                        <td><button type="button" value="<?php echo $q['year'].'_'.$q['m'] ?>" id="crtab" class="btn btn-primary create_attend_tab" >Assign Emp Att</button></td>
                    <?php }else{?><td></td> <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
	    </table>
	</div>
    </div>
</div>
<!-- Short leaves tables -->
<script>
	$(document).ready(function() {
		var table = $('#dataTables-example').DataTable({
			lengthChange: false,
			 buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
			//buttons: ['excel']
		});
            });
 </script>