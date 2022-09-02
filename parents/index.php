<?php  
	include 'inc/session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fidelity Parents Dashboard</title>
  <style type="text/css">
    #col{
      display: none;
      animation: animation 0.7s linear  1;
    }
    @keyframes animation{
      from{
        transform: scale(0);
      }
      to{
        transform: scale(1);
      }
    }

  </style>
     
<?php include 'inc/link.php'; ?>
</head>
<?php include 'inc/sidebar.php'; ?>
			
<h5 class="col-md-12 mt-3 text-center">Your Wards</h5>
        <?php
          $selt = mysqli_query($connect, "SELECT * FROM register WHERE parent = '{$_SESSION['id']}'");
          $n = 1;
        ?>
        <table class="table  table-striped table-bordered text-center">
    <tr>
        <th>S/N</th>
        <th>Name</th>
        <th>Class</th>
    </tr>
        <?php foreach($selt as $call){ ?>
       <tr class="mb-5">
       <td><?php echo $n++; ?></td>
       <td><?= $call['name']; ?></td>
       <td>
       <?php
          $student_class = mysqli_query($connect, "SELECT * FROM students WHERE user_id = '{$call['id']}' ORDER BY id DESC LIMIT 1");
          foreach($student_class as $c){
            $s =  mysqli_query($connect, "SELECT * FROM class WHERE id = '{$c['class']}'");
            foreach($s as $x){
              echo $x['class'];
            }
          }
       ?>
       </td>
       </tr>

          <?php } ?>

          </table>
			
	

<?php include 'inc/footer.php'; ?>

<div id="loader">
  <div class="pt-5"></div>
    <img src="../images/Blocks-Loading.gif" width="50%" class="d-block m-auto w-50 pt-5">
</div>

<script type="text/javascript">
  var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 300);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("col").style.display = "block";
  }
</script>