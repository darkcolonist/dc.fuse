<?php
use Doctrine\ORM;

class Controller_Test_Doctore extends Controller_Test
{
  public function action_index(){
    $_t = "OH MY GOODNESS <blink>IT WORKS!!!</blink>";

    $results = Doctrine::$em->getConnection()
            ->fetchAll("SELECT * FROM users;");

    foreach($results as $row){
      $_t .= "<br />loaded: ".$row["id"].", name is: ".$row["first_name"];
    }

    return Response::forge($_t);

  }

  public function action_generate(){
    $_t = "OH MY GOODNESS <blink>IT WORKS!!!</blink>";
    $_t .= "<br />setting up nao, wait plox!";

    // fetch metadata
    $driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
        Doctrine::$em->getConnection()->getSchemaManager()
    );
    Doctrine::$em->getConfiguration()->setMetadataDriverImpl($driver);
    $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory(Doctrine::$em);
    $cmf->setEntityManager(Doctrine::$em);
    $classes = $driver->getAllClassNames();

    foreach($classes as $key => $class){
      $classes[$key] = "model\{$class}";
    }

    $metadata = $cmf->getAllMetadata();
    $generator = new \Doctrine\ORM\Tools\EntityGenerator();
    $generator->setUpdateEntityIfExists(true);
    $generator->setGenerateStubMethods(true);
    $generator->setGenerateAnnotations(true);
    $generator->generate($metadata, APPPATH. 'classes/model');

    $_t .= "<br />Done!";

    return Fuel\Core\Response::forge($_t);
  }

  public function action_query(){
    $_t = "fetching...";

    $qb = Doctrine::$em->createQueryBuilder();
    $qb->select("u")
      ->from('model\Users', 'u')
      ->add('orderBy', 'u.id ASC')
      ->setFirstResult(Input::get("offset", 0))
      ->setMaxResults(Input::get("limit", 10));
//    $users = $qb->getQuery()->getArrayResult();
    $users = $qb->getQuery()->getResult();

    $_t .= "<br />";

    foreach($users as $user){
      $_t .= "<br />[{$user->getId()}] firstname: {$user->getFirstName()}, lastname: {$user->getLastName()}";
    }

    return Fuel\Core\Response::forge($_t);
  }

  public function action_execute(){
//    require_once APPPATH."classes/model/Lol/Users.php";

    set_time_limit(500);
    ini_set('memory_limit', '500M');

    $sess = date("YmdHis");

    for($i = 0; $i < 99999; $i ++){
      $user = new model\Users();

      $formattedsess = "$sess-$i";

      $user->setFirstName("luka".$formattedsess);
      $user->setLastName("giga".$formattedsess);

      $_t = "test complete: ";

      $_t .= " ".$user->getFirstName();

      Doctrine::$em->persist($user);
    }


    Doctrine::$em->flush();

//    $query = Doctrine::$em->createQueryBuilder()
//            ->select("u")
//            ->from("Users", "u")
//            ->getQuery();
//    $users = $query->getResult();
//
//    $_t = print_r($users->toArray(), true);

    return Fuel\Core\Response::forge($_t);
  }

  public function action_rawins(){
    set_time_limit(1024);
    ini_set('memory_limit', '2G');

    $sess = date("YmdHis");
    
    $statement = "INSERT INTO users(first_name, last_name) VALUES";

    $substatement = "";

    for($i = 0; $i < 2300000 ; $i ++){
      $formattedsess = "$sess-$i";
      $first_name = "rika-{$formattedsess}";
      $last_name = "ultra-{$formattedsess}";
      $substatement .= "('{$first_name}', '{$last_name}'),";
    }

    $substatement = rtrim($substatement, ",");

    $statement .= "{$substatement};";

    $results = Doctrine::$em->getConnection()
            ->exec($statement);

    return Fuel\Core\Response::forge("i dunno, shuny");
  }
}