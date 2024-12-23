<html>
     <body>
	   <?php
		//PLEASE DONT FORGET TO CATCH ALL ERRORS!!
                ini_set('display_errors', '1');
		error_reporting(E_ALL);

		include 'CSCI4140Assi3.php';
                //include 'CSCI4140A3HTML.html';may not need this
	        //include 'CSCI4140A3HTML.html';will mess program up
                //if we have two forms
		include 'CSCI4140A3Client.html';		
           try{
              $pdo = new PDO($dsn,$user,$pass,$opt);
	      if(!isset($_POST["newPassword"]) or !isset($_POST["newName"]) or !isset($_POST["newCity"])){
		echo "Please use the html registration page so that the corresponding php page can access the credential information!";
                die();		
              }              
              else if($_POST["newPassword"]==null or  $_POST["newName"]==null or $_POST["newCity"]==null){
              	echo "The field for the name and/or password and/or city is null/empty. Please fix this!";
                die();
	      }
    	      else{
              	$newPassword= $_POST["newPassword"];
              	$newCompanyName= $_POST["newName"];
              //$newCompanyId = $_POST["companyId"];
              //don't need companyId as it is already set
              	$newCompanyCity = $_POST["newCity"];
              }
               $stmt = $pdo->query("select count(*) from Client where clientName = '$newCompanyName';");
              $numMatch=$stmt->fetch();
              //echo $numMatch[0]; test print. Works up to here
              if($numMatch[0]==0){
		 $stmt = $pdo->query("select count(*) from Client;");
                 $numRows=$stmt->fetch();
                 $execQuery=$pdo->prepare("insert into Client values($numRows[0]+1,'$newCompanyName','$newCompanyCity','$newPassword','0');");
                 $execQuery->execute();//use an arrow instead of a dot for execution
                 $id = $numRows[0]+1;
                 echo "Please note that your company id is $id. You will need this information when logging in.";
              }
              else{echo "This company name already exists! Please try again";}   
    //please also catch any errors. If not caught will cause 
    //trouble in program
              
    }
    
    catch( PDOException $Exception ) {
	  echo "Error! Please input something valid in the input box!";
    }
  
     ?>
     </body>
</html>


