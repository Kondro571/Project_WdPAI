<?php

require_once "AppController.php";

class ProjectController extends AppController{

    const MAX_FILE_SIZE=1024*1024;
    const SUPPORTED_TYPES=["image/png",'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages=[];
    
    public function addProject()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_names']) && $this->validate($_FILES['file'])){

            return $this->render("projects",['messages' => $this->messages]);
        }
        $this->render('add-project',['messages' => $this->messages]);

    }

    private function validate(array $file):bool
    {
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = "za dlllllllllllllllllugi";
            return false;
        }

        return true;
    }
}