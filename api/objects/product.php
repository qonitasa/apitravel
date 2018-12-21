<?php
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name = "ticket";
 
    // object properties
    public $order_time;
    private $ticket_id;
    public $name;
    public $telephone;
    public $email;
    public $gender;
    public $route;
    public $departure_time;
    public $arrival_time;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    
    // read products
	function read(){
	 
		// select all query
		$query = "SELECT order_time, name, telephone, email, gender, route, departure_time, arrival_time FROM ticket ORDER BY order_time ASC";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// search products
	function search_by_gender($keywords){
	 
		// select all query
		$query = "SELECT
					order_time, name, telephone, email, route, departure_time, arrival_time
				FROM
					ticket
				WHERE
					gender LIKE ?
				";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$keywords=htmlspecialchars(strip_tags($keywords));
		$keywords = "%{$keywords}%";
	 
		// bind
		$stmt->bindParam(1, $keywords);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	function search_by_route($keywords){
	 
		// select all query
		$query = "SELECT
					order_time, name, telephone, email, gender, departure_time, arrival_time
				FROM
					ticket
				WHERE
					route LIKE ?
				";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$keywords=htmlspecialchars(strip_tags($keywords));
		$keywords = "%{$keywords}%";
	 
		// bind
		$stmt->bindParam(1, $keywords);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	function search_by_name($keywords){
	 
		// select all query
		$query = "SELECT
					order_time, telephone, email, gender, route, departure_time, arrival_time
				FROM
					ticket
				WHERE
					name LIKE ?
				";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$keywords=htmlspecialchars(strip_tags($keywords));
		$keywords = "%{$keywords}%";
	 
		// bind
		$stmt->bindParam(1, $keywords);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	
	// read products with pagination
	public function readPaging($from_record_num, $records_per_page){
	 
		// select query
		$query = "SELECT
					order_time, name, telephone, email, gender, route, departure_time, arrival_time
				FROM
					ticket
				ORDER BY ticket_id DESC
				";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind variable values
		$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
	 
		// execute query
		$stmt->execute();
	 
		// return values from database
		return $stmt;
	}
	
	public function count_per_day($keywords){
		$query = "
				 SELECT `name`, `departure_time` 
				 FROM `ticket` 
				 WHERE (LEFT(`departure_time`,10) LIKE ? )
				 ";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$keywords=htmlspecialchars(strip_tags($keywords));
		$keywords = "%{$keywords}%";
	 
		// bind
		$stmt->bindParam(1, $keywords);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	public function count_route_per_day($k1,$k2){
		$query = "
				 SELECT `name`, `route`, `departure_time`
				 FROM `ticket`
				 WHERE (LEFT(`departure_time`,10) LIKE ? ) AND `route` LIKE ?
				 ";
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$k1=htmlspecialchars(strip_tags($k1));
		$k1 = "%{$k1}%";
		$k2=htmlspecialchars(strip_tags($k2));
		$k2 = "%{$k2}%";
	 
		// bind
		$stmt->bindParam(1, $k1);
		$stmt->bindParam(2, $k2);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
}
?>
