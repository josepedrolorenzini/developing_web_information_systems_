<?php include "view/header.php"; ?>
<?php


    require 'config/database.php';
    require 'models/employee.php';
    require 'models/department.php';

    $db     = new Database();
    $dbcon  = $db->getConnection(); 

    $departments        = new Department($dbcon);
    $array_departments  = $departments->getDepartments();


    $employee  = new Employee($dbcon); 

    if(isset($_POST['inital_search']) || isset($_GET['dept_id'])){

        if(isset($_POST['name_search']) && $_POST['name_search']  != ''){
            $employee->name_search = $_POST['name_search'];
        }
        if(isset($_POST['job_search']) && $_POST['job_search'] != ''){
            $employee->job_search = $_POST['job_search'];
        }

        if(isset($_POST['department_search'])){
            $department_search = implode(',',$_POST['department_search']);

            if($department_search != ''){
                $employee->department_search = $department_search;
            }
        }


        if(isset($_GET['dept_id'])!= ''){
            $employee->department_search = $_GET['dept_id'];
        }

    }

    $employees = $employee->searchEmployees();
     
?>

<main class="container">
    <?php 
        $title_page = "Seach Employee";
        $icon_page  = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
        <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
      </svg>';      
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="text-muted">
            <form class="row" method="post">
                <input type="hidden" name="inital_search">
                <div class="col-md-6 pt-3">
                    <label class="form-label">Name employee</label>
                    <input type="text" class="form-control" name="name_search">
                </div>
                <div class="col-md-6 pt-3">
                    <label class="form-label">Job</label>
                    <input type="text" class="form-control" name="job_search">
                </div>
                <div class="col-md-6 pt-3">   
                    <label class="form-label">Department</label>      
                        <?php   foreach ($array_departments as $depts) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $depts['dept_id']?>" name="department_search[]" <?php if(isset($_GET['dept_id']) && $_GET['dept_id'] == $depts['dept_id']){ echo 'checked';}?>>
                                            <label class="form-check-label">
                                                <?php echo $depts['dept_name']?></option>
                                            </label>
                                        </div>
                        <?php   }?>
                </div>

                <div class="col-md-6 pt-3 row align-items-end">
                    <button type="submit" class="btn btn-primary col-md-2 m-2">Submit</button>
                </div>
            </form>
        </div>
        <div class="d-flex text-muted pt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Employee number</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Job</th>
                        <th scope="col">Department</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                        <th scope="col">History</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($employees as $emp) {
                    ?>
                       <tr>
                            <th scope="row"><?php echo $emp['emp_num'];?></th>
                            <td><?php echo $emp['first_name'];?></td>
                            <td><?php echo $emp['last_name'];?></td>
                            <td><?php echo $emp['job_desc'];?></td>
                            <td><?php echo $emp['dept_name'];?></td>
                            <td><a href="./view_employee.php?emp_num=<?php echo $emp['emp_num'];?>" target="_blank">View</a></td>
                            <td><a href="./edit_employee.php?emp_num=<?php echo $emp['emp_num'];?>" target="_blank">Edit</a></td>
                            <td><a href="./view_history.php?emp_num=<?php echo $emp['emp_num'];?>" target="_blank">History</a></td>
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