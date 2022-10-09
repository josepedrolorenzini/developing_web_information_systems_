<?php include "view/header.php"; ?>
<?php
require 'config/database.php';
require 'models/employee.php';
require 'models/department.php';
require 'models/job_history.php';

$db = new Database();
$dbcon = $db->getConnection();

//manager object
$departament = new Department($dbcon);
$all = $departament->getDepartmentandmanager();

//history objects
$history2 = new JobHistory($dbcon);
$historyall = $history2->getJobHistory();

//employee objects
$employee = new Employee($dbcon);
$allEmployesDepart = $employee->getEmployeeDept();
$oneemployee = $employee->getOneEmployees();



?>

<main class="container">
    <?php 
        $title_page = "Department information";
        $icon_page  = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
        <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
      </svg>';      
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="container-fluid">
        <form class="form-inline my-2 my-lg-0" method="POST" action="department_information.php">
        <div class="form-group">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="searchbar">
        </div>
        <div class="col-12 padding16">
      <button class="btn btn-primary" type="submit" name="searchSubmit">Search</button>
        </div>
    </form>
    </form>
        </div>
    </div>
    <?php
 
    
   // $history->emp_num = (int) $_GET['emp_num'];
    // foreach ($all as $alldept) {
    //   echo  $alldept['dept_name'];
    // }
    
    ?>
<?php

if(isset($_POST['searchSubmit'])):
    echo "stay away from here";
    //$departament->emp_num = (int) $_POST['emp_num']; 
else: ?>
<?php ?> 
<div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="d-flex text-muted pt-3">
            <table class="table caption-top">
            <caption>Managers</caption>
                <thead>
                    <tr>
                    <th scope="col">Dept id</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Department name</th>
                    <th scope="col">Employee number</th>
                    <th scope="col">Date Assign</th>
                    <th scope="col">View history</th>
                    <th scope="col">Employee search</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all as $alldept) {
                    ?>
                       <tr>
                            <td><?php echo $alldept['dept_id'];?></td>
                            <td><?php echo $alldept['first_name'];?></td>
                            <td><?php echo $alldept['last_name'];?></td>
                            <td><?php echo $alldept['dept_name'];?></td>
                            <td><?php echo $alldept['emp_num'];?></td>
                            <td><?php echo $alldept['date_assign'];?></td>
                            <td scope="col"><a href="view_history.php?emp_num=<?php echo $alldept['emp_num'] ; ?>">View History</a></td>
                            <td scope="col"><a href="search_employee.php">Employee Search</a></td>
                        </tr>      
                    <?php
                        }
                    ?>
                    
                </tbody>
            </table>


        </div>
        
        <div class="row"> 
     <p>Department History</p>   
    <form action="department_information.php" method="post">
    <select class="form-select" name="employeSelect" required>
    <option value="" disabled selected hidden>Employee</option>
    <?php
    foreach ($allEmployesDepart  as $value) { ?>
     <option value="<?php echo $value['emp_num']; ?>"><?php echo $value['first_name'] ?></option>
    <?php } ?>
    </select>
    <div class="col-12 padding16">
    <button class="btn btn-primary" type="submit" name="submit">submit</button>
    </div>
     </form>  
        </div>
    </div>


 <?php



      if(isset($_POST['submit'])){
        if(!empty($_POST['employeSelect'])) {
          $selected = $_POST['employeSelect'];
          echo 'You have chosen: ' . $selected;
        } else {
          echo 'Please select the value.';
        }
      }
   
    // if(isset($_POST['submit'])){
    //   if(!empty($_POST['employeSelect'])) {
    //     $employeSelected = $_POST['employeSelect'];
    //     echo 'You have chosen: ' . $employeSelected . "<br>";
    //     //  foreach ($oneemployee as $employee) {
    //     //     if($employeSelected == $employee['emp_num']){
    //     //         echo $employee['emp_num'] . " " . $employee['first_name']  . "<br>";
    //     //      }
           
    //     // } 
    //   } else {
    //     echo 'Please select the value.';
    //   }
    // }
  ?>
          
<?php
endif;
?>
</main>

<?php include "view/footer.php"; ?>