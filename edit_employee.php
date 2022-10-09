<?php include "view/header.php"; ?>
<?php
if(isset($_GET['emp_num'])){

    require 'config/database.php';
    require 'models/employee.php';
    require 'models/department.php';
    require 'models/job.php';

    require 'models/job_history.php';
    require 'models/mgr_history.php';
    require 'models/salary_history.php';


    
    $db     = new Database();
    $dbcon  = $db->getConnection(); 
    
    $employee          = new Employee($dbcon); 
    $employee->emp_num = (int) $_GET['emp_num']; // 10001

    if($employee->getEmployee() <= 0){
        header('Location: ./employee.php');
        exit;
    }

    $departments        = new Department($dbcon);
    $array_departments  = $departments->getDepartments();

    $jobs               = new Job($dbcon);
    $array_jobs         = $jobs->getJobs();


    $job_history        = new JobHistory($dbcon);
    $mgr_history        = new MgrHistory($dbcon);
    $salary_history     = new SalaryHistory($dbcon);


    if(isset($_POST['emp_num'])){

        $employee->emp_num     = (int) $_POST['emp_num'];
        $employee->first_name  = $_POST['first_name'];
        $employee->last_name   = $_POST['last_name'];
        $employee->sex         = $_POST['sex'];
        $employee->dept_id     = (int) $_POST['dept_id'];
        $employee->job_code    = (int) $_POST['job_code'];  
        $employee->emp_salary  = (int) $_POST['emp_salary'];


        $job_history->emp_num          = (int) $_POST['emp_num'];
        $job_history->dept_id          = (int) $_POST['dept_id'];
        $job_history->date_assign      = date('Y-m-d H:i:s');
        $job_history->job_code         = (int) $_POST['job_code'];  
        $job_history->emp_salary       = (int) $_POST['emp_salary'];
        $job_history->employee_emp_num = (int) $_POST['emp_num'];
        $job_history->department_dept_id = (int) $_POST['dept_id'];


        $mgr_history->emp_num          = (int) $_POST['emp_num'];
        $mgr_history->dept_id          = (int) $_POST['dept_id'];
        $mgr_history->date_assign      = date('Y-m-d H:i:s');
        $mgr_history->employee_emp_num = (int) $_POST['emp_num'];

        $salary_history->emp_num           = (int) $_POST['emp_num'];
        $salary_history->salary_start_date = date('Y-m-d H:i:s');
        $salary_history->salary_amt        = (int) $_POST['emp_salary'];

           
    
        if( 
            $employee->updateEmployee() && 
            $job_history->createJobHistory() && 
            $mgr_history->createMgrHistory() && 
            $salary_history->createSalaryHistory()
        ){
            header('Location: ./view_employee.php?emp_num='.(int) $_POST['emp_num']);
            exit;
        }
        else{
            header('Location: ./edit_employee.php?emp_num='.(int) $_POST['emp_num']);
        }
    }

}
else{
    header('Location: ./employee.php');
    exit;
}

?>

<main class="container">

    <?php 
        $title_page = "Edit Employee";
        $icon_page  = '
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
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
                                <small class="text-muted"><a href="./view_history.php?emp_num=<?php echo $employee->emp_num; ?>" class="text-decoration-none">
                                    View employee history
                                    </a>
                                </small>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Employee information</h4>
                    <form class="edit-employee" action method="post">
                        <input type="hidden"  name="emp_num" value="<?php echo $employee->emp_num; ?>">

                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input type="text" class="form-control edit" id="first_name" name="first_name" data-label="First name" data-old="<?php echo $employee->first_name; ?>" value="<?php echo $employee->first_name; ?>">
                            </div>

                            <div class="col-sm-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input type="text" class="form-control edit" id="last_name" name="last_name" data-label="Last name" data-old="<?php echo $employee->last_name; ?>" value="<?php echo $employee->last_name; ?>">
                            </div>

                            <div class="col-sm-6">
                                <label for="birth_date" class="form-label">Birthdate</label>
                                <input type="text" class="form-control disabled" disabled="disabled" id="birth_date" data-label="Birthdate" data-old="<?php echo $employee->birth_date; ?>" value="<?php echo $employee->birth_date; ?>">
                            </div>

                            <div class="col-sm-6">
                                <label for="sex" class="form-label">Sex</label>
                                <input type="text" class="form-control edit" id="sex" name="sex" data-label="Sex" data-old="<?php echo $employee->sex; ?>" value="<?php echo $employee->sex; ?>">
                            </div>

                            <div class="col-sm-6">
                                <label for="date_assign" class="form-label">Date assign</label>
                                <input type="text" class="form-control disabled" disabled="disabled" id="date_assign" data-label="Date assing" data-old="<?php echo $employee->date_assign; ?>" value="<?php echo $employee->date_assign; ?>">
                            </div>

                            <div class="col-sm-6">
                                <label for="dept_name" class="form-label">Dept name</label>
                                <select class="form-select edit" id="dept_name" name="dept_id" data-label="Department" <?php if($employee->dept_id != ''){echo 'data-old="'.$employee->dept_id.'"';} else{echo 'data-old="0"';} ?>>
                                    <?php   if($employee->dept_name == ''){ ?>      
                                                <option value="0" selected>Choose...</option>
                                    <?php       foreach ($array_departments as $depts) { ?>
                                                    <option value="<?php echo $depts['dept_id']?>"><?php echo $depts['dept_name']?></option>
                                    <?php       }
                                            }
                                            else{
                                                    foreach ($array_departments as $depts) { ?>
                                                        <option 
                                                            value="<?php echo $depts['dept_id']?>"
                                                            <?php if($employee->dept_id == $depts['dept_id']){ echo ' selected ';}?>>
                                                            <?php echo $depts['dept_name']?></option>
                                    <?php           }
                                            } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="job_desc" class="form-label">Job name</label>
                                <select class="form-select edit" id="job_desc" name="job_code" data-label="Job" <?php if($employee->job_code != ''){echo 'data-old="'.$employee->job_code.'"';} else{echo 'data-old="0"';} ?>  >
                                    <?php   if($employee->job_desc == ''){ ?>      
                                                <option value="0" selected>Choose...</option>
                                    <?php       foreach ($array_jobs as $jobs) { ?>
                                                    <option value="<?php echo $jobs['job_code']?>"><?php echo $jobs['job_desc']?></option>
                                    <?php       }
                                            }
                                            else{
                                                foreach ($array_jobs as $jobs) {?>
                                                    <option 
                                                        value="<?php echo $jobs['job_code']?>"
                                                        <?php if($employee->job_code == $jobs['job_code']){ echo ' selected ';}?>>
                                                        <?php echo $jobs['job_desc']?></option>
                                    <?php       }
                                            } ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="emp_salary" class="form-label">Salary</label>
                                <input type="number" class="form-control edit" id="emp_salary" name="emp_salary" data-label="Salary" data-old="<?php echo $employee->emp_salary; ?>" value="<?php echo $employee->emp_salary; ?>">
                            </div>

                        </div>
                        <hr class="my-4">
                        <div class="d-flex gap-3">
                            <a class="w-50 btn btn-outline-secondary btn-md" href="./view_employee.php?emp_num=<?php echo $employee->emp_num;?>" type="button">Cancel</a>
                            <button class="hidden d-none" type="submit" id="save_employee">Save</button>
                            <button class="w-50 btn btn-primary btn-md" id="confirm_edit_employee" type="button" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                </svg>    
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_employee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_employeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_employeeLabel">Edited information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="body_edit_modal_employee"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn_confirm_employee">Confirm</button>
            </div>
            </div>
        </div>
    </div>
</main>
<?php include "view/footer.php" ?>