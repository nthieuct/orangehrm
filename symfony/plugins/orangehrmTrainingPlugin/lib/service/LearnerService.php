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
	
	public function getLearner($id) {
        return $this->getLearnerDao()->getLearner($id);
    }
	
	public function addLearner($learnername, $startdate, $enddate, $place, $organization) {
        return $this->getLearnerDao()->addLearner($learnername, $startdate, $enddate, $place, $organization);
    }
	
	public function updateLearner($learnerid, $learnername, $startdate, $enddate, $place, $organization) {
        return $this->getLearnerDao()->updateLearner($learnerid, $learnername, $startdate, $enddate, $place, $organization);
    }
	
	public function deleteLearner($id) {
        return $this->getLearnerDao()->deleteLearner($id);
    }
}
?>