<?php
abstract class Controller_Test extends Controller_Main
{
	var $title = null;
	var $module = null;

	function before(){
    $return = parent::before();
		Config::load("application", true);
	
		$this->title = Config::get("application.title");
		$this->module = "untitled";

    return $return;
	}
	
	function disp($data){
		$view_data = array(
			"title" => $this->title,
			"module" => $this->module
		);
	
		$le_disp = View::forge("test/template", $view_data);
	
		$le_disp->set("content", $data, false);
		
		$le_disp = Response::forge($le_disp);
	
		return $le_disp;
	}
	
	public function action_index(){
		return $this->disp("looks like this test case has yet to be implemented, should you be MAD?");
	}
}