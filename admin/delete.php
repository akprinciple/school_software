<?php
include '../inc/config.php';

if (isset($_GET['del_user'])) {
$id = (int)$_GET['del_user'];
$sql = "DELETE FROM users WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: users");
}

if (isset($_GET['del_class'])) {
$id = (int)$_GET['del_class'];
$sql = "DELETE FROM class WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: classes");
}

if (isset($_GET['del_term'])) {
$id = (int)$_GET['del_term'];
$sql = "DELETE FROM term WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: term");
}

if (isset($_GET['del_arabic_report'])) {
    $id = (int)$_GET['del_arabic_report'];
    $sql = "DELETE FROM arabic_result WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    $class = $_GET['class'];
    $term = $_GET['term'];
    $session = $_GET['session'];
    $subject = $_GET['subject'];
    header('location: arabic_result?subject='.$subject.'&class='.$class.'&term='.$term.'&session='.$session.'');
    }
    if (isset($_GET['del_arabic_keyword'])) {
        $id = (int)$_GET['del_arabic_keyword'];
        $sql = "DELETE FROM arabic_result WHERE id = '{$id}'";
        $query = mysqli_query($connect, $sql);
        header("location: arabic_results?search=".$_GET['search']."");
        }
    
if (isset($_GET['del_report'])) {
$id = (int)$_GET['del_report'];
$sql = "DELETE FROM scores WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
$class = $_GET['class'];
$term = $_GET['term'];
$week = $_GET['week'];
$session = $_GET['session'];
$subject = $_GET['subject'];
header('location: results?subject='.$subject.'&class='.$class.'&term='.$term.'&week='.$week.'&session='.$session.'');
}

if (isset($_GET['midterm_del_report'])) {
    $id = (int)$_GET['midterm_del_report'];
    $sql = "DELETE FROM mid_term_results WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    $class = $_GET['class'];
    $term = $_GET['term'];
    $week = $_GET['week'];
    $session = $_GET['session'];
    $subject = $_GET['subject'];
    header('location: midterm_results?subject='.$subject.'&class='.$class.'&term='.$term.'&week='.$week.'&session='.$session.'');
    }

if (isset($_GET['del_material'])) {
$id = $_GET['del_material'];
$select = "SELECT * FROM materials WHERE md5(id) = '{$id}'";
$d_query = mysqli_query($connect, $select);
while ($rw = mysqli_fetch_array($d_query)) {
$file = $rw['file'];

unlink("../materials/$file");
 
}
$sql = "DELETE FROM materials WHERE md5(id) = '{$id}'";
$query = mysqli_query($connect, $sql);


header("location: materials");
}
if (isset($_GET['del_report_keyword'])) {
$id = (int)$_GET['del_report_keyword'];
$sql = "DELETE FROM scores WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: results?search=".$_GET['search']."");
}

if (isset($_GET['midterm_del_report_keyword'])) {
    $id = (int)$_GET['midterm_del_report_keyword'];
    $sql = "DELETE FROM mid_term_results WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    header("location: midterm_results?search=".$_GET['search']."");
    }


if (isset($_GET['del_project'])) {
$id = (int)$_GET['del_project'];
$sql = "DELETE FROM projects WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: projects");
}

if (isset($_GET['del_submission'])) {
$id = (int)$_GET['del_submission'];
$sql = "DELETE FROM submissions WHERE id = '{$id}'";
$query = mysqli_query($connect, $sql);
header("location: submissions");
}

if (isset($_GET['del_session'])) {
    $id = $_GET['del_session'];
    $sql = "DELETE FROM session WHERE md5(id) = '{$id}'";
    $query = mysqli_query($connect, $sql);
    header("location: session");
    }
?>
<?php
if (isset($_GET['del_zero'])) {
    $class = $_GET['class'];
    $term = $_GET['term'];
    $subject = $_GET['subject'];
    $session = $_GET['session'];
    $sql = "DELETE FROM mid_term_results WHERE class = '$class' && term = '$term' && subject ='$subject' && session = '$session' && test = 0 && exam = 0";
    $query = mysqli_query($connect, $sql);
    header('location: midterm_results.php?class='.$class.'&term='.$term.'&&subject='.$subject.'&&session='.$session.'');
    }
?>

<?php
if (isset($_GET['del_assignment'])) {
    $class = $_GET['class'];
    $date = $_GET['date'];
    $id = $_GET['del_assignment'];
    $sql = "DELETE FROM assignment WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    header('location: assignment.php?class='.$class.'&date='.$date.'');
    }
?>

<?php
if (isset($_GET['del_reminder'])) {
    
    $id = $_GET['del_reminder'];
    $sql = "DELETE FROM fees_reminder WHERE id = '{$id}'";
    $query = mysqli_query($connect, $sql);
    header('location: school_fees.php');
    }
?>