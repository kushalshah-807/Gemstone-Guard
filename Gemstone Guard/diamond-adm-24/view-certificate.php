<?php
include "header.php";
include "sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	  Certificate List
	    <a href="add-certificate.php" class="btn btn-primary pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i>&nbsp;Add Certificate</a>
	  </h1>	  
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box">
					<div class="box-body">
					
					 <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='data_uploaded') { ?>
	                  	<div class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Certificate Added successfully!!.
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
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                    Certificate Updated successfully!!.
			                   </div>
		                  	</div>
	                  	</div>
	                  	<?php 
	                  	$_SESSION['msg'] = '';
	                  	} 
	                ?>
	                
					  <?php if(isset($_SESSION['msg']) && $_SESSION['msg']=='status_changed') { ?>
	                  	<div id="status-alert" class="row">
			                <div class="col-sm-6">
				                <div class="alert alert-success alert-dismissible">
			                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
							<th># Sr. No.</th>
							<th>Summary No.</th>
							<th>Date</th>
							<th>Company Name</th>
							<th>Total EST WT</th>
							<th>Refractive Index</th>
							<th>Origin</th>							
							<!--<th>QR Code</th> -->
							<th>View More</th>
							<th>Edit</th>
							<th>Status</th>							
						</tr>
						</thead>
						<tbody>
						<?php
							$fetch_product=mysqli_query($con,"SELECT `inv`.* FROM `".$certificateTbl."` AS `inv` ORDER BY `inv`.`certificate_id` DESC")or die(mysqli_error($con));
							$i=1;
							if(mysqli_num_rows($fetch_product)>0) {
							while($data = mysqli_fetch_array($fetch_product)) {
						?>
						  <tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $data['summary_no']; ?></td>
						    <td><?php echo date('d-m-Y',strtotime($data['certificate_date']));?></td>
							<td><?php echo $data['company_name'];?></td>							
							<td><?php echo $data['weight']; ?></td>
							<td><?php echo $data['refractive_index']; ?></td>
							<td><?php echo $data['origin']; ?></td>							

							<td>
							  <a data-id="<?php echo base64_encode($data['certificate_id']);?>" href="javascript:void(0);" class="btn btn-primary vmdetail" style="margin-right:2px;margin-bottom:6px;" title="View More Detail"><i class="fa fa-eye"> Detail</i></a>
							</td>

							<td><a title="Click here to Edit This Record" href="edit-certificate.php?action=edit&id=<?php echo base64_encode($data['certificate_id']);?>" class="btn btn-default" style="margin-right:2px;margin-bottom:6px;" title="Edit"><i class="fa fa-pencil"> Edit</i></a>
							</td>

							<td>
							<?php if($data['status']=="1"){?>
							<a title="Click here to Disable Record" class="show-pointer"><span class="label label-success statusButton" data-id="<?php echo base64_encode($data['certificate_id']);?>">Active</span></a>	
						<?php	}
						 if($data['status']=="0"){?>
							<a title="Click here to Active This Record" class="show-pointer"><span class="label label-warning statusButton" data-id="<?php echo base64_encode($data['certificate_id']);?>">Deactive</span></a>
						<?php	}?>
							</td>

					      </tr>
						<?php
							$i++;   } 
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

<div class="modal fade" id="vdModal" role="dialog">
    <div class="modal-dialog">
                
        <!-- Modal content-->
        <div class="modal-content width-100">
            <div class="modal-header">
                <h4 class="modal-title">Certificate Detail</h4>
            </div>
            <div class="certi-dtl-pu-box">
                          
            </div>
            <div class="modal-footer" style="border:none;">
                <button type="button" class="btn btn-default border-btn" data-dismiss="modal">Close</button>
            </div>
        </div>
                  
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.vmdetail').click(function(){
                   
            var id = $(this).data('id');
console.log(id);
            // AJAX request
            $.ajax({
                url: 'certificate-detail-popup.php',
                type: 'post',
                data: {id: id},
                success: function(response){ 
                    // Add response in Modal body
                    $('.certi-dtl-pu-box').html(response); 

                    // Display Modal
                    $('#vdModal').modal('show'); 
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
$(document).ready(function(){  
  $('.statusButton').click(function(){
    var el = this;

    //id
    var dataid = $(this).data('id'); 

    // Confirm box
    bootbox.confirm("Do you really want to change the status of this record?", function(result) { 
       if(result){
         // AJAX Request
         $.ajax({
           url: 'certificate-process.php',
           type: 'POST',
           data: { id:dataid, 
           	action:"status" },
           success: function(response){
             // Removing row from HTML Table
             if(response == 1){
             	//$(el).closest('tr').css('background','tomato');
                //$(el).closest('tr').fadeOut(800,function(){
   				//$(this).remove();
				//});				
				window.location.href = window.location.href;
		    } else{
				bootbox.alert('Status of this record not updated.');
		    }

           }
         });
       }
 
    });
 
  });
});


$(function () {
	$('#employee-role-table').DataTable({
	  "paging": true,
	  /* "pageLength": 100, */
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