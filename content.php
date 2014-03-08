<?php
/**
 * @author chriscupas<chriscupas@yahoo.com>
**/

include 'db.php';

class content extends db {

	   function __construct() {}

	   function insert_content($item = array()) {
	   		global $prefix;
			try {
			  
			  if(!self::$dbh) $this->connect();

					$field = $this->field_check($item['for']);

					$query = self::$dbh->prepare("INSERT INTO {$prefix}module ({$field},dateupdated) VALUES (?,?)");
					
					$content = nl2br($item['content']);	                                         
					$params = array(
									  $content,
									  CURDATETIME
									  );
								  
					$return = $query->execute($params);

					  
			} catch (PDOException $e) {
			  $this->fatal_error($e->getMessage());
			}
			
			return $return;
	   		
	   }	


		function update_content($item = array()) {
			global $prefix;
           
			try {
			  if(!self::$dbh) $this->connect();

			  		$field = $this->field_check($item['for']);
			  		
					$query = self::$dbh->prepare("UPDATE {$prefix}module SET {$field} = ? , dateupdated = ? WHERE id = ?");
			  
					$content = nl2br($item['content']);	                                         
						
					$params = array(
								  $content,
								  CURDATETIME,
								  $item['id']
								  );
								  
					$return = $query->execute($params);
					  
					  
			} catch (PDOException $e) {
			  $this->fatal_error($e->getMessage());
			}
			
			return $return;
			
		}


	   function viewitems($item = array(), $table, $whereclause = false) {
	
			try {
		
				if(!self::$dbh) $this->connect();
				
				for($x = 0; $x <= count($item); $x++) {
					if(isset($item[$x]))
						$this->select .= "$item[$x],";
					
				}

				$selects = substr($this->select, 0, -1);
				
				$query = "SELECT $selects FROM $table $whereclause";
				
				$stmt = self::$dbh->query(rtrim($query));
				unset($this->select);
				
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$rResult = self::$dbh->query($query)->fetchAll();
				$this->count = @count($rResult); 
				
				
				
			} catch (PDOException $e) {
			  $this->fatal_error($e->getMessage());
			}
				
			return $rows ;
			return $this->count ;
			
			
	   }	



		function field_check($data) {
			switch ($data) {
				case 'newsfeed':
						$fields = "newsfeed";
					break;
				case 'copp':
						$fields = "careeropp";
					break;							
				default:
						die('bloodsucker! aw');
						exit;
					break;
			}			

			return $fields;
		}	


}