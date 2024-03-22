<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Manage Variation
	    <!--<a href="add-variation.php" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Variation</a> -->
	    <!--<small>...</small>-->
	  </h1>
	  
	</section>
<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
				
					<div class="box-body">
						
						 <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
			                    Variation Type Updated successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                ?>
	                
					<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='status_changed') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                  <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
			                   	Status changed successfully!!.
			                  	</div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	
	                  	$_SESSION['msg'] = '';
	                  	} ?>
						<div class="table-responsive">
					  <table id="employee-role-table" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th># Id</th>
							<th>Variation Type</th>
							<th>Variation Available</th>
							<th>Edit</th>							
						  </tr>
						</thead>
						<tbody>
						<?php   $obj=new Utility();
                     $fetchVariation=$obj->fetchData($con,$variationTbl,"variation_id","DESC");   
							$i=1;
							$avavariations="";
							if(count($fetchVariation) > 0){
							foreach($fetchVariation as $data){							
						?>
						  <tr>
							  <td><?php echo $i;?></td>
							  <td><?php echo $data['variation'];?></td>
							  <td>
							  <?php 		$whereCondition = array('variation_id' => $data['variation_id']);
    $fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
    foreach($fetchVtype as $dataVtype){ 
		$avavariations.=$dataVtype['variation_type'].", ";
             						}							  
             						echo  rtrim($avavariations,", "); 
							     	$avavariations="";
							        ?>
							  </td>
							  
							  <td><a href="edit-variation.php?action=edit&id=<?php echo base64_encode($data['variation_id']);?>" class="btn btn-default" style="margin-right:2px;margin-bottom:6px;" title="Edit"><i class="fa fa-pencil"> Edit</i></a></td>
							
							 </tr>
						<?php
							$i++;
							} 
						}
						?>
						</tbody>
					  </table>
						</div>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
			</div>
		</div>
	</section>
</div>	

<script>
$(".statusButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to change the status of this record?")) {
		window.location = "variation-process.php?action=status&id="+dataid;
	}
});

$(function () {
	$('#employee-role-table').DataTable({
	  "paging": true,
	  "lengthChange": true,
	  "searching": true,
	  "ordering": true,
	  "info": true,
	  "autoWidth": false
	});
});
</script>

<?php
include "footer.php";
?>