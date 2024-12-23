<html>
     <body>
	   <?php
                //we may need the user to keep the same poNo or we could get inputs for each session
                ini_set('display_errors', '1');
		error_reporting(E_ALL);

		include 'CSCI4140Assi3.php';
       	        //include 'CSCI4140RDCliLog.php';
                //include 'LoginVar.php';
                include 'CSCI4140A3CliOrd.html';
		session_start();
            try{
              $pdo = new PDO($dsn,$user,$pass,$opt); 
               if(!isset($_POST["partNo"]) or !isset($_POST["numParts"])){
		echo "Please use the html order page so that the php order page can access the credential information!";
                die();		
              }              
              else if($_POST["partNo"]==null or $_POST["numParts"]==null){
              	echo "The field for the part number and/or the number of parts is null/empty. Please fix this!";
                die();
	      }
              else{
  		 $partNo = $_POST["partNo"];//please also 
    	         $numParts = $_POST["numParts"];
              }
                $passWord = $_SESSION["password"];
                $companyId = $_SESSION["id"];
                $poNo = $_SESSION["poNo"];
           
              //session_destroy();
              //we should print what company is logged in  

              $compName = $pdo->query("select clientName from client where clientId = $companyId;");
              $cName=$compName->fetch();
              echo "You are logged in as company $cName[0] .";     
  //PLEASE ALSO CONSIDER OTHER CASES WHERE USER WANTS TO
  //ADD, DELETE OR UPDATE THINGS IN THE DATABASE
 		//$result = $stmt->fetch();//should store a number
           $rowStmt = $pdo->query("select count(*) from inventory where partNo = $partNo;");
           $numMatch=$rowStmt->fetch();
              
           if($numMatch[0]==0){
		echo "Part Number does not exist. Transaction aborted.";//if part number doesn't exist
                //maybe we should also consider some inserts
           //insert a failing transaction into POrder table but if we do it may cause errors in database         
           }
           else{//else there is actually a partNo the user input that exists
                  //$stmt = $pdo->query("select count(*) from POrder;");
                  //$result = $stmt->fetch();
                  //$execQuery=$pdo->prepare("insert into POrder values($result[0]+1,$companyId,NOW(),'nonexistent');");
              	  $stmt = $pdo->query("select count(*) from POrder where poNo = $poNo;");
                  $result = $stmt->fetch();
                  if($result[0]==0){
    		     $execQuery=$pdo->prepare("insert into POrder values($poNo,$companyId,NOW(),'un-processed');");
                     $execQuery->execute();
                  }  
                  $stmt=$pdo->query("select qtyOnHand from inventory where partNo = $partNo");
                  $qty=$stmt->fetch();
               if($qty[0]<$numParts){
                  echo "There is not enough stock to fulfill transaction. Transaction with purchase order number $poNo will fail!";
             
               } //I think that dealing with enough qty on hand should be done on the manager's side*/
              
                  $stmt2 = $pdo->query("select count(*) from Orderline;");
                  $result2 = $stmt2->fetch();         
                                
		 $stmt = $pdo->query("select currentPrice from Part where partNo = $partNo;");
                 $curPrice = $stmt->fetch();
                 $totUpdate = $curPrice[0] * $numParts;      
                 $execQuery=$pdo->prepare("insert into Orderline values($result2[0]+1,$poNo,$partNo,$numParts,$totUpdate);");//sth wrong with this
                 $execQuery->execute(); 
                 //FOR HEAVEN'S SAKE DON'T FORGET TO Update the INVENTORY->done on manager's side               
             }               
}
    catch( PDOException $Exception ) {
	  echo "Error! Please input something valid in the input boxes";
    }
  //  path to file:file:///C:/A3Xampp/htdocs/CSCI4140A3HTML.html
  //  php connection was all successful!! Please no comments out
  //  of the html tags!!!!!!!!!! 
     ?>
     </body>
</html>
