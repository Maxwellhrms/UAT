<?php // echo '<pre>'; print_r($list);  ?>
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-12">
        <div class="card mb-0">					
            <div class="card-header">
                <h4 class="card-title mb-0">Employees List</h4>
            </div>
            <div class="card-body">	
                <div class="table-responsive">
                    <table class="datatable table table-stripped mb-0" id="dataTables-example1">
                        <thead><tr><th>Details</th></tr></thead>
                        <tbody>
                            <?php foreach($list as $key => $preval){ ?>
                                <tr><td><?php  print_r($preval); ?></td></tr>
                            <?php  } ?>                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>