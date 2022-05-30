<?php
    // session_start();
    // require_once('../operator/UI_payroll.php');
    

class payroll_manage extends MyPayroll {

    // ------------------------------------------------- PAYROLL SAVE BTN ACTIVE ------------------------------------------------- // 
        public function active_save_payroll(){

            require_once('../php/classes/payrollClass.php');
            $pdo = $this->openConnection();  
            $search_Eid = $_POST['search_E_ID'];
        
            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
            C.dept_id, C.dept_code,
            D.position_id, D.position_desc,
            E.total_workHrs, E.d_from, E.d_to, E.days_works
            FROM tbl_employee_schedule AS A 
            LEFT JOIN employee AS B
            ON A.employee_id = B.employee_id
            LEFT JOIN department AS C
            ON A.dept_id = C.dept_id
            LEFT JOIN position AS D
            ON A.position_id = D.position_id
            LEFT JOIN schedule AS E
            ON A.employee_id = E.employee_id
            WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$search_Eid]);

            if($stmt->rowCount() > 0){
            
                foreach ($stmt as $row) {

                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    // $email = $row['email'];
                    $contact = $row['contact'];
                    // For Updating data Below Credentials    
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // For updating Credentials
                    $total_workHrs = $row['total_workHrs'];
                    $d_from = $row['d_from'];
                    $d_to = $row['d_to'];
                    $days_works = $row['days_works'];
                } 
            }   ?>

                    <div class="container container-style">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form action="../php/process.php" method="POST">
                        
                            <label>
                                <input class="input-style" type="number" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID ?>">
                                <p>E_ID</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="fname" id="fname" required readonly value="<?php echo $fname ?>">
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="lname" id="lname" required readonly value="<?php echo $lname ?>">
                                <p>Last Name</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select name="dept_id" id="dept_id" required>
                                    <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                </select>
                                <p>Employee Department</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs ?>">
                                <p>Hours Work</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="d_from" id="d_from" required readonly value="<?php echo $d_from ?>">
                                <p>Date From</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="d_to" id="d_to" required readonly value="<?php echo $d_to ?>">
                                <p>Date To</p>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works ?>">
                                <p>Days Work</p>
                            </label>
                            <br>
                            <br>

                            <label class="b1">Over Time
                                <input class="b-size" type="number" name="overtime" id="overtime" value="0" required placeholder="0">
                            </label>
                            <label class="b2">Allowance
                                <input class="b-size" type="number" name="allowance" id="allowance" value="0" required placeholder="0">
                            </label>
                            <label class="b3">Holidays Work
                                <input class="b-size" type="number" name="holidays_work" id="holidays_work" value="0" required placeholder="0">
                            </label>
                            <label class="b4">Leave Days
                                <input class="b-size" type="number" name="leave_days" id="leave_days" value="0" required placeholder="0">
                            </label>
                            <label class="b5">SSS
                                <input class="b-size" type="number" name="sss" id="sss" value="0" required placeholder="0">
                            </label>
                            <label class="b5">TAX
                                <input class="b-size" type="number" name="tax" id="tax" value="0" required placeholder="0">
                            </label>
                            <label class="b6">Pag-ibig
                                <input class="b-size" type="number" name="pag_ibig" id="pag_ibig" value="0" required placeholder="0">
                            </label>
                            <label class="b7">Phil-Health
                                <input class="b-size" type="number" name="phil_health" id="phil_health" value="0" required placeholder="0">
                            </label>
                            <label class="b8">SSS-Loan
                                <input class="b-size" type="number" name="sss_loan" id="sss_loan" value="0" required placeholder="0">
                            </label>
                            <label class="b8">TAX-Loan
                                <input class="b-size" type="number" name="tax_loan" id="tax_loan" value="0" required placeholder="0">
                            </label>
                            <label class="b9">Pag-ibig loan
                                <input class="b-size" type="number" name="pag_ibig_loan" id="pag_ibig_loan" value="0" required placeholder="0">
                            </label>
                            <label class="b10">Phil-Health Loan
                                <input class="b-size" type="number" name="phil_health_loan" id="phil_health_loan" value="0" required placeholder="0">
                            </label>
                            <label class="b11">Others
                                <input class="b11-size" type="number" name="others" id="others" value="0" required placeholder="0">
                            </label>

                            <input type="button" onclick="deductions_computation()" style="height: 25px; width: 25px;"> <br>
                            
                            <label class="b12">Deduction Total
                                <input class="b12-size" type="number" name="total_deductions" id="total_deductions" required readonly>
                            </label>

                            <button class="button save" type="submit" name="addPayroll">Save</button>
                            <button class="button" disabled>Update</button>
                            <button class="button" disabled>Delete</button>

                        </form>

                        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                        <div class="output">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <!-- <th>Email</th> -->
                                        <th>Contact</th>
                                        <th>Emp Dept</th>
                                        <th>Hrs_Wrks</th>
                                        <th>D_Frm</th>
                                        <th>D_To</th>
                                        <th>Total_wrkHrs</th>
                                        <th>O.T</th>
                                        <th>Allwnce</th>
                                        <th>Hlldy_wrk</th>
                                        <th>Lv.Dy</th>
                                        <th>Deductions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // $pdo = $classPayroll->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                                    C.dept_id, C.dept_code,
                                    E.total_workHrs, E.d_from, E.d_to, E.days_works,
                                    F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                    F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
                                    FROM tbl_employee_payroll AS A
                                    LEFT JOIN employee AS B
                                    ON A.employee_id = B.employee_id
                                    LEFT JOIN department AS C
                                    ON A.dept_id = C.dept_id
                                    LEFT JOIN schedule AS E
                                    ON A.employee_id = E.employee_id
                                    LEFT JOIN payroll AS F
                                    ON A.employee_id = F.employee_id
                                    WHERE B.isActive = 1 AND A.id > 0";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();


                                    if ($stmt->rowCount() > 0) {
                                        while ($row = $stmt->fetch()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['employee_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <!-- <td><?php // echo $row['email']; ?></td> -->
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['dept_code']; ?></td>
                                            <td><?php echo $row['total_workHrs']; ?></td>
                                            <td><?php echo $row['d_from']; ?></td>
                                            <td><?php echo $row['d_to']; ?></td>
                                            <td><?php echo $row['days_works']; ?></td>
                                            <td><?php echo $row['overtime']; ?></td>
                                            <td><?php echo $row['allowance']; ?></td>
                                            <td><?php echo $row['holidays_work']; ?></td>
                                            <td><?php echo $row['leave_days']; ?></td>
                                            <td><?php echo $row['total_deduction']; ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                <script>

                    function deductions_computation(){
                        var sss = parseInt($("#sss").val());
                        var tax = parseInt($("#tax").val());
                        var pag_ibig = parseInt($("#pag_ibig").val());
                        var phil_health = parseInt($("#phil_health").val());
                        var sss_loan = parseInt($("#sss_loan").val());
                        var tax_loan = parseInt($("#tax_loan").val());
                        var pag_ibig_loan = parseInt($("#pag_ibig_loan").val());
                        var phil_health_loan = parseInt($("#phil_health_loan").val());
                        var others = parseInt($("#others").val());

                        var total_deductions = sss + tax + pag_ibig + phil_health + sss_loan + tax_loan + pag_ibig_loan + phil_health_loan + others;

                        $("#total_deductions").val(total_deductions);
                    }

                </script>

            <?php
        }

    // ------------------------------------------------- PAYROLL UPDATE BTN ACTIVE ------------------------------------------------- // 

        public function active_update_payroll(){

            require_once('../php/classes/payrollClass.php');
            $pdo = $this->openConnection(); 
            $search_EID = $_POST['search_E_ID'];

            $sql = "SELECT
            A.id,
            B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
            C.dept_id, C.dept_code,
            E.total_workHrs, E.d_from, E.d_to, E.days_works,
            F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
            F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
            FROM tbl_employee_payroll AS A
            LEFT JOIN employee AS B
            ON A.employee_id = B.employee_id
            LEFT JOIN department AS C
            ON A.dept_id = C.dept_id
            LEFT JOIN schedule AS E
            ON A.employee_id = E.employee_id
            LEFT JOIN payroll AS F
            ON A.employee_id = F.employee_id
            WHERE B.employee_id = ? AND B.isActive = 1 AND A.id > 0";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$search_EID]);

            // echo "Success Search";

            if($stmt->rowCount() > 0)
            {
                while($row = $stmt->fetch()){
                    $E_ID = $row['employee_id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    // $email = $row['email'];
                    $contact = $row['contact'];
                    $dept_id = $row['dept_id'];
                    $dept_code = $row['dept_code'];
                    // $position_id = $row['position_id'];
                    // $position_desc = $row['position_desc'];
                    $total_workHrs = $row['total_workHrs'];
                    $d_from = $row['d_from'];
                    $d_to = $row['d_to'];
                    $days_works = $row['days_works'];
                    // for update credential
                    $overtime = $row['overtime'];
                    $allowance = $row['allowance'];
                    $holidays_work = $row['holidays_work'];
                    $leave_days = $row['leave_days'];
                    // Deductions Below
                    $sss = $row['sss'];
                    $tax = $row['tax'];
                    $pag_ibig = $row['pag_ibig'];
                    $phil_health = $row['phil_health'];
                    $sss_loan = $row['sss_loan'];
                    $tax_loan = $row['tax_loan'];
                    $pag_ibig_loan = $row['pag_ibig_loan'];
                    $phil_health_loan = $row['phil_health_loan'];
                    $ohters = $row['others'];
                    $total_deduction = $row['total_deduction'];
                }

            }  ?>

                    <div class="container container-style">
                        <form action="UI_payroll.php" method="post">
                            <!-- form search-->
                            <div class="search-bg">
                                <div class="search">
                                    <input class="input-style search-style" placeholder="Search Employee ID" type="number" name="search_E_ID" id="search_E_ID">
                                    <button type="submit" name="search" id="search_e"><i class='bx bx-search bx-margin'></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- form -->
                        <form action="../php/process.php" method="POST">
                        
                            <label>
                                <input class="input-style" type="text" name="E_ID" id="E_ID" required readonly value="<?php echo $E_ID ?>">
                                <p>E_ID</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="fname" id="fname" required readonly value="<?php echo $fname ?>">
                                <p>First Name</p>
                            </label>
                            <label>
                                <input class="input-style" type="text" name="lname" id="lname" required readonly value="<?php echo $lname ?>">
                                <p>Last Name</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="contact" id="contact" required readonly value="<?php echo $contact ?>">
                                <p>Contact</p>
                            </label>
                            <label>
                                <select name="dept_id" id="dept_id" required>
                                    <option selected hidden value="<?php echo $dept_id ?>"><?php echo $dept_code ?></option>
                                </select>
                                <p>Employee Department</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="number" name="hours_work" id="hours_work" required readonly value="<?php echo $total_workHrs ?>">
                                <p>Hours Work</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly value="<?php echo $d_from ?>">
                                <p>Date From</p>
                            </label>
                            <label>
                                <input class="input-style removearrow" type="date" name="hours_work" id="hours_work" required readonly value="<?php echo $d_to ?>">
                                <p>Date To</p>
                            </label>
                            <label>
                                <input class="input-style" type="number" name="days_work" id="days_work" required readonly value="<?php echo $days_works ?>">
                                <p>Days Work</p>
                            </label>
                            <br>
                            <br>

                            <label class="b1">Over Time
                                <input class="b-size" type="number" name="overtime" id="overtime" required placeholder="0" value="<?php echo $overtime ?>">
                            </label>
                            <label class="b2">Allowance
                                <input class="b-size" type="number" name="allowance" id="allowance" required placeholder="0" value="<?php echo $allowance ?>">
                            </label>
                            <label class="b3">Holidays Work
                                <input class="b-size" type="number" name="holidays_work" id="holidays_work" required placeholder="0" value="<?php echo $holidays_work ?>">
                            </label>
                            <label class="b4">Leave Days
                                <input class="b-size" type="number" name="leave_days" id="leave_days" required placeholder="0" value="<?php echo $leave_days ?>">
                            </label>
                            <label class="b5">SSS
                                <input class="b-size" type="number" name="sss" id="sss" required placeholder="0" value="<?php echo $sss ?>">
                            </label>
                            <label class="b5">TAX
                                <input class="b-size" type="number" name="tax" id="tax" required placeholder="0" value="<?php echo $tax ?>">
                            </label>
                            <label class="b6">Pag-ibig
                                <input class="b-size" type="number" name="pag_ibig" id="pag_ibig" required placeholder="0" value="<?php echo $pag_ibig ?>">
                            </label>
                            <label class="b7">Phil-Health
                                <input class="b-size" type="number" name="phil_health" id="phil_health" required placeholder="0" value="<?php echo $phil_health ?>">
                            </label>
                            <label class="b8">SSS-Loan
                                <input class="b-size" type="number" name="sss_loan" id="sss_loan" required placeholder="0" value="<?php echo $sss_loan ?>">
                            </label>
                            <label class="b8">TAX-Loan
                                <input class="b-size" type="number" name="tax_loan" id="tax_loan" required placeholder="0" value="<?php echo $tax_loan ?>">
                            </label>
                            <label class="b9">Pag-ibig loan
                                <input class="b-size" type="number" name="pag_ibig_loan" id="pag_ibig_loan" required placeholder="0" value="<?php echo $pag_ibig_loan ?>">
                            </label>
                            <label class="b10">Phil-Health Loan
                                <input class="b-size" type="number" name="phil_health_loan" id="phil_health_loan" required placeholder="0" value="<?php echo $phil_health_loan ?>">
                            </label>
                            <label class="b11">Others
                                <input class="b11-size" type="Text" name="others" id="others" required placeholder="0" value="<?php echo $ohters ?>">
                            </label>

                            <input type="button" onclick="deductions_computation()" style="height: 25px; width: 25px;"> <br>

                            <label class="b12">Deduction Total
                                <input class="b12-size" type="number" name="total_deductions" id="total_deductions" required value="<?php echo $total_deduction ?>">
                            </label>

                            <button class="button" disabled>Save</button>
                            <button class="button" type="submit" name="updatePayroll">Update</button>
                            <button class="button" disabled>Delete</button>

                        </form>

                        <!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->
                        <div class="output">
                            <table class="table table-dark table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <!-- <th>Email</th> -->
                                        <th>Contact</th>
                                        <th>Emp Dept</th>
                                        <th>Hrs_Wrks</th>
                                        <th>D_Frm</th>
                                        <th>D_To</th>
                                        <th>Total_wrkHrs</th>
                                        <th>O.T</th>
                                        <th>Allwnce</th>
                                        <th>Hlldy_wrk</th>
                                        <th>Lv.Dy</th>
                                        <th>Deductions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // $pdo = $this->openConnection();
                                    $sql = "SELECT
                                    A.id,
                                    B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact,
                                    C.dept_id, C.dept_code,
                                    E.total_workHrs, E.d_from, E.d_to, E.days_works,
                                    F.overtime, F.allowance, F.holidays_work, F.leave_days, F.sss, F.tax, F.pag_ibig, F.phil_health,
                                    F.sss_loan, F.tax_loan, F.pag_ibig_loan, F.phil_health_loan, F.others, F.total_deduction
                                    FROM tbl_employee_payroll AS A
                                    LEFT JOIN employee AS B
                                    ON A.employee_id = B.employee_id
                                    LEFT JOIN department AS C
                                    ON A.dept_id = C.dept_id
                                    LEFT JOIN schedule AS E
                                    ON A.employee_id = E.employee_id
                                    LEFT JOIN payroll AS F
                                    ON A.employee_id = F.employee_id
                                    WHERE B.isActive = 1 AND A.id > 0";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                        foreach($stmt as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['employee_id']; ?></td>
                                            <td><?php echo $row['first_name']; ?></td>
                                            <td><?php echo $row['last_name']; ?></td>
                                            <!-- <td><?php // echo $row['email']; ?></td> -->
                                            <td><?php echo $row['contact']; ?></td>
                                            <td><?php echo $row['dept_code']; ?></td>
                                            <td><?php echo $row['total_workHrs']; ?></td>
                                            <td><?php echo $row['d_from']; ?></td>
                                            <td><?php echo $row['d_to']; ?></td>
                                            <td><?php echo $row['days_works']; ?></td>
                                            <td><?php echo $row['overtime']; ?></td>
                                            <td><?php echo $row['allowance']; ?></td>
                                            <td><?php echo $row['holidays_work']; ?></td>
                                            <td><?php echo $row['leave_days']; ?></td>
                                            <td><?php echo $row['total_deduction']; ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>

                    function deductions_computation(){
                        var sss = parseInt($("#sss").val());
                        var tax = parseInt($("#tax").val());
                        var pag_ibig = parseInt($("#pag_ibig").val());
                        var phil_health = parseInt($("#phil_health").val());
                        var sss_loan = parseInt($("#sss_loan").val());
                        var tax_loan = parseInt($("#tax_loan").val());
                        var pag_ibig_loan = parseInt($("#pag_ibig_loan").val());
                        var phil_health_loan = parseInt($("#phil_health_loan").val());
                        var others = parseInt($("#others").val());

                        var total_deductions = sss + tax + pag_ibig + phil_health + sss_loan + tax_loan + pag_ibig_loan + phil_health_loan + others;

                        $("#total_deductions").val(total_deductions);
                    }

                </script>
            <?php
        }

    }

    $payroll_manage_class = new payroll_manage();



?>