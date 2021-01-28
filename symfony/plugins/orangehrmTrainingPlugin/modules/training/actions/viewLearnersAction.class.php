<?php
class viewLearnersAction extends BaseTrainingAction {

	private $learnerService;
	
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
		$this->learner = $this->getLearnerService();
    }

}
?>