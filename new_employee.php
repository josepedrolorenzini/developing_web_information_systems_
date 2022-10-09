<?php include "view/header.php"; ?>
<?php
    require 'config/database.php';
    require 'models/employee.php';
    require 'models/department.php';
    require 'models/job.php';

    $db     = new Database();
    $dbcon  = $db->getConnection(); 

    $departments        = new Department($dbcon);
    $array_departments  = $departments->getDepartments();

    $jobs               = new Job($dbcon);
    $array_jobs         = $jobs->getJobs();

    if(isset($_POST['emp_num'])){

        $employee              = new Employee($dbcon);

        $employee->first_name  = $_POST['first_name'];
        $employee->last_name   = $_POST['last_name'];
        $employee->birth_date  = $_POST['birth_date'];
        $employee->sex         = $_POST['sex'];
        $employee->dept_id     = (int) $_POST['dept_id'];
        $employee->job_code    = (int) $_POST['job_code']; 
        $employee->date_assign = date('Y-m-d H:i:s');
        $employee->department_dept_id    = 0;  
        $employee->emp_salary  = (int) $_POST['emp_salary'];

        if($employee->createEmployee()){
            header('Location: ./search_employee.php');
            // exit;
        }
        else{
            header('Location: ./new_employee.php');
        }
    }
?>

<main class="container">

    <?php 
        $title_page = "New Employee";
        $icon_page  = '
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
        </svg>';      
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <div class="d-flex text-muted pt-3">
            <div class="row g-5">
                
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Employee information</h4>
                    <form class="new-employee needs-validation" action method="post" >
                        <input type="hidden"  name="emp_num" value="1">

                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label for="first_name" class="form-label">First name</label>
                                <input required type="text" class="form-control new" id="first_name" name="first_name" value="">
                            </div>

                            <div class="col-sm-6">
                                <label for="last_name" class="form-label">Last name</label>
                                <input required type="text" class="form-control new" id="last_name" name="last_name" value="">
                            </div>

                            <div class="col-sm-6">
                                <label for="birth_date" class="form-label">Birthdate</label>
                                <input required type="date" class="form-control new" id="birth_date" name="birth_date" value="">
                            </div>

                            <div class="col-sm-6">
                                <label for="sex" class="form-label">Sex</label>
                                <input required type="text" class="form-control new" id="sex" name="sex">
                            </div>

                            <div class="col-sm-6">
                                <label for="dept_name" class="form-label">Dept name</label>
                                <select class="form-select new" required name="dept_id">
                                    <?php   if($employee->dept_name == ''){ ?>      
                                                <option value="" disabled selected >Choose...</option>
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
                                <select required class="form-select new" id="job_desc" name="job_code">
                                    <?php   if($employee->job_desc == ''){ ?>      
                                                <option value="" disabled selected>Choose...</option>
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
                                <input required type="number" class="form-control new" id="emp_salary" name="emp_salary" value="">
                            </div>

                        </div>

                        <div class="input-group pt-5">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg> Add
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</main>
<?php include "view/footer.php" ?>