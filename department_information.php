<?php include "view/header.php"; ?>
<?php
  require 'config/database.php';
  require 'models/department.php';
  require 'models/mgr_history.php';

  $db = new Database();
  $dbcon = $db->getConnection();

  //manager object
  $departament = new Department($dbcon);
  $departments = $departament->getDepartmentsWithManager();

  $mgr_history = new MgrHistory($dbcon);

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
    <div class="text-muted pt-3">
      <ul class="list-group list-group-flush row mx-2">
        <li class="list-group-item container d-flex">
          <div class="col-md-1 text-start fw-bold">Dept id</div>
          <div class="col-md-3 fw-bold">Department name</div>
          <div class="col-md-3 fw-bold">Manager</div>
          <div class="col-md-2 text-center fw-bold">Quantity employees</div>
          <div class="col-md-2 text-center fw-bold"></div>
          <div class="col-md-1 text-center fw-bold"></div>
        </li>
        <?php foreach ($departments as $dept) { ?>
          <li class="list-group-item container d-flex">
            <div class="col-md-1 text-start"><?php echo $dept['dept_id'];?></div>
            <div class="col-md-3"><?php echo $dept['dept_name'];?></div>
            <div class="col-md-3"><a target="_blank" href="./view_employee.php?emp_num=<?php echo $dept['emp_num'] ; ?>"><?php echo $dept['first_name'].' '.$dept['last_name'];?></a></div>
            <div class="col-md-2 text-center">
              <?php 
                $departament->join_dept_id = $dept['dept_id'];
                echo $departament->getQuantityEmployeeForDeparment();
              ?>
            </div>
            <div class="col-md-2 text-center"><a target="_blank" href="./search_employee.php?dept_id=<?php echo $dept['dept_id'] ; ?>">List employees</a></div>
            <div class="col-md-1 text-end">
              <a data-bs-toggle="collapse" href="#collapse<?php echo $dept['dept_id'];?>" role="button" aria-expanded="false" >
                History
              </a>
            </div>
          </li>
          <li class="list-group-item collapse" id="collapse<?php echo $dept['dept_id'];?>">
          <?php 
                $mgr_history->join_dept_id = $dept['dept_id'];
                $mgr_histories = $mgr_history->getMgrHistory();
          ?>
            <table class="table my-4 border">
              <thead>
                <tr>
                  <th scope="col">Date assign</th>
                  <th scope="col">Department</th>
                  <th scope="col">Fisrt name</th>
                  <th scope="col">Last name</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($mgr_histories as $mgr) { ?>
                  <tr>
                    <td>
                      <?php echo $mgr['date_assign'];?>
                    </td>
                    <td>
                      <?php echo $mgr['dept_name'];?>
                    </td>
                    <td>
                      <?php echo $mgr['first_name'];?>                   
                    </td>
                    <td>
                      <?php echo $mgr['last_name'];?>                   
                    </td>
                  </tr>
                  <?php  }?>
              </tbody>
            </table>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>      
</main>

<?php include "view/footer.php"; ?>