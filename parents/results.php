<?php  
	include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Results | Fidelity Schools</title>
  <style type="text/css">
  
  </style>
     
<?php include 'inc/link.php'; ?>
</head>
<?php include 'inc/sidebar.php'; ?>
			
<h5 class="col-md-12 mt-3 text-center">Your Wards' Results</h5>
        <?php
          $selt = mysqli_query($connect, "SELECT * FROM parents WHERE parent = '{$_SESSION['id']}' ORDER BY id DESC");
          $n = 1;
        ?>
        <table class="table  table-striped table-bordered text-center table-responsive-xl">
    <tr>
        <th>S/N</th>
        <th>Name</th>
        <th>Class</th>
        <th>Term</th>
        <th>Session</th>
        <th>Action</th>
    </tr>
        <?php foreach($selt as $call){ ?>
       <tr class="mb-5">
       <td><?php echo $n++; ?></td>
       <td><?php 
        $student_name = mysqli_query($connect, "SELECT * FROM register WHERE id = '{$call['user_id']}' ORDER BY id DESC LIMIT 1");
        foreach($student_name as $c){
         echo $c['name'];
        }
       ?></td>
       <td>
       <?php
          $student_class = mysqli_query($connect, "SELECT * FROM class WHERE id = '{$call['class']}'");
          foreach($student_class as $c){
           echo $c['class'];
          }
       ?>
       </td>
       <td>
       <?php
          $student_term = mysqli_query($connect, "SELECT * FROM term WHERE id = '{$call['term']}'");
          foreach($student_term as $c){
           echo $c['term'];
          }
       ?>
       </td>
       <td>
       <?php
          $student_session = mysqli_query($connect, "SELECT * FROM session WHERE id = '{$call['session']}'");
          foreach($student_session as $c){
           echo $c['session'];
          }
       ?>
       </td>
       <td>
       <a href="view_result?id=<?php echo md5($call['user_id']); ?>&class=<?=$call['class']; ?>&session=<?=$call['session']; ?>&&term=<?=$call['term']; ?>" class="btn btn-primary">View Result</a>
       </td>
       </tr>

          <?php } ?>

          </table>
			
	

<?php include 'inc/footer.php'; ?>

