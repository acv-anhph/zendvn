<?php

class Template {
    private $_fileConfig;
    private $_fileTemplate;
    private $_folderTemplate;
    private $_controller;
    
    public function __construct($controller) {
        $this->_controller = $controller;
    }
    
    public function setFileTemplate($value = 'index.php') {
        $this->_fileTemplate = $value;
    }
    
    public function getFileTemplate() {
        return $this->_fileTemplate;
    }

    public function setFileConfig($fileConfig = 'template.ini') {
        $this->_fileConfig = $fileConfig;
    }

    public function getFileConfig() {
        return $this->_fileConfig;
    }

    public function setFolderTemplate($folderTemplate = 'default/main') {
        $this->_folderTemplate = $folderTemplate;
    }

    public function getFolderTemplate() {
        return $this->_folderTemplate;
    }
    
    public function load() {
        $fileConfig 	= $this->getFileConfig();
        $folderTemplate = $this->getFolderTemplate();
        $fileTemplate 	= $this->getFileTemplate();
    
        $pathFileConfig	= TEMPLATE_PATH . $folderTemplate . DS . $fileConfig;
    
        if (file_exists($pathFileConfig)) {
            $arrCongif = parse_ini_file($pathFileConfig);
            $view = $this->_controller->getView();
            if (!empty($arrCongif['title'])) {
                $view->_title 		= $view->createTitle($arrCongif['title']);
            }
    
            if (!empty($arrCongif['metaHTTP'])) {
                $view->_metaHTTP 	= $view->createMeta($arrCongif['metaHTTP'], 'http-equiv');
            }
    
            if (!empty($arrCongif['metaName'])) {
                $view->_metaName 	= $view->createMeta($arrCongif['metaName'], 'name');
            }
    
            if (!empty($arrCongif['dirCss'])) {
                $view->_cssFiles 	= $view->createLink($this->_folderTemplate . $arrCongif['dirCss'], $arrCongif['fileCss'], 'css');
            }
    
            if (!empty($arrCongif['dirJs'])) {
                $view->_jsFiles 	= $view->createLink($this->_folderTemplate . $arrCongif['dirJs'], $arrCongif['fileJs'], 'js');
            }
    
            if (!empty($arrCongif['dirImg'])) {
                $view->_dirImg 		= TEMPLATE_URL . $this->_folderTemplate . $arrCongif['dirImg'];
            }
    
    
            $view->setTemplatePath(TEMPLATE_PATH . $folderTemplate . $fileTemplate);
        }
    }
    
    // Thiết lập đường dẫn đến template
    public function setTemplatePath($path){
        $this->_templatePath = $path;
    }
    
    // CREATE CSS - JS
    public function createLink($path, $files, $type = 'css'){
        $xhtml = '';
        if(!empty($files)){
            $path = TEMPLATE_URL . $path . DS;
            foreach($files as $file){
                if($type == 'css'){
                    $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path.$file.'"/>';
                }else if($type == 'js'){
                    $xhtml .= '<script type="text/javascript" src="'.$path.$file.'"></script>';
                }
            }
        }
        return $xhtml;
    }
    
    
    // CREATE META (NAME - HTTP)
    public function createMeta($arrMeta, $typeMeta = 'name'){
        $xhtml = '';
        if(!empty($arrMeta)){
            foreach($arrMeta as $meta){
                $temp = explode('|', $meta);
                $xhtml .= '<meta '.$typeMeta.'="'.$temp[0].'" content="'.$temp[1].'" />';
            }
        }
        return $xhtml;
    }
    
    // CREATE TITLE
    public function createTitle($value){
        return '<title>'.$value.'</title>';
    }
}