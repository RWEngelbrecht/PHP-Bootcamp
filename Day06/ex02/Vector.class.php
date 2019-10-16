<?php
require_once 'Vertex.class.php';
class Vector
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;

	static $verbose = false;

	public function __construct($vector) {
		if (isset($vector['orig']) && $vector['orig'] instanceof Vertex) {
			$orig = new Vertex(array('x'=>$vector['orig']->get_x(),
				'y'=>$vector['orig']->get_y(), 'z'=>$vector['orig']->get_z()));
		}
		else {
			$orig = new Vertex(array('x'=>0, 'y'=>0, 'z'=>0));
		}
		$this->_x = $vector['dest']->get_x() - $orig->get_x();
		$this->_y = $vector['dest']->get_y() - $orig->get_y();
		$this->_z = $vector['dest']->get_z() - $orig->get_z();
		$this->_w = 0.0;
		if (Self::$verbose == true) {
			printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __destruct() {
		if (Self::$verbose == true) {
			printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __toString() {
		return (vsprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", array($this->_x, $this->_y, $this->_z, $this->_w)));
	}

	public function __get($property){
		return $this->$property;
	}

	public function magnitude() {
		return (float)sqrt(($this->_x**2 + $this->_y**2 + $this->_z**2));
	}



	static function doc() {
		$file = fopen("Vector.doc.txt", 'r');
		while ($file && !feof($file)){
			$line = fgets($file);
			echo $line;
		}
		echo "\n";
	}

}
?>
