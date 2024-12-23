
<html>
     <body>
	   <?php
		 session_start();
                ini_set('display_errors', '1');
		error_reporting(E_ALL);

		include 'CSCI4140Assi3.php';
                //include 'CSCI4140A3HTML.html';//may not need this
		//include 'CSCI4140A3Client.html';//nor this either
                include 'CSCI4140A3CliLog.html';		
          try{
              $pdo = new PDO($dsn,$user,$pass,$opt);
	//change above credentials as needed   
              if(!isset($_POST["companyId"]) or !isset($_POST["comPassword"])){
		echo "Please use the html page to login so that the php login page can access the credential information!";
                die();		
              }              
              else if($_POST["companyId"]==null or $_POST["comPassword"]==null){
              	echo "Id and/or password is null/emptyPlease fix this!";
                die();
	      }
              else{
              	$companyId= $_POST["companyId"];
              	$comPassword = $_POST["comPassword"];
              }

              $stmt = $pdo->query("select count(*) from Client where clientId = $companyId and clientPassword = '$comPassword';");
              $numMatch=$stmt->fetch();
              
              $_SESSION["password"] = $comPassword;              
              $_SESSION["id"] = $companyId; //should probably get purchase order number here so that for each session, we will be
              //ordering to the same PorderID->need select statement
              
              if($numMatch[0]>0){
              //header("location:CSCI4140A3CliLog.html");
              $stmt = $pdo->query("select count(*) from POrder;");
              $maxPoNo=$stmt->fetch();
              $_SESSION["poNo"] = $maxPoNo[0]+1;//this is the new poNo for the session  
              //will redirect back to this page if credentials are not correct
              //}
              //else{
		  //session_start();
                  header("location: CSCI4140A3CliOrd.html");//in either case if we put the php         
                 //in the header, it will give us errors that we don't have the indices defined
	        //if credentials are correct, then will go to the ordering page
              }   
              else{
                echo "Id and/or password is invalid. Try again.";       
                //will redirect back to this page if credentials are not correct
              }   
    //please also catch any errors. If not caught will cause 
    //trouble in program           
    } 
    catch( PDOException $Exception ) {
	  echo "Error! Please input something valid in the input boxes.";
    }
  
     ?>
     </body>
</html>


