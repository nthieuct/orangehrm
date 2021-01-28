<?php
class viewTrainingModuleAction extends sfAction {
    
    public function execute($request) {
        $defaultPath = 'training/viewLearners';
        $this->redirect($defaultPath);
    }  

}
