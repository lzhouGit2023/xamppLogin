<html>
     <body>
	   <?php
		ini_set('display_errors', '1');
		error_reporting(E_ALL);

		include 'CSCI4140Assi3.php';
       	        include 'CSCI4140CompanyMgr.html';
    try{
        $pdo = new PDO($dsn,$user,$pass,$opt);
        //$pOrderNo = $_POST["poNo"];
        //$stmt = $pdo->query("Select count(*) from POrder where poNo = $pOrderNo;");//error occuring here	
	//$numRows=$stmt->fetch();
        //$stmt2 = $pdo->query("select status from POrder where poNo = $pOrderNo;");
	//$Pstatus = $stmt2->fetch(); 
        
        if(!isset($_POST["poNo"])){
	    echo "The field for the purchase order number is not set. Please fix this!";
            die();		
        }              
        else if($_POST["poNo"]==null){
            echo "The field for the purchase order number is null/empty. Please fix this!";
            die();
	} 
        else{  
            $pOrderNo = $_POST["poNo"];
            $stmt = $pdo->query("Select count(*) from POrder where poNo = $pOrderNo;");	
	    $numRows=$stmt->fetch();
            $stmt2 = $pdo->query("select status from POrder where poNo = $pOrderNo;");
	    $Pstatus = $stmt2->fetch(); 
        }        
        if($numRows[0]==0){
	   echo "The purchase order number doesn't exist. Please try again.";
	   die();        
        }
        else if($Pstatus[0]=='fulfilled' or $Pstatus[0]=='failed'){
	   echo "The purchase order has already been processed. Please try again";
           die();
        } 
        else{//this means that exists rows for the purchase order number
	   $stmt = $pdo->query("Select * from Orderline where poNo = $pOrderNo;");
           $isValid = true;//check validity above
           while($rows=$stmt->fetch()){
  	     $pNo = $rows["partNo"];
             $stmt2 = $pdo->query("Select qtyOnHand from inventory where partNo = $pNo;");
             $qOnHand = $stmt2->fetch();   
             $quantity = $rows["qty"];
             if($qOnHand[0]<$quantity){//we could also use other restrictions. This one is quite simple
		$isValid = false;
                 $partNum = $rows["partNo"];
                 echo "Not enough products on hand to support transaction for part number $partNum.";
                 $execQuery=$pdo->prepare("update POrder set status='failed' where poNo = $pOrderNo;");
	   	 $execQuery->execute();  //insert failure in porder!!
                 die();
             }
           } 
           $stmt = $pdo->query("Select * from Orderline where poNo = $pOrderNo;");
	   while($rows=$stmt->fetch()){
		$pNo = $rows["poNo"];
                $ClientCur=$pdo->query("Select clientId from POrder where poNo = $pNo;");//change this I'm a bit confused
                $ClientIden=$ClientCur->fetch();
                $quantity =  $rows["qty"];
                $partNum = $rows["partNo"];//line 48
                $execQuery=$pdo->prepare("update inventory set qtyOnHand=qtyOnHand-$quantity where partNo = $partNum;");
	   	$execQuery->execute();
           	$priceUpdate = $rows["priceOrdered"];
                $execQuery=$pdo->prepare("update client set moneyOwed=moneyOwed+$priceUpdate where clientId = $ClientIden[0];");
	   	//echo $priceUpdate;
                $execQuery->execute();
           }
                echo "Transaction is successful for client $ClientIden[0]";//we should also probably mention the purchase order for the client 
                $execQuery=$pdo->prepare("update POrder set status='fulfilled' where poNo = $pNo;");
	   	$execQuery->execute();//check above validity      
          }    
   }
   catch( PDOException $Exception ) {
	  echo "Error! Please input something valid in the input box";
    }
  //  path to file:file:///C:/A3Xampp/htdocs/CSCI4140A3HTML.html
  //  php connection was all successful!! Please no comments out
  //  of the html tags!!!!!!!!!! 
     ?>
     </body>
</html>
