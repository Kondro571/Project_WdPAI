<?php

class AppController{

    protected function render(string $template = null){
        $templatePath = "view/$template".$template.'html';

        if(file_exists$templatePath){
            ob_start();
            include $templatePath;
           
        }
    }
}