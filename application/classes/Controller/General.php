<?php defined('SYSPATH') or die('No direct script access.');

class Controller_General extends Controller_Template {

    public $template = "frontend/layout_login";
    
    protected $auth;
    protected $session;
    
    public function before() {
        parent::before();
        
        $this->auth = Auth::instance();
        $this->session = Session::instance();
        
        $this->template->scripts = array("js/jquery-1.9.0.js", "js/jquery-ui-1.10.0.custom.min.js", "js/frontend/main.js");
        $this->template->styles = array("css/frontend/global.css", "css/frontend/styles.css");
        
        $this->template->scripts[] = "js/jquery.dataTables.js";
        $this->template->styles[] = "css/dataTables/jquery.dataTables.css";
        
        $this->template->title = "ZipTask";
    }

}