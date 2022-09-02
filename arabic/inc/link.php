	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap-4.6/css/bootstrap.min.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/popper.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
     <link rel="stylesheet" type="text/css" href="../font/css/all.min.css">
     <link rel="stylesheet" type="text/css" href="../css/styles.css">
     <script type="text/javascript" src="../js/java.js"></script>
     <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<link rel="shortcut icon" type="image/jpg" href="../images/fidelity logo.jpg">
     

      <?php
        
            #$client = $_SERVER ['http_client_ip'];
            #$for = $_SERVER ['HTTP_X_FORWARDED_FOR'];
            $remote = $_SERVER['REMOTE_ADDR'];
        #if (!empty($client)) {
        #   $ip = $client;
        #}elseif (!empty($for)) {
        #   $ip = $for;
        #}else{
            $ip = $remote; 
            $date = date('d/M/Y');
            $time = date('H:i:sa');
            $script = $_SERVER['SCRIPT_NAME'];
            date_default_timezone_set('Africa/Lagos');
            $ins = "INSERT INTO visitors (address, page, time, date) VALUES ('$ip', '$script', '$time', '$date')";
            $set = mysqli_query($connect, $ins);
        #};

    ?>