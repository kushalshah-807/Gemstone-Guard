<?php include_once("db-connect.php"); ?>
<?php
	$obj=new Utility();
	$create_time=date('Y-m-d H:i:s');	

	$name = isset($_POST['fullName'])?check_input($con,$_POST['fullName']):'';
	$email = isset($_POST['emailId'])?check_input($con,$_POST['emailId']):'';
	$phone_no = isset($_POST['phoneNo'])?check_input($con,$_POST['phoneNo']):'';
	$message = isset($_POST['mesSage'])?check_input($con,$_POST['mesSage']):'';	
	//$inqSub = isset($_POST['inqSubject'])?check_input($con,$_POST['inqSubject']):'';

if($name=='' || $email=='' || $phone_no==''){
		echo "fail";
} else{
    
// ******************* send mail to admin ********************
      
    $admin_to = $smEmailid;
	//$admin_subject = $inqSub;
    $admin_subject = "New Inquiry - IDGL";
    $admin_message = "
    <html>
    <head>
    <title>Client Details</title>
    <style>
    h2 {
        font-size: 22px;
        text-align: center;
    }
    th{
        width: 20%;
        text-align: left;
        padding: 5px 15px;
    }
    td{
        padding: 5px 15px;
    }
    </style>
    </head>
    <body>
    <div style='background: #f5f5f5;max-width: 600px;margin: auto;padding: 15px 30px 30px;'>
    <h2>Client Details</h2>
    <table border='1px' style='background: #fff;
    border: 0;margin: auto;'>
    <tr>
    <th>Name</th>
    <td>$name</td>
    </tr>
	<tr>
    <th>Email</th>
    <td>$email</td>
    </tr>
	<tr>
    <th>Phone</th>
    <td>$phone_no</td>
    </tr>
    <tr>
	<th>Message</th>
    <td>$message</td>
    </tr>	
	<tr>
    <th>IP</th>
    <td>$ip</td>
    </tr>
    </table>
    </div>
    </body>
    </html>
    ";
	
    $admin_headers = "MIME-Version: 1.0" . "\r\n";
    $admin_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $admin_headers .= 'From: <idglinternationallab@gmail.com>' . "\r\n";
    //$admin_headers .= 'Cc: test@example.com' . "\r\n";
    $admin_mail = mail($admin_to,$admin_subject,$admin_message,$admin_headers);
	
	$insert_data = array('name'   => $name,
			'email_id'   => $email,            
            'phone_no'    => $phone_no,
            'message'    => $message,
            'ip_address'    => $ip,
			'contacted_on'    => $create_time			
    );     $insert_stmt=$obj->dataInsert($con,$cntusTbl, $insert_data);            
	$lastInsertedId=mysqli_insert_id($con);

    if($admin_mail && $insert_data!='') {
        echo "success";
    } else {
        echo "fail";
    }
    
}    
?>