<?php
class Controller_Test_Main extends Controller_Test
{
	function before()
	{
		parent::before();

    $this->module = "main";
	}
	
	function action_blog_insert()
	{
		$default_user_id = 1;
		
		$blog = Model_Blogs::forge()->set(array(
			'title' 	=> 'talking about: '.Str::random('alnum',4),
			'content' 	=> 'as explained, we will be doing '.Str::random('alnum',255),
			'user_id'	=> $default_user_id
		));
		
		$blog->save();
		
		$debug = $blog->to_array();
	
		return $this->disp("saved!<pre>".print_r($debug, true)."</pre>");
	}
	
	function action_user_view($user_id)
	{
		$user = Model_Users::find_by_pk($user_id);
		
		if($user === null)
		{
			$todisp = "user with id {$user_id} could not be found.";
		}else{
			$todisp = "user in question: ".$user->username;
		}
		
		return $this->disp($todisp);
	}
	
	function action_look()
	{
		return $this->disp(__DIR__);
	}
	
	function action_doctrine()
	{
		$path = Doctrine::getPath();
	
		$conn = Doctrine_Manager::connection();
		$result = $conn->execute("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public';")->fetchAll();
		$tables_found = null;
		
		foreach ($result as $table)
		{
			$tables_found .= $table[0]."<br />";
		}
	
		$disp = "doctrine loaded from: {$path}";
		$disp .= "<hr />parsing tables... tables found: ";
		$disp .= "<blockquote>{$tables_found}</blockquote>";
	
		$this->module = "enlightened fuel";
	
		return $this->disp($disp);
	}
	
	function action_setup()
	{
		$options = array(
			
		);
	
		Doctrine::generateModelsFromDb(
			APPPATH.'classes/model/doctrine',
			array('doctrine'),
			$options
		);
	
		return $this->disp("attempting to setup and configure doctrine models!");
	}

  function action_simple(){
    $query = Doctrine_Query::create()
            ->from("Users u")
            ->where("u.first_name = ?", "Christian Noel")
            ->limit(1);

    $user = $query->execute();

    Profiler::console($user->toArray());
    Profiler::console($user->getFirst()->UserMeta->toArray());
    Profiler::mark("compressing some data");

    $somedata = gzcompress(json_encode($user->toArray()));

    Profiler::mark_memory($somedata);
    Profiler::console($somedata);

    return $user->getFirst()->first_name;
  }

  function action_simple2(){
    $query = Doctrine_Query::create()
            ->from("UserMeta u")
            ->limit(1);

    $user = $query->execute();

    return $this->disp($user->user_id);
  }

	function action_doctrine_fetch()
	{
    $query = Doctrine_Query::create()
            ->from("Users u")
            ->limit(10)
            ->orderBy("u.first_name DESC");

    die($query->getSqlQuery());

		$users = $query->execute();
		
		return $this->disp("and that is all it seems? right, ". $users->getFirst()->first_name);
	}

  function action_massive(){
    set_time_limit(1024);
    ini_set('memory_limit', '1000M');
    $row_count = 500000;

    $sess = date("YmdHis");

    $statement = "INSERT INTO users(first_name, last_name, gender, dateofbirth) VALUES";

    $substatement = "";

    for($i = 0; $i < $row_count ; $i ++){
      $formattedsess = "$sess-$i";
      $first_name = "lannik-{$formattedsess}";
      $last_name = "denmok-{$formattedsess}";
      $gender = $i % 2 == 0 ? "male" : "female";

      $dobint = mt_rand(1262055681,1262055681);
      $dateofbirth = date("Y-m-d H:i:s",$dobint);
      
      $substatement .= "('{$first_name}', '{$last_name}', '{$gender}', '{$dateofbirth}'),";
    }

    $substatement = rtrim($substatement, ",");

    $statement .= "{$substatement};";

    Doctrine_Manager::connection()->exec($statement);

    return Fuel\Core\Response::forge("i dunno, shuny but i inserted: {$row_count}rows");
  }
}