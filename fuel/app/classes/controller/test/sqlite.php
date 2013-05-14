<?php
class Controller_Test_Sqlite extends Controller_Test
{
	function before()
	{
		parent::before();

    $this->module = "sqlite";
	}

  function action_index(){
    return $this->disp("lol");
  }

  function action_setup(){
    $options = array(

		);

		Doctrine::generateModelsFromDb(
			APPPATH.'classes/model/doctrine',
			array('doctrine'),
			$options
		);

		return $this->disp("attempting to setup and configure doctrine models!");
  }

  function action_insert(){
    $people = 1000;
    \Fuel\Core\Config::load("people", true);

    $users = new Doctrine_Collection("Users");
    for($i = 0 ; $i < $people ; $i++){
      $fn_rand = rand(0, 49);
      $ln_rand = rand(0, 49);

      $genders = array(
          "male", "female"
      );

      $gender = $genders[rand(0,1)];
      
      $user = new Users;
      $user->first_name = Config::get("people.firstname.{$fn_rand}");
      $user->last_name = Config::get("people.lastname.{$ln_rand}");
      $user->gender = $gender;
      $user->birthday =
              rand(1980, 2005)
              . "-" . str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT)
              . "-" . str_pad(rand(1, 28), 2, 0, STR_PAD_LEFT)
              . " 00:00:00";

      $users->add($user);
    }

    $users->save();

    return "added {$people} people.";
  }
}