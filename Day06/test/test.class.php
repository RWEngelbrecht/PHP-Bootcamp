<?php
class Person
{
	public $name;
	public $age;
	public $pref;

	// static $verbose = false;

	public function set($pers){
		$this->name = $pers[0];
		$this->age = $pers[1];
		$this->pref = $pers[2];
	}
	// public function __construct(){

	// }
}

class Pet extends Person
{
	public function print_name(){
		$a = $this->name;
		return $a;
	}
}

$pers = array("person1", "23", "paper");

$object = new Person();
$obj2 = new Person();
$obj2->set($pers);
// $object->name = "bob";
// $object->age = 23;
// $object->pref = "plastic";
var_dump($obj2);
var_dump($object);
?>
