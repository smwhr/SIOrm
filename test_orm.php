<?php
include(__DIR__."/vendor/autoload.php");

$tmp_database_file = tempnam(sys_get_temp_dir(), 'MyORM');
$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
    'user'   => '',
    'password' => '',
    'path'   => $tmp_database_file,
    'driver' => 'pdo_sqlite',
);
$db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

$my_obj_create_query = <<<EOF
CREATE TABLE IF NOT EXISTS `my_obj` (
  `id` INTEGER PRIMARY KEY,
  `name` varchar(255),
  `content` text,
  `infos_json` text,
  `age` INTEGER
);
EOF;
$db->query($my_obj_create_query);


/* YOUR CODE HERE */

$m = new SIOrm\Manager($db);
$myPoney = $m->get("SIOrm\Poney");
$myPoney->name = "Gilbert";
$myPoney->save();

var_dump($myPoney->id);


echo $myPoney->couleur; //????
