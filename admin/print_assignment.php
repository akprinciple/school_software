<?php
	// use Twilio\Rest\Client;
	require 'class/class.phpmailer.php';

include 'inc/session.php';
$message = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Assignments | Fidelity Schools</title>
	
	<?php include 'inc/link.php'; ?>
	

</head>
<body>
<?php
	if (isset($_GET['class']) && isset($_GET['date'])) {
	 	$class = (int)$_GET['class'];
	 	$date = $_GET['date'];
	
	 	
	 $n = 1; 
	$sel = mysqli_query($connect, "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}' ORDER BY id DESC");
	// echo mysqli_num_rows($sel);
	?>
	<div class="col-md-11 m-auto p-3" style="">
		<img src="../images/fidelity heading.jpg" style="width: 100%">

		<div class="row rounded mt-2 mx-0">
			<div class="w-50 p-2 text-center">
				<p class="mx-0 row">
	 <span class="font-weight-bold" style="width: 10%">Date :</span>
			<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
				<?php 
	echo $date;
	?>
	
			</span>
	</p>
				
			</div>
			<div class="w-50 p-2  text-center">
				<p class="mx-0 row">
	 <span class="font-weight-bold" style="width: 10%">Class :</span>
		<span class=" text-center font-weight-bold " style="border-bottom: 1px solid green; width: 87%; font-size: 18px;">
	<?php 
	$c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
	while ($clas = mysqli_fetch_array($c_query)) {
	 	echo $clas['class'];
	 } 
	?>
	
		</span>
	</p>
	
			</div>

		</div>
		
		<h4 class="text-center">Assignment</h4>
	<?php
	foreach ($sel as $key) {
		
	
 ?>
 	<div class="p-2 border rounded border-success mb-2">
 		<span class="rounded-circle bg-success text-light p-2 my-2"><?php  echo $n++; ?></span>
         <b> <?php 
         $sel_subject = mysqli_query($connect, "SELECT subject FROM subjects WHERE id = '{$key['subject']}'");
         foreach ($sel_subject as $sub)
         echo $sub['subject']; 
         
         ?></b>
         <p>
         <?php echo $key['description']; ?>
         </p>
         <span>To be submitted on or before <b><?php echo $key['submission_date']; ?></b></span>
 	</div>
 <?php }} ?>
 	</div>


 	<?php 
 	if (isset($_GET['class']) && isset($_GET['date'])) {
	 	
	
	 	
	 $n = 1; 
	// $sel = mysqli_query($connect, "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}' ORDER BY id DESC");

 		function fetch_customer_data($connect)
{
	$class = (int)$_GET['class'];
	 	$date = $_GET['date'];
	$query = "SELECT * FROM assignment WHERE class ='{$class}' && date = '{$date}' ORDER BY id DESC";
	// $statement = $connect->prepare($query);
	// $statement->execute();
	// $resultSet = $statement->get_result();
    // $result = $resultSet->fetch_all();
    $statement = mysqli_query($connect, $query);
    $p = 1;
    $c_sql = "SELECT * FROM class WHERE id = '{$class}'";
            $c_query = mysqli_query($connect, $c_sql);
            $clas = mysqli_fetch_array($c_query);
	$output = '
	<div class="col-md-11 m-auto p-3" style="">
	<img src="../images/fidelity heading.jpg" style="width: 100%">

	<div class=" rounded mt-2 mx-0">
		<div class="w-50 p-2 float-left">
			<p class="mx-0 row">
	        <span class="font-weight-bold float-left" style="width: 15%">Date :</span>
			<span class=" text-center font-weight-bold float-right" style="border-bottom: 1px solid green; width: 80%; font-size: 18px;">
            ' .$date.'
             </span>
	        </p>
		</div>
		<div class="w-50 p-2  float-right">
			<p class="mx-0 ">
	        <span class="font-weight-bold float-left" style="width: 15%">Class :</span>
		    <span class=" text-center font-weight-bold float-right" style="border-bottom: 1px solid green; width: 80%; font-size: 18px;">
           
           '.
                 $clas["class"] .'
            
            </span>
	        </p>
	    </div>

	<div class="clearfix"></div>
	</div>
		
    <h4 class="text-center mt-5">Assignment</h4>';
    $n = 1;
	foreach($statement as $key)
	{
        $sel_subject = mysqli_query($connect, "SELECT subject FROM subjects WHERE id = '{$key['subject']}'");
        $sub = mysqli_fetch_array($sel_subject);
         
        
       
		$output .= '
        <div class="p-2 border rounded border-success mb-2">
        <span class="rounded-circle p-2 my-2" style="border-radius: 50%">'.$n++.".".'</span>
        <b style="font-weight: bold"> '. '&nbsp; '.
        $sub['subject'].'
        </b>
        <p>
        '.$key['description'].'
        </p>
        <span>To be submitted on or before <b>'. $key['submission_date'].'</b></span>
    </div>
		';
	}
	$output .= '
		
	</div>
	';
	return $output;
}}

if(isset($_POST["action"]))
{
    include('pdf.php');
    // To fetch Class
    $c_sql = "SELECT * FROM class WHERE id = '{$class}'";
	$c_query = mysqli_query($connect, $c_sql);
    $clas = mysqli_fetch_array($c_query);
    // To convert to pdf dynamically 
	$file_name = "fid ". "{$clas['class']}"." $date ". "Assignment".'.pdf';
	$html_code = '<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-4.6/css/bootstrap.min.css">';
	$html_code .= fetch_customer_data($connect);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	$file_location = "pdf/".$file_name;
	file_put_contents($file_name, $file);
    // echo $file_name;
    // save to folder
	// if(file_put_contents($file_location, $file)){
	// 	echo "<h1>Good</h1>";
    // }else{ echo "<h1>Error</h1>";}

    

// // Update the path below to your autoload.php,
// // see https://getcomposer.org/doc/01-basic-usage.md
// require 'twilio-php-main/src/Twilio/autoload.php';


// // Find your Account SID and Auth Token at twilio.com/console
// // and set the environment variables. See http://twil.io/secure
// $sid = 'AC539530fe2175e0976fe0db47c5e1b491';

// $token = '725234f39bec1d5d49cfa1343d8c4986';
// $twilio = new Client($sid, $token);

// $message = $twilio->messages->create("whatsapp:+2348145864549", // to
//                            [
//                                "from" => "whatsapp:+14155238886",
//                                "body" => "Hello there!"
//                            ]
//                   );

// print($message->sid);

// }
// require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '465';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'akeemolayiwola09@gmail.com';					//Sets SMTP username
	$mail->Password = 'gciqpcwfplnmkxfh';					//Sets SMTP password
	$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'akeemolayiwola09@gmail.com';			//Sets the From email address for the message
	$mail->FromName = 'Akeem Olayiwola';			//Sets the From name of the message
	$mail->AddAddress='akeemolayiwola9@gmail.com';		//Adds a "To" address
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Customer Details';			//Sets the Subject of the message
	$mail->Body = 'Please Find Customer details in attach PDF File.';				//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been sent successfully...</label>';
	}else{
        $message = '<label class="text-danger">Mail not sent...</label>' ;
    }
	unlink($file_name);
}

?>
 <form action="" method="post" style="position: absolute; bottom: 0" class="p-2 position-fixed d-block w-100">
 	<div class="text-center">
     
     </div>
     <center>
   
    <button type="button" class="btn btn-success p-2" onclick="print(this)">Print</button>
    <a href="assignment?class=<?php echo $class; ?>&date=<?php echo $date; ?>" class="btn btn-danger p-2">Go Back</a>
    <!-- <input type="submit" name="action" value="Send &#xf232;" class="btn btn-danger btn-lg fab fa-whatsapp"> -->
</center>
 </form>

 
 	 <?php
			#echo fetch_customer_data($connect);
			?>
</body>
</html>