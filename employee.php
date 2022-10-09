<?php include "view/header.php"; ?>
<?php

$notfound = 0; 
if(isset($_POST['emp_num'])){

    require 'config/database.php';
    require 'models/employee.php';
    
    $db     = new Database();
    $dbcon  = $db->getConnection(); 
    
    $employee          = new Employee($dbcon); 
    $employee->emp_num = (int) $_POST['emp_num']; // 10001

    if($employee->getEmployee() > 0){
        header('Location: ./view_employee.php?emp_num='.$employee->emp_num);
        exit;
    }
    else{
        $notfound= 1;
        $employee->emp_num=null ;
        header('Location: employee.php?emp_num=null'.$employee->emp_num . '&notfound='.$notfound);
    }
}

?>

<main class="container">

    <?php 
        $title_page = "View/Update Employee";
        $icon_page  = '
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
        </svg>';  
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Enter an employee number</h6>
        <div class="d-flex text-muted pt-3">
            <p class="pb-3 mb-0 small lh-sm">
            If they don't know the employee number <br>
            they should go to the employee search page.
            </p>
        </div>
        <div class="d-flex text-muted pt-3">
            <form class="row g-3" action="" method="post">
                <div class="col-auto" style="width: 310px;">
                    <label for="inputNumberEmployee" class="visually-hidden">Number employee</label>
                    <input type="number" class="form-control col-sm-4" id="emp_num" name="emp_num" placeholder="......" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Search</button>
                </div>
            </form>
        </div>
        <?php if(isset($_GET['notfound']) >0){ ?>
            <div class="d-flex">
                <div class="alert alert-danger alert-dismissible fade show m-1" role="alert">
                    <?php echo "Employee number is not valid"; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <small class="d-block text-end mt-3">
            <a href="./search_employee.php">Search Page</a>
        </small>
    </div>
</main>
<?php include "view/footer.php" ?>