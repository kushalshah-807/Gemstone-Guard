<?php
	include "db_connect.php";

	$id = isset($_POST['id'])?check_input($con,base64_decode($_POST['id'])):'';
	$id1 = isset($_POST['id'])?check_input($con,$_POST['id']):'';	

    $obj=new Utility();
    $whereCondition = array('certificate_id' => $id);
    $fetchProduct=$obj->selectWhere($con,$certificateTbl,$whereCondition);
    foreach($fetchProduct as $data){ 
        $data[] = $data;
    }

    //Shape Certi
    $scertis=array();
    $fetchPrRpr=$obj->selectWhere($con,$certishapeTbl,$whereCondition);
    foreach($fetchPrRpr as $selectedPrRpr){ 
        $scertis[]=$selectedPrRpr['shape_id'];
    }

    //Color Certi
    $ccertis=array();
    $fetchCcerti=$obj->selectWhere($con,$certicolorTbl,$whereCondition);
    foreach($fetchCcerti as $dataCcerti){ 
        $ccertis[]=$dataCcerti['color_id'];
    }

    //Clarity Certi
    $crcertis=array();
    $fetchCrcerti=$obj->selectWhere($con,$certiclarityTbl,$whereCondition);
    foreach($fetchCrcerti as $dataCrcerti){ 
        $crcertis[]=$dataCrcerti['clarity_id'];
    }
?>
<div class="pa-20">
<div class="task-detail-box">
    <div class="row">
    	
        <div class="col-md-5">
        	<?php $imgfileSource = "../".$qrcodeImg . DIRECTORY_SEPARATOR . $data['qr_code'];
                if(file_exists($imgfileSource)){ ?>
					<img src="<?php echo $imgfileSource; ?>" style="width:220px; height:220px;" />
							
                    <a href="<?php echo "../".$qrcodeImg . DIRECTORY_SEPARATOR . $data['qr_code']; ?>" download class="btn btn-primary" style="margin-top:10px;" title="Download QR Code"><i class="fa fa-download"> Download QR</i></a>
            <?php } ?>
		</div>
    
        <div class="col-md-7">
            <h4 class="task-name"><i class="fa fa-edit"></i> <?php if(isset($data['summary_no'])){ if($data['summary_no']!=''){ echo $data['summary_no']; } } ?></h4>
            <p><i class="fa fa-calendar"></i> <?php if(isset($data['certificate_date'])){ if($data['certificate_date']!=''){ echo date('d-m-Y',strtotime($data['certificate_date'])); } } ?></p>

            <p><i class="fa fa-user"></i> <?php echo $data['name']; ?>
            (<?php   $fetchClient=$obj->fetchData($con,$customerTbl,"customer_id","DESC");   
                            if(count($fetchClient) > 0){
                            foreach($fetchClient as $dataClient){                             
                                   if($dataClient['customer_id']==$data['customer_id']) { echo $dataClient['company_name']; }
                               } } ?>
            )</p>

            <?php if(isset($data['gst_no'])){ if($data['gst_no']!=''){ ?><p><i class="fa fa-pencil"></i> <?php echo $data['gst_no']; ?></p><?php } } ?>

            <?php if(isset($data['address'])){ if($data['address']!=''){ ?><p><i class="fa fa-map-marker"></i> <?php echo $data['address']; ?></p><?php } } ?>

            <p><i class="fa fa-diamond"></i> <?php $whereCondition = array('variation_id' => "1");
                                $fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
                                if($fetchVtype > 0){
                                    foreach($fetchVtype as $dataVtype){ ?>
                                        <?php if(in_array($dataVtype['variation_type_id'],$scertis)) { echo $dataVtype['variation_type'].", "; }
                             } } ?></p>
            <p><i class="fa fa-balance-scale"></i> <?php echo $data['weight']; ?></p>

            <p><i class="fa fa-paint-brush"></i> <?php $whereCondition = array('variation_id' => "2");
                                $fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
                                if($fetchVtype > 0){
                                    foreach($fetchVtype as $dataVtype){
                                         if(in_array($dataVtype['variation_type_id'],$ccertis)) { echo $dataVtype['variation_type']; }
                             } } ?></p>

            <p><i class="fa fa-heart"></i> <?php $whereCondition = array('variation_id' => "3");
                                $fetchVtype=$obj->selectWhereDataOrd($con,$variationtpTbl,$whereCondition,"variation_type_id","ASC");
                                if($fetchVtype > 0){
                                    foreach($fetchVtype as $dataVtype){
                                          if(in_array($dataVtype['variation_type_id'],$crcertis)) { echo $dataVtype['variation_type']; }
                             } } ?></p>

            <?php if(isset($data['refractive_index'])){ if($data['refractive_index']!=''){ ?><p>Refractive Index : <?php echo $data['refractive_index']; ?></p><?php } } ?>
            <?php if(isset($data['specific_gravity'])){ if($data['specific_gravity']!=''){ ?><p>Specific Gravity : <?php echo $data['specific_gravity']; ?></p><?php } } ?>
            <?php if(isset($data['hardness'])){ if($data['hardness']!=''){ ?><p>Hardness : <?php echo $data['hardness']; ?></p><?php } } ?>
            <?php if(isset($data['origin'])){ if($data['origin']!=''){ ?><p>Origin : <?php echo $data['origin']; ?></p><?php } } ?>
            <?php if(isset($data['measure'])){ if($data['measure']!=''){ ?><p>Measure : <?php echo $data['measure']; ?></p><?php } } ?>
        </div>

        <div class="col-md-12 task-location mt-15">         
            <?php if(isset($data['description'])){ if($data['description']!=''){ ?><p><i class="fa fa-info"></i> Description : <?php echo html_entity_decode($data['description']); ?></p><?php } } ?>
            <?php if(isset($data['comment'])){ if($data['comment']!=''){ ?><p><i class="fa fa-info"></i> Comments :  <?php echo html_entity_decode($data['comment']); ?></p><?php } } ?>
            <?php if(isset($data['identification'])){ if($data['identification']!=''){ ?><p><i class="fa fa-info"></i> Identification : <?php echo html_entity_decode($data['identification']); ?></p><?php } } ?>


            <?php if (isset($data['pdf']) && $data['pdf'] != '')  {
            $imgfileSource1 = "../".$certiPdf . DIRECTORY_SEPARATOR . $data['pdf'];
                if(file_exists($imgfileSource1)){ ?>
            <br /><p><a class="btn bg-maroon" title="PDF" href="<?php echo $imgfileSource1; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a></p><?php } } ?>
        </div>
        

    </div>
    
</div>
</div>