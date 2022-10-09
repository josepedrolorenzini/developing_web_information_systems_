<?php include "view/header.php"; ?>
<?php
if(isset($_GET['emp_num'])){

    require 'config/database.php';
    require 'models/employee.php';
    
    $db     = new Database();
    $dbcon  = $db->getConnection(); 
    
    $employee          = new Employee($dbcon); 
    $employee->emp_num = (int) $_GET['emp_num']; // 10001

    if($employee->getEmployee() <= 0){
        header('Location: ./employee.php');
        exit;
    }
}
else{
    header('Location: ./employee.php');
    exit;
}
?>

<main class="container">

    <?php 
        $title_page = "View Employee";
        $icon_page  = '
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        </svg>';    
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="d-flex text-muted pt-3">
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text">Employee number</span>
                        <span class="badge bg-primary rounded-pill"><?php echo $employee->emp_num; ?></span>
                    </h4>
                    <ul class="list-group mb-3 pt-4">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Employee History</h6>
                                <small class="text-muted"><a href="./view_history_employee.php?emp_num=<?php echo $employee->emp_num; ?>" class="text-decoration-none">
                                    View employee history
                                    </a>
                                </small>
                            </div>
                        </li>
                    </ul>

                    <div class="input-group">
                        <a type="button" class="btn btn-primary w-100" href="./edit_employee.php?emp_num=<?php echo $employee->emp_num; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                            </svg>
                                            Edit employee
                        </a>
                    </div>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Employee information</h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row g-3">
                            <?php if($employee->first_name != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="first_name" class="form-label">First name</label>
                                    <label for="first_name" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->first_name; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->last_name != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <label for="last_name" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->last_name; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->birth_date != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="birth_date" class="form-label">Birthdate</label>
                                    <label for="birth_date" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->birth_date; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->sex != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="sex" class="form-label">Sex</label>
                                    <label for="sex" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->sex; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->date_assign != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="date_assign" class="form-label">Date assign</label>
                                    <label for="date_assign" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->date_assign; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->dept_name != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="dept_name" class="form-label">Dept name</label>
                                    <label for="dept_name" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->dept_name; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->job_desc != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="job_desc" class="form-label">Job</label>
                                    <label for="job_desc" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->job_desc; ?></label>
                                </div>
                            <?php } ?>

                            <?php if($employee->emp_salary != ''){ ?>
                                <div class="col-sm-6">
                                    <label for="emp_salary" class="form-label">Salary</label>
                                    <label for="emp_salary" class="form-control" style="border: 1px solid #e7e8ea;"><?php echo $employee->emp_salary; ?></label>
                                </div>
                            <?php } ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "view/footer.php" ?>