<?php
class Controller_Test_UI extends Controller_Test
{
  public function before() {
    parent::before();

    $this->module = "ux/ui";
  }

  public function action_index(){
    $disp = Fuel\Core\View::forge("test/ui/simple");

    $this->add_js("jquery-1.9.1.min.js");
    $this->add_js("jquery-ui-1.10.3.all.min.js");
    $this->add_js("jquery.layout.1.3.0.min.js");
    
    $this->add_js("fuse.init.js");

    return $this->disp($disp);
  }

  public function action_advanced(){
    $disp = Fuel\Core\View::forge("test/ui/advanced");

    $this->add_js("jquery-1.9.1.min.js");
    $this->add_js("jquery-ui-1.10.3.all.min.js");
    $this->add_js("jquery.layout.1.3.0.min.js");

    $this->add_js("fuse.init.js");

    return $this->disp($disp);
  }
}