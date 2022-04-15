<?php
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();

    if(isset($_POST['search_d1'])){
        $search_Eid = $_POST['search_E_ID'];

        $sql = "SELECT * FROM employee WHERE employee_id = ? AND isActive = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search_Eid]);
        
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $E_ID = $row['employee_id'];
                $fname = $row['first_name'];
                $lname = $row['last_name'];
                $email = $row['email'];
                $contact = $row['contact'];
            }
        }
    }
        
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Set Department | Symtech</title>
    </head>

    <style>
        body {
            background-color: #6C6169;
        }

        form {
            text-align: center;
            margin-top: 5px;       
        }

        label, input , textarea, select{
            margin-top: 10px;
        }

        button {
            margin-top: 8px;
        }

        table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, tr, th, td{
            border:1px solid black;
        }

        th, td{
            padding: 10px 20px;
        }
    </style>

    <body>
            <form action="" method="post">
                <div>
                    <label>Search For Employee E_ID:</label>
                    <input type="number" name="search_E_ID" id="search_E_ID" >
                    <button type="submit" name="search_d1" id="search_d1">-></button>
                </div>
            </form>


        <form action="" method="post">

                <label>E_ID:</label>
                <input type="number" name="E_ID" id="E_ID" value="<?php echo $E_ID ?>"><br>
                <label>First Name:</label>
                <input type="text" name="fname" id="fname" value="<?php echo $fname ?>"><br>
                <label>Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?php echo $lname ?>"><br>
                <label>Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>"><br>
                <label>Contact:</label>
                <input type="number" name="contact" id="contact" value="<?php echo $contact ?>"><br>
                <label>Employee Dept:</label>
                <select name="dept_id" id="dept_id" required>
                    <option selected disabled value="">- Select -</option>
                    <option value="1">BSIT</option>
                    <option value="2">BSOA</option>
                    <option value="3">BSED</option>
                    <option value="4">BEED</option>
                    <option value="5">BSCRIM</option>
                    <option value="6">BSTM</option>
                </select> <br>
                <!-- <input list="dept1" name="dept" id="dept">
                <datalist id="dept1">
                    <option value="BSIT">
                    <option value="BSOA">
                    <option value="BSED">
                    <option value="BEED">
                    <option value="BSCRIM">
                    <option value="BSTM">
                </datalist> <br> -->
                <label>Position:</label>
                <select name="position_id" id="position_id" required>
                    <option selected disabled value="">- Select -</option>
                    <option value="1">Dept. Head</option>
                    <option value="2">Teacher</option>
                    <option value="3">Office Staff</option>
                    <option value="4">Secretary</option>
                    <option value="5">Utility</option>
                </select><br>

                <button type="submit" name="setDepartment">Save</button>
                <button type="submit" name="updateDept" id="updateDept">Update</button>
                <!-- <button type="submit" name="deleteDept" id="deleteDept">Delete</button> -->

        </form>

        <?php                
            
            if(isset($_POST['setDepartment'])){
                $E_ID = $_POST['E_ID'];
                $dept_ID = $_POST['dept_id'];
                $position_ID = $_POST['position_id'];

                $sql = "INSERT INTO tbl_employee_department_position (employee_id, dept_id,position_id)
                 VALUES (?,?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$E_ID, $dept_ID, $position_ID]);

                echo "Successfully Submitted!";
            }
    
        ?>

            <br><br>   <hr>   <br><br>      

<!------------------------------------------ TABLE BELOW IS FOR SHOWING DATA FROM DATABASE ---------------------------------------->

       
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Department</th>
                        <th>Position</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php
                        $pdo = $classPayroll->openConnection();

                        $sql = "SELECT
                        B.employee_id, B.isActive, B.first_name, B.last_name, B.email, B.contact, C.dept_code, D.position_desc
                        FROM tbl_employee_department_position AS A 
                        LEFT JOIN employee AS B
                        ON A.employee_id = B.employee_id
                        LEFT JOIN department AS C
                        ON A.dept_id = C.dept_id
                        LEFT JOIN position AS D
                        ON A.position_id = D.position_id
                        WHERE B.isActive = 1;";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch()){
                    ?>
                    <tr>
                        <td><?php echo $row['employee_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['contact']; ?></td>
                        <td><?php echo $row['dept_code']; ?></td>
                        <td><?php echo $row['position_desc']; ?></td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
       
        
    </body>
</html>