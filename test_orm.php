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
CREATE TABLE IF NOT EXISTS `poney` (
  `id` INTEGER PRIMARY KEY,
  `name` varchar(255),
  `content` text,
  `infos_json` text,
  `age` INTEGER
);
EOF;
$db->query($my_obj_create_query);

$filler_data = <<<EOF
INSERT INTO poney VALUES (NULL, 'Gilbert', '','{"sexe":"m"}',4);
INSERT INTO poney VALUES (NULL, 'Sylvie', '','{"sexe":"f"}',5);
INSERT INTO poney VALUES (NULL, 'Jacques', '','{"sexe":"m"}',4);
INSERT INTO poney VALUES (NULL, 'Françoise', '','{""}',3);
INSERT INTO poney VALUES (NULL, 'Serge', '','{"sexe":"o"}',12);
INSERT INTO poney VALUES (NULL, 'Sheila', '','{"sexe":"f"}',1);
INSERT INTO poney VALUES (NULL, 'Charles', '','{"sexe":"m"}',5);
EOF;
$db->exec($filler_data);

$manager = new SIOrm\Manager($db);

$myPoney = $manager->get("Model\Poney");
$myPoney->name = "lorie";
$myPoney->save();
var_dump($myPoney->id);
var_dump($myPoney->getPrettyName());

echo (memory_get_usage()/(1024*1024))."\n";

/* TODO 1 */

$before = memory_get_usage();
$fourthPoney = $manager->getOne("Model\Poney",3);


var_dump($fourthPoney->id);
var_dump($fourthPoney->getPrettyName());
var_dump($fourthPoney->infos["sexe"]);



/* TODO 2 */
/* HINT : Utiliser un Iterator */
$allPoneys = $manager->getAll("Model\Poney");
foreach($allPoneys as $poney){
  echo "- ".$poney->id." : ".$poney->getPrettyName()."\n";
}

/*
OUT :
- 1 : ø¤º°`°º¤ø,¸,ø¤  Gilbert  º¤ø,¸¸,ø¤º°`°º¤ø
- 2 : ø¤º°`°º¤ø,¸,ø¤  Sylvie  º¤ø,¸¸,ø¤º°`°º¤ø
- 3 : ø¤º°`°º¤ø,¸,ø¤  Jacques  º¤ø,¸¸,ø¤º°`°º¤ø
- 4 : ø¤º°`°º¤ø,¸,ø¤  Françoise  º¤ø,¸¸,ø¤º°`°º¤ø
- 5 : ø¤º°`°º¤ø,¸,ø¤  Serge  º¤ø,¸¸,ø¤º°`°º¤ø
- 6 : ø¤º°`°º¤ø,¸,ø¤  Sheila  º¤ø,¸¸,ø¤º°`°º¤ø
- 7 : ø¤º°`°º¤ø,¸,ø¤  Charles  º¤ø,¸¸,ø¤º°`°º¤ø
- 8 : ø¤º°`°º¤ø,¸,ø¤  Lorie  º¤ø,¸¸,ø¤º°`°º¤ø
*/

/* TODO 3 */
/* Utiliser FilterIterator (http://php.net/manual/en/class.filteriterator.php)
   pour ne renvoyer que les Poney de sexe féminin
*/

/* TODO 4 */
/* Se brancher à l'api de Twitter pour récupérer les 1000 derniers tweets parlant d'un mot clé
*/

