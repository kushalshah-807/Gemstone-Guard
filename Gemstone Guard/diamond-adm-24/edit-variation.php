<?php
include "header.php";
include "sidebar.php";

	$id = isset($_REQUEST['id'])?check_input($con,base64_decode($_REQUEST['id'])):'';
	$id1 = isset($_REQUEST['id'])?check_input($con,$_REQUEST['id']):'';
	
	$obj=new Utility();
	$whereCondition = array('variation_id' => $id);
    $fetchVariation=$obj->selectWhere($con,$variationTbl,$whereCondition);
    foreach($fetchVariation as $data){ 
		$data[] = $data; 
    }
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#addVariation").validate({
		rules: {
		variationType: {
				required: true,
			},
		},
		
		messages: {
			variationType: {
				required: "This field cannot be blank.",
			},
				
		}
	});
});
</script>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Variations
	    <!--<small>...</small>-->
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Variations</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-info">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Edit Variation</h3>
	                </div><!-- /.box-header -->
	                
	                <!-- form start -->
	                <form role="form" class="form-horizontal" name="addVariation" id="addVariation"  method="post" action="variation-process.php" autocomplete="off">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="variationName" class="col-sm-3 control-label">Variation Type <span class="mandatory">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="variationType" name="variationType" value="<?php echo $data['variation']; ?>" placeholder="Variation Type" title="Please enter Variation Type" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6" style="margin-top:3%; margin-bottom:3%;">
                     <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" cellpadding="0" cellspacing="0" style="margin:0 auto;">
                            <thead>
                                <tr>
                                    <th>Available Types</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="DefaultTable">
							<?php 		$whereCondition = array('variation_id' => $id);
    $fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
	$a=1;
	if(count($fetchVtype) > 0){
    foreach($fetchVtype as $dataVtype){ ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="oldVtypeId[]" id="oldVtypeId" value="<?php echo $dataVtype['variation_type_id']; ?>"/>
                                                <input type="text" class="form-control" id="default_name<?php echo $a; ?>" name="availableTypes[]" value="<?php echo $dataVtype['variation_type']; ?>" placeholder="Types" title="please enter the Available Types" onblur="checkExistvType('availableTypes', 'default_name1')" required />
                                            </td>
                                            
                                            <td align="center">
                                                <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="insRow();"><i class="fa fa-plus"></i></a>&nbsp;
												<!--<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="removeRow(this.parentNode.parentNode), deleteVType('<?php //echo $dataVtype['variation_type_id'] ?>')"><i class="fa fa-minus"></i></a>-->
                                            </td>
                                        </tr>
                                        <?php
                                        $a++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" id="default_name1" name="availableTypes[]" placeholder="Types" title="please enter the Available Types" onblur="checkExistvType('availableTypes', 'default_name1')" />
                                        </td>
                                        
                                        <td align="center">
                                            <a class="btn btn-xs btn-primary" href="javascript:void(0);" onclick="insRow();"><i class="fa fa-plus"></i></a>&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0);" onclick="removeRow(this.parentNode.parentNode)"><i class="fa fa-minus"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                   
                </div><!-- /.box-body -->
                  <input type="hidden" name="deletevTypeId[]" id="deletevTypeId"/>
                  
                  <input type="hidden" name="variationId" value="<?php echo $id1; ?>" />
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
                    <a href="add-variation.php" class="btn btn-default">Cancel</a>
                </div>
            </form>

	                
	                
	              </div>
			</div>
		</div>             
	</section>
	
</div>	
<!-- Main content -->

<script type="text/javascript">
   <?php if (isset($a) && $a != '') {  ?>
      tableRowId = '<?php echo $a; ?>';
   <?php } else { ?>
      tableRowId = 2;
   <?php }  ?>
   
   var vTypeId = [];
   
    function insRow() {
        rl = document.getElementById("DefaultTable").rows.length;
        var a = document.getElementById("DefaultTable").insertRow(rl);
        a.setAttribute("style", "display:none;");
        a.setAttribute("class", "data");
        var b = a.insertCell(0);
        var c = a.insertCell(1);
        c.setAttribute("align", "center");
        rl = document.getElementById("DefaultTable").rows.length - 1;
        b.innerHTML = '<input type="text" name="availableTypes[]" id="default_name' + tableRowId + '" class="input-medium form-control" placeholder="Types" title="please enter the types for above variation" onblur="checkExistvType(\'availableTypes\',\'default_name' + tableRowId + '\')" required />';
        c.innerHTML = '<a class="btn-xs btn-primary btn" href="javascript:void(0);" onclick="insRow();"><i class="fa fa-plus icon-white"></i></a> <a class="btn-xs btn-danger btn" href="javascript:void(0);" onclick="removeRow(this.parentNode.parentNode);"><i class="fa fa-minus icon-white"></i></a>';
        $(a).fadeIn(800);
        tableRowId++;
    }

    function removeRow(el) {
        $(el).fadeOut("slow", function () {
            el.parentNode.removeChild(el);
            rl = document.getElementById("DefaultTable").rows.length;
            if (rl == 0) {
                insRow()
            }
        });
    }
    
    function checkExistvType(vType, vTypeId) {
        var itemId = document.getElementById(vTypeId).value;
        var itemCount = document.getElementsByName(vType + '[]');
        //alert(itemCount.length);
        var itemLength = itemCount.length - 1;
        var k = 0;
        for (i = 0; i <= itemLength; i++) {
            if (itemId == itemCount[i].value) {
                k++;
            }
        }if (k > 1) {
            document.getElementById(vTypeId).value = '';
            alert("Variations already added..!!");
        }
    }
    
    function deleteVType(id) {
        vTypeId.push(id);
        document.getElementById('deletevTypeId').value = vTypeId;
    }
</script>

<?php
include "footer.php";
?>