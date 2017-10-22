<?php

class Controller {
    
    protected $_view;
    protected $_model;
    protected $_templateObj;
    
    //GET POST
    protected $_arrParam;
    
    //Pagination
    protected $_pagination = array(
									'totalItemsPerPage'	=> 5,
									'pageRange'			=> 3,
								);
    
    public function __construct($arrParam) {
        $this->setModel($arrParam['module'], $arrParam['controller']);
        $this->setTemplate($this);
        $this->setView($arrParam['module']);
        $this->_pagination['currentPage']	= (isset($arrParam['filter-page'])) ? $arrParam['filter-page'] : 1;
        $arrParam['pagination'] = $this->_pagination;
        $this->setParams($arrParam);
        $this->_view->arrParam = $arrParam;
    }
    
    public function setModel($moduleName = null, $modelName = null) {
        $modelName = ucfirst($modelName) . 'Model';
        $filePath = MODULE_PATH . $moduleName . DS . 'models' . DS . $modelName . '.php';
        if (file_exists($filePath)) {
            require_once($filePath);
            $this->_model = new $modelName();
        }
    }
    
    public function getModel() {
        return $this->_model;
    }
    
    public function setView($moduleName) {
        $this->_view = new View($moduleName);
    }
    
    public function getView() {
        return $this->_view;
    }
    
    public function setParams($arrParams) {
        $this->_arrParam = $arrParams;
    }
    
    public function getArrParam() {
        return $this->_arrParam;
    }
    
    public function setTemplate() {
        $this->_templateObj = new Template($this);
    }
    
    public function getTemplateObj() {
        return $this->_templateObj;
    }

    // SET PAGINATION
    public function setPagination($config){
        $this->_pagination['totalItemsPerPage'] = $config['totalItemsPerPage'];
        $this->_pagination['pageRange']			= $config['pageRange'];
        $this->_arrParam['pagination']			= $this->_pagination;
        $this->_view->arrParam					= $this->_arrParam;
    }
}