<?php
// require 'config/database.php';
// require 'models/employee.php';

// $db     = new Database();
// $dbcon  = $db->getConnection(); 

// $employee = new Employee($dbcon); 


// $res =  $employee->getEmployees(); 
// echo json_encode($res); 
?>

<?php include "view/header.php"; ?>
<main class="container">

    <?php 
        $title_page = "Home";
        $icon_page  = '
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-in-up-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z"/>
            <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z"/>
        </svg>';    
    ?>
    <?php include "view/content.php" ?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Welcome user</h6>
        <div class="d-flex text-muted pt-3">
            <p class="pb-3 mb-0 small lh-sm">
                <strong class="d-block text-gray-dark"> how to use the website </strong>
                Here in a small summary of how to use the website.<br> 
                We will add constant information of each change or additional additions on the website.
            </p>
        </div>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Group members</h6>
        <div class="d-flex text-muted pt-3">
            <div class="me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#007bff" class="bi bi-1-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z"/>
                </svg>
            </div>
            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Jose Lorenzini</strong>
                    <a href="#">Follow</a>
                </div>
                <span class="d-block">Web developer</span>
            </div>
        </div>
        <div class="d-flex text-muted pt-3">
            <div class="me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#007bff" class="bi bi-2-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24c0-.691.493-1.306 1.336-1.306.756 0 1.313.492 1.313 1.236 0 .697-.469 1.23-.902 1.705l-2.971 3.293V12h5.344v-1.107H7.268v-.077l1.974-2.22.096-.107c.688-.763 1.287-1.428 1.287-2.43 0-1.266-1.031-2.215-2.613-2.215-1.758 0-2.637 1.19-2.637 2.402v.065h1.271v-.07Z"/>
                </svg>
            </div>

            <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">Pedro Arancibia</strong>
                    <a href="#">Follow</a>
                </div>
                <span class="d-block">BackEnd</span>
            </div>
        </div>
    </div>

</main>
<?php include "view/footer.php" ?>