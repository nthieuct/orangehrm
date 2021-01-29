<?php
class LearnerService extends BaseService {
	
	private $learnerDao;
	
	public function getLearnerDao() {
        return $this->learnerDao;
    }

    public function setLearnerDao(LearnerDao $learnerDao) {
        $this->learnerDao = $learnerDao;
    }

    public function __construct() {
        $this->learnerDao = new LearnerDao();
    }
	
	public function getAllEmps() {
        return $this->getLearnerDao()->getAllEmps();
    }
	
	public function getAllLearners($courseid, $empnumber, $fromdate, $todate, $sortfield, $sortorder) {
        return $this->getLearnerDao()->getAllLearners($courseid, $empnumber, $fromdate, $todate, $sortfield, $sortorder);
    }
	
	public function getLearner($courseid, $empnumber) {
        return $this->getLearnerDao()->getLearner($courseid, $empnumber);
    }
	
	public function addLearner($courseid, $empnumber, $result, $note) {
        return $this->getLearnerDao()->addLearner($courseid, $empnumber, $result, $note);
    }
	
	public function updateLearner($courseid, $empnumber, $result, $note) {
        return $this->getLearnerDao()->updateLearner($courseid, $empnumber, $result, $note);
    }
	
	public function deleteLearner($courseid, $empnumber) {
        return $this->getLearnerDao()->deleteLearner($courseid, $empnumber);
    }
}
?>