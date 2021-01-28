<?php
class CourseService extends BaseService {
	
	private $courseDao;
	
	public function getCourseDao() {
        return $this->courseDao;
    }

    public function setCourseDao(CourseDao $courseDao) {
        $this->courseDao = $courseDao;
    }

    public function __construct() {
        $this->courseDao = new CourseDao();
    }
	
	public function getAllCourses($keyword, $sortfield, $sortorder) {
        return $this->getCourseDao()->getAllCourses($keyword, $sortfield, $sortorder);
    }
	
	public function getCourse($id) {
        return $this->getCourseDao()->getCourse($id);
    }
	
	public function addCourse($coursename, $startdate, $enddate, $place, $organization) {
        return $this->getCourseDao()->addCourse($coursename, $startdate, $enddate, $place, $organization);
    }
	
	public function updateCourse($courseid, $coursename, $startdate, $enddate, $place, $organization) {
        return $this->getCourseDao()->updateCourse($courseid, $coursename, $startdate, $enddate, $place, $organization);
    }
	
	public function deleteCourse($id) {
        return $this->getCourseDao()->deleteCourse($id);
    }
}
?>