<?php   //database.php

/***************** Global Constants ***********************/

		$host = "localhost";
		$user = "jeremyka";
		$pass = ;
		$db = ;		
		$table = "comments";

		$showErrors = false;
		$connectMessage = "";

/***************** End Gloabl Constants *****************/

/**************************** Functions for Modifying Database *************************/

		function createTables(){
				global $table;
				$query = "CREATE TABLE $table (commentID VARCHAR(64) PRIMARY KEY, comment TEXT) Engine=MyISAM;";
				$result = mysql_query($query);
				return mysql_query($query);
		}
		function addToDatabase($commentID, $comment){
				global $table;
				//Checking for duplicates;
				if ( mysql_num_rows($query) <= 0 ){
					$query = "INSERT INTO $table (commentID, comment) VALUES('$commentID', '$comment');";
					return mysql_query($query);
				}
				else{
					$query = "UPDATE $table SET comment='$comment' WHERE commentID='$commentID';";
					return mysql_query($query);
				}
		}	
		function removeFromDatabase($headline){
				global $table;
				$query = "DELETE FROM $table WHERE headline = '$headline';";
				return mysql_query($query);
		}
		function removeAllFromDatabase(){
				global $table;
				$query = "TRUNCATE $table;";
				return mysql_query($query);
		}

/*********************** End of Functions for Modifying Database ********************/

/*********************** Functions for Grabbing from Database ***********************/
		function grabComments(){
				global $table;
				$events = array();
				$query = "SELECT comment FROM $table ORDER BY commentID DESC;";
				$result = mysql_query($query);
				if (!$result){
						$numComments = mysql_num_rows($result);
						if ($numEntries == 0)
								echo "No Events in the Database.";
						else
								echo "Unable to grab Comments.";
						return 0;
				}
				$numRows = mysql_num_rows( $result );
				for ( $i = 0; $i < $numRows; $i++ ){
						$row = mysql_fetch_row( $result );
						array_push($comments, $row[0]);
				}
				return $comments;
		}
/******************** End of Functiosn for Grabbing from Database *******************/

$connection = mysql_connect($host, $user, $pass);
if ( $connection ){
    $selectedDB = mysql_select_db($db);
		if ( $selectedDB ){
				$connectMessage .= "Database Successfully Created and Connected.";
				$tableCreated = createTables();
				if ( $tableCreated )
						$connectMessage .= "Table Successfully Created.";
				else
						$connectMessage .= "Table Not Created.";
		}
		else
				$connectMessage .= "Database does not exist.";
}
else{
		$connectMessage .= "Cannot connect to MySQL.";
}


if ($showErrors == true){
		echo $connectMessage;
}
?>
