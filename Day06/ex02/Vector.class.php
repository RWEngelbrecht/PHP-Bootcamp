<?php
require_once 'Vertex.class.php';
class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;

	static $verbose = false;

	public function __construct($vector) {
		$this->_x = $vector['dest']->get_x();
		$this->_y = $vector['dest']->get_y();
		$this->_z = $vector['dest']->get_z();
		$this->_w = 0.0;
		if (isset($vector['orig']) && $vector['orig'] instanceof Vertex) {
			$orig = new Vertex(->
		}

	}

	public function get_x(){

	}

	public function get_y(){

	}

	public function get_z(){

	}

	public function get_w(){

	}
}
?>
