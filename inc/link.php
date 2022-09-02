<link rel="stylesheet" href="bootstrap/bootstrap-4.6/css/bootstrap.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->

<link rel="shortcut icon" type="image/jpg" href="images/fidelity logo.jpg">
     <link rel="stylesheet" type="text/css" href="font/css/all.min.css">
           <?php 
        
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
            
            $date = date('d/M/Y');
            $time = date('h:i:sa');
            $script = $_SERVER['SCRIPT_NAME'];

            #$c_ins = "INSERT INTO visitors (address, page, time, date) VALUES ('$ip', '$script', '$time', '$date')";
           # $set = mysqli_query($connect, $c_ins);
     ?>

