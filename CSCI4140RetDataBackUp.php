<html>
<body>
<?php
	ini_set('display_errors', '1');
	error_reporting(E_ALL);

	include 'CSCI4140Assi3.php';
        include 'CSCI4140A3HTML.html';
	
        $pdo = new PDO($dsn,$user,$pass,$opt);
	//change above credentials as needed   
    
    //echo  $_POST["userQuery"]; test printing!
    
    $userQuery = $_POST["userQuery"];//please also 
    //catch any errors. If not caught will cause 
    //trouble in program
 
    //replace below with $userQuery 
    
    $stmt = $pdo->query($_POST["userQuery"]);//need to 
    //catch all exceptions
    //$stmt = $pdo->query('SELECT * FROM `EMP`');
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
      echo "<br>";//new line
   }
    echo "<br><br><br> END OF FIRST SECTION <br><br><br>";

  //  $stmt = $pdo->query('SELECT * FROM `EMP`');
  //	while ($row = $stmt->fetch()){
  // 	      echo $row[4]."  ".$row['EMP_FNAME']."<br>";
  //	}

  //  path to file:file:///C:/A3Xampp/htdocs/CSCI4140A3HTML.html
  //  php connection was all successful!! Please no comments out
  //  of the html tags!!!!!!!!!! 

?>
</body>
</html>


