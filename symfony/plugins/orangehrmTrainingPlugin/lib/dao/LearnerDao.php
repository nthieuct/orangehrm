<?php
class LearnerDao extends BaseDao {
	
	var $dbhost;
	var $dbuser;
	var $dbpass;
	var $dbname;

	function __construct() {
		$this->dbhost = '45.117.169.145';
		$this->dbuser = 'hondamient_hrm';
		$this->dbpass = 'Cmu#2015';
		$this->dbname = 'hondamient_hrm';
	}
	
	public function getAllEmps() {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "select * from hs_hr_employee order by emp_lastname asc;";
		$result = mysqli_query($conn, $query);
		$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		return $rows;
    }
	
    public function getAllLearners($courseid, $empnumber, $fromdate, $todate, $sortfield, $sortorder) {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "select * from hieu_course_detail a, hieu_course b, hs_hr_employee c 
			where a.course_id = b.course_id 
			and a.emp_number = c.emp_number 
			and (a.course_id = ".$courseid." or ".$courseid." = 0) 
			and (a.emp_number = ".$empnumber." or ".$empnumber." = 0) 
			and b.start_date between '".$fromdate."' and '".$todate."' 
			order by " . $sortfield . " " . $sortorder . ";";
		
		$result = mysqli_query($conn, $query);
		$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		return $rows;
    }
	
	public function getLearner($courseid, $empnumber) {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "select * from hieu_course_detail where course_id = ".$courseid." and emp_number = ".$empnumber.";";
		$result = mysqli_query($conn, $query);
		$rows = [];
		while($row = mysqli_fetch_array($result))
		{
			$rows[] = $row;
		}
		return $rows;
    }
	
	public function addLearner($courseid, $empnumber, $result, $note) {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error(). PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "insert into hieu_course_detail values (".$courseid.", ".$empnumber.", '".$result."', '".$note."');";
		$result = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) > 0)
			return true;
		return false;
    }
	
	public function updateLearner($courseid, $empnumber, $result, $note) {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error(). PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "update hieu_course_detail set result = '".$result."', note = '".$note."' where course_id = ".$courseid." and emp_number = ".$empnumber.";";
		$result = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) > 0)
			return true;
		return false;
    }
	
	public function deleteLearner($courseid, $empnumber) {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (!$conn) {
			echo "Error: Unable to connect to MySQL" . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error(). PHP_EOL;
			exit;
		} else {
			mysqli_set_charset($conn, "utf8");
		}

		$query = "delete from hieu_course_detail where course_id = ".$courseid." and emp_number = ".$empnumber.";";
		$result = mysqli_query($conn, $query);
		if (mysqli_affected_rows($conn) > 0)
			return true;
		return false;
    }
}
?>