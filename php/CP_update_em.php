<?php
    require_once ('classes/payrollClass.php');

        if(isset($_POST['editEmployee'])){
            $classPayroll->update_employee_module();
                header("Location: ../operator/UI_addEmployee.php");
        } elseif(isset($_POST['deleteEmployee'])){
            $classPayroll->delete_employee_module();
                 header("Location: ../operator/UI_addEmployee.php");
        }

?>