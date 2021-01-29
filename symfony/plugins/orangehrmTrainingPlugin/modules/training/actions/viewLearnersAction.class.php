<?php
class viewLearnersAction extends BaseTrainingAction {

	private $courseService;
	private $learnerService;
	
	public function getCourseService() {
        if (is_null($this->courseService)) {
            $this->courseService = new CourseService();
            $this->courseService->setCourseDao(new CourseDao());
        }
        return $this->courseService;
    }
	
	public function getLearnerService() {
        if (is_null($this->learnerService)) {
            $this->learnerService = new LearnerService();
            $this->learnerService->setLearnerDao(new LearnerDao());
        }
        return $this->learnerService;
    }
	
	public function execute($request)
    {
        $request = sfContext::getInstance()->getRequest();
        $this->isHttps = $request->isSecure();
        $this->url = rtrim(public_path('', true), "/");
		$this->course = $this->getCourseService();
		$this->learner = $this->getLearnerService();
    }

}
?>