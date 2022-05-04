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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/index.css">
    <script src="http://kit.fontawesome.com/a076d05399.js"></script>    
    <title>Symtech Homepage</title>
</head>
 <header>
   

    <script>
       $(document).ready(function(){
            var navbar = $("#nav-bar");

            $("#hidebtn").click(function(){
                
                navbar.slideToggle();

            })
            
        });

    </script>
</head>

<body>

      
     <div class="container">
                   
                <button id="hidebtn">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
        
           
        <nav id="nav-bar" class="nav-bar">
            <ul>
                <li>Profile</li>
                <li>Contact</li>
                <li>Logout</li>
               
            </ul>
    
        </nav>
  
    </div>
 <?php 

        if(isset($_SESSION['User']))
        {
            echo '<div class="welcome">'.'<h1>'.' Welcome ' . $_SESSION['User'].'</h1>'.'<div>';
            echo '<a href="logout_OP.php?logout">Logout</a>';
            // logout button (palagay nalang ako tas tanggalin mo nalang yung commnent nato hehe)
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>';
         }
        else
        {
            header("location:../index_OP.php");
        }

    ?>
 
</body>
</html>