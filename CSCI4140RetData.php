<html>
     <body>
	   <?php
		ini_set('display_errors', '1');
		error_reporting(E_ALL);

		include 'CSCI4140Assi3.php';
       	        include 'CSCI4140A3HTML.html';
	   try{
              $pdo = new PDO($dsn,$user,$pass,$opt);
	//change above credentials as needed   
          
        if(!isset($_POST["userQuery"])){
	    echo "The query is not set. Please fix this!";
            die();		
        }              
        else if($_POST["userQuery"]==null){
            echo "The query is null/empty. Please fix this!";
            die();
	}            
        else{    
          $userQuery = $_POST["userQuery"];
        } 
     //please also     
     //catch any errors. If not caught will cause trouble in program
     //replace below with $userQuery 
    
          if(strpos(strtoupper($_POST["userQuery"]),'SELECT')>=0){
              
              $stmt = $pdo->query($_POST["userQuery"]);//need to 
    //catch all exceptions
    //PLEASE ALSO CONSIDER OTHER CASES WHERE USER WANTS TO
  //ADD, DELETE OR UPDATE THINGS IN THE DATABASE
 
              $numCols = $stmt->columnCount();//get num cols of res.
   //should probably put the colNames here
              while($row = $stmt->fetch()){
                 $colsCounted = 0;//indices start at 0
                  while($colsCounted<$numCols){
      	  //echo $row["EMP_FNAME"]."<br>";
                      echo $row[$colsCounted]." ";
                      $colsCounted = $colsCounted + 1;
                  }
                  echo "<br>";//new line for each new row
               }
          }//end 'if' statement that tests whether it's a 'select' 
          //echo "<br><br><br> END OF FIRST SECTION <br><br><br>";
          else{
               $execQuery=$pdo->prepare($_POST["userQuery"]);
               $execQuery.execute();//we may need to change dot to an arrow
          }
    }
   catch( PDOException $Exception ) {
	  echo "Error! Please input something valid in the input box!";
    }
  //  path to file:file:///C:/A3Xampp/htdocs/CSCI4140A3HTML.html
  //  php connection was all successful!! Please no comments out
  //  of the html tags!!!!!!!!!! 
     ?>
     </body>
</html>
