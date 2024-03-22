<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Client
	    <!--<small>...</small>-->
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Client</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title">Client Detail</h3><a href="add-client.php" class="btn btn-info pull-right">Add Client</a>
					</div><!-- /.box-header -->
					
					<div class="box-body">
	                  <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_uploaded') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
			                    Client added successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                  	?>
	                  							    
						<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_updated') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
			                    Client Updated successfully!!.
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
	            
	            	<?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='delete_data') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                   	Client Deleted !!.
			                  	</div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	
	                  	$_SESSION['msg'] = '';
	            	} ?>
	            
						
					  <table id="employee-role-table" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th># Sr. No.</th>
							<th>Company Name</th>
							<th>GST No.</th>
							<th>Client Name</th>
							<th>Contact Number</th>
							<th>Email ID</th>
							
							<th>Edit</th>
							<!--<th>Status</th>
							<th>Delete</th>	-->					
						  </tr>
						</thead>
						<tbody>
							<?php   $obj=new Utility();
                     $fetchCategory=$obj->fetchData($con,$customerTbl,"customer_id","ASC");   
							$i=1;
							if(count($fetchCategory) > 0){
							foreach($fetchCategory as $data){
						?>						
						  <tr>
							<td><?php echo $i;?></td>
						   
						   <td><?php echo $data['company_name'];?></td>
						   <td><?php echo $data['gst_no'];?></td>
						   
							<td><?php echo $data['name'];?></td>
							
							<td><?php echo $data['phone_no'];?></td>
							<td><?php echo $data['email_id'];?></td>							
							
							<td>
							  <a href="edit-client.php?id=<?php echo base64_encode($data['customer_id']); ?>" class="btn btn-default" style="margin-right:2px;margin-bottom:6px;" title="Edit"><i class="fa fa-pencil"> Edit</i></a>
							</td>							
							
							<!--<td>
							<?php //if($data['user_status']=="1"){ ?>
								<span class="label label-success show-pointer statusButton" id="<?php //echo base64_encode($data['customer_id']);?>">Active</span>
							<?php	//}
						 	//if($data['user_status']=="0"){?>
								<span class="label label-warning show-pointer statusButton" id="<?php //echo base64_encode($data['customer_id']);?>">Deactive</span>
							<?php	//} ?>
							</td>						
							
							<td><a title="Click here to Delete This Record" class="show-pointer"><span class="label label-danger deleteButton" id="<?php //echo base64_encode($data['customer_id']);?>">Delete</span></a></td> -->
							
						   </tr>
                     <?php $i++;
							  }  } 
						   ?>
						
						</tbody>
					  </table>
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
		window.location = "client-process.php?action=status&id="+dataid;
	}
});

$(".deleteButton").click(function() {
	var dataid = $(this).attr('id');
	if(confirm("Do you really want to delete this record?")) {
		window.location = "client-process.php?action=delete&id="+dataid;
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