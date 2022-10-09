<?php include "view/header.php"; ?>
<?php  
if(isset($_GET['emp_num'])){

    require 'config/database.php';
    require 'models/employee.php';
    require 'models/job_history.php';

    $db     = new Database();
    $dbcon  = $db->getConnection(); 

    $employee          = new Employee($dbcon); 
    $employee->emp_num = (int) $_GET['emp_num']; // 10001
    $employee->getEmployee();
    
    $history          = new JobHistory($dbcon); 
    $history->emp_num = (int) $_GET['emp_num']; // 10001
    $all_history      = $history->getJobHistory();

    if( count($all_history)<= 0){
        header('Location: ./history.php');
        exit;
    }

}
else{
    header('Location: ./history.php');
    exit;
}

?>

<main class="container">
    <?php 
        $title_page = "History Employee";
        $icon_page  = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
        <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z"/>
      </svg>';      
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">History employee : <?php echo $employee->emp_num; ?></h6>
        <div class="d-flex text-muted pt-3">
            <p class="pb-3 mb-0 small lh-sm">
                <strong class="d-block text-gray-dark"> Employee : <?php echo $employee->first_name.' '.$employee->last_name ; ?></strong>
                add information empployee
            </p>
        </div>
    </div>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="d-flex text-muted pt-3">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Employee Number</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Date Assign</th>
                        <th scope="col">Job Position</th>
                        <th scope="col">Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_history as $value) {
                    ?>
                       <tr>
                            <th scope="row"><?php echo $value['emp_num'];?></th>
                            <td><?php echo $value['first_name'];?></td>
                            <td><?php echo $value['last_name'];?></td>
                            <td><?php echo $value['dept_name'];?></td>
                            <td><?php echo $value['date_assign'];?></td>
                            <td><?php echo $value['job_desc'];?></td>
                            <td><?php echo $value['emp_salary'];?></td>
                        </tr>      
                    <?php
                        }
                    ?>
                    
                </tbody>
            </table>


        </div>
    </div>
</main>

<?php include "view/footer.php"; ?>