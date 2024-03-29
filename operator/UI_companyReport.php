<?php
    session_start();
    require_once('../php/classes/payrollClass.php');
    $pdo = $classPayroll->openConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/proper-placement.css">

    <title>Company Report</title>

    <script>

        function show() {
            document.getElementById('navigation').classList.toggle('active');
        }   

</script>

</head>
<body>
<!-- DASHBOARD -->
<header class="tophead">
    <!-- <p>top head</p> -->
    <?php

    if (isset($_SESSION['User'])) {
        echo '<h1 class="greet">' . 'COMPANY REPORT' . '</h1>';
        echo '<a href="../logout.php?logout"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 logout" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg></a>';
    } else {
        header("location:../index.php");
    }

    ?>
</header>

<div id="navigation"> 
        <div class="title">
            <h1 class="t-left">SymTech</h1>
            <h1 class="dot">.</h1>
        </div>
        <!-- <div class="toggle-btn" onclick="show()">
            <span></span>
            <span></span>
            <span></span>
        </div> -->
        <ul>
        <li>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px;float: left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M3 5v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2H5c-1.103 0-2 .897-2 2zm16.001 14H5V5h14l.001 14z"></path><path d="M11 7h2v10h-2zm4 3h2v7h-2zm-8 2h2v5H7z"></path></svg>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_addEmployee.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg>
                <p>Employee Management</p>
            </a>

        </li>
        <li>
            <a href="../operator/UI_setDepartment.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M7 14.001h2v2H7z"></path><path d="M19 2h-8a2 2 0 0 0-2 2v6H5c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2zM5 20v-8h6v8H5zm9-12h-2V6h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V6h2v2z"></path></svg>
                <p>Department Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_schedule.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M21 20V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2zM9 18H7v-2h2v2zm0-4H7v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm4 4h-2v-2h2v2zm0-4h-2v-2h2v2zm2-5H5V7h14v2z"></path></svg>
                <p>Scheduling Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_payroll.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 6c0-2.168-3.663-4-8-4S4 3.832 4 6v2c0 2.168 3.663 4 8 4s8-1.832 8-4V6zm-8 13c-4.337 0-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3c0 2.168-3.663 4-8 4z"></path><path d="M20 10c0 2.168-3.663 4-8 4s-8-1.832-8-4v3c0 2.168 3.663 4 8 4s8-1.832 8-4v-3z"></path></svg>
                <p>Payroll Management</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_employeeSalary.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>
                <p>Employee Salary Report</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_payslipReport.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg>
                <p>Payslip Report/Print</p>
            </a>
        </li>
        <li>
            <a href="../operator/UI_companyReport.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" style="padding-left: 16px; float:left;fill: rgba(255, 255, 255, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);"><path d="M5 3H3v18h18v-2H5z"></path><path d="M13 12.586 8.707 8.293 7.293 9.707 13 15.414l3-3 4.293 4.293 1.414-1.414L16 9.586z"></path></svg>
                <p>Company Report</p>
            </a>
        </li>
        </ul>
    </div>
    <!--_________________________________END OF TOPBAR___________________________________________-->
    <!--_________________________________END OF DASHBOARD__________________________________________-->
    

    

    <!-- ________________________________DATABASE TABLE_______________________________ -->
    <div class="banner3">
        <h1>Employee Department Table Report</h1>
    </div>
    <!-- __________________TABLE FOR EMPLOYEE DEDPARTMENT REPORT_____________________ -->
    <div class="output">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="t-size">Employee ID</th>
                    <th class="t-size">First Name</th>
                    <th class="t-size">Last Name</th>
                    <th class="t-size">Contact</th>
                    <th class="t-size">Email</th>
                    <th class="t-size">Department</th>
                    <th class="t-size">Position</th>
                    <th class="t-size">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#">Print</a> <a href="#">Delete</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- __________________________________END_______________________________________ -->
    <!-- __________________TABLE FOR EMPLOYEE PAYROLL REPORT_____________________ -->

    <div class="banner3">
        <h1>Employee Payroll Table Report</h1>
    </div>

    <div class="output">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="t-size">Employee ID</th>
                    <th class="t-size">First Name</th>
                    <th class="t-size">Last Name</th>
                    <th class="t-size">Contact</th>
                    <th class="t-size">Department</th>
                    <th class="t-size">Works Hrs.</th>
                    <th class="t-size">Days of Work</th>
                    <th class="t-size">OverTime</th>
                    <th class="t-size">Allowance</th>
                    <th class="t-size">Holidays</th>
                    <th class="t-size">LeaveDays</th>
                    <th class="t-size">Total Deduction</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#">Print</a> <a href="#">Delete</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- __________________________________END_______________________________________ -->

    <!-- __________________TABLE FOR EMPLOYEE PAYCHEQUE REPORT_____________________ -->

    <div class="banner3">
        <h1>Employee Paycheque Table Report</h1>
    </div>

    <div class="output">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th class="t-size">Employee ID</th>
                    <th class="t-size">First Name</th>
                    <th class="t-size">Last Name</th>
                    <th class="t-size">Contact</th>
                    <th class="t-size">Department</th>
                    <th class="t-size">WorkPay</th>
                    <th class="t-size">OverTimePay</th>
                    <th class="t-size">Holidays Pay</th>
                    <th class="t-size">LDPay</th>
                    <th class="t-size">AllowncePay</th>
                    <th class="t-size">BasicPay</th>
                    <th class="t-size">Deduct.Pay</th>
                    <th class="t-size">NetPay</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="#">Print</a> <a href="#">Delete</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- __________________________________END_______________________________________ -->

    <!-- __________________________________Button field_______________________________________ -->
    <div class="btn-prop">
         <button class="ger-btn save">Get Expenses Report</button>
         <input class="d-prop" type="Date">
         <button class="c-button">Go</button>
    </div>



        
</body>
</html>