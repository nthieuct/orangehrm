<?php
class viewCoursesAction extends BaseTrainingAction {

	private $courseService;
	
	public function getCourseService() {
        if (is_null($this->courseService)) {
            $this->courseService = new CourseService();
            $this->courseService->setCourseDao(new CourseDao());
        }
        return $this->courseService;
    }
	
	public function execute($request)
    {
        $request = sfContext::getInstance()->getRequest();
        $this->isHttps = $request->isSecure();
        $this->url = rtrim(public_path('', true), "/");
		$this->course = $this->getCourseService();
    }

}
?>