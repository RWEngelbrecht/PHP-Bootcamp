<?php
require_once 'Vertex.class.php';
class Vector
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 0;

	static $verbose = false;

	public function __construct($vertex) {
		if (isset($vertex['orig']) && $vertex['orig'] instanceof Vertex) {
			$orig = new Vertex(array('x'=>$vertex['orig']->get_x(),
				'y'=>$vertex['orig']->get_y(), 'z'=>$vertex['orig']->get_z()));
		}
		else {
			$orig = new Vertex(array('x'=>0, 'y'=>0, 'z'=>0));
		}
		$this->_x = $vertex['dest']->get_x() - $orig->get_x();
		$this->_y = $vertex['dest']->get_y() - $orig->get_y();
		$this->_z = $vertex['dest']->get_z() - $orig->get_z();
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

	public function normalize() {
		$mag = $this->magnitude();
		if ($mag == 1) {
			return clone $this;
		}
		$normX = $this->_x / $mag;
		$normY = $this->_y / $mag;
		$normZ = $this->_z / $mag;
		$normVer = new Vertex(array('x'=>$normX, 'y'=>$normY, 'z'=>$normZ));
		$normVec = new Vector(array('dest'=>$normVer));
		return $normVec;
	}

	public function add($rhs) {
		$sumX = $this->_x + $rhs->__get('_x');
		$sumY = $this->_y + $rhs->__get('_y');
		$sumZ = $this->_z + $rhs->__get('_z');
		$sumVer = new Vertex(array('x'=>$sumX, 'y'=>$sumY, 'z'=>$sumZ));
		$sumVec = new Vector(array('dest'=>$sumVer));
		return $sumVec;
	}

	public function sub($rhs) {
		$subX = $this->_x - $rhs->__get('_x');
		$subY = $this->_y - $rhs->__get('_y');
		$subZ = $this->_z - $rhs->__get('_z');
		$subVer = new Vertex(array('x'=>$subX, 'y'=>$subY, 'z'=>$subZ));
		$subVec = new Vector(array('dest'=>$subVer));
		return $subVec;
	}

	public function opposite() {
		$oppX = $this->_x * -1;
		$oppY = $this->_y * -1;
		$oppZ = $this->_z * -1;
		$oppVer = new Vertex(array('x'=>$oppX, 'y'=>$oppY, 'z'=>$oppZ));
		$oppVec = new Vector(array('dest'=>$oppVer));
		return $oppVec;
	}

	public function scalarProduct($k) {
		$scProdX = $this->_x * $k;
		$scProdY = $this->_y * $k;
		$scProdZ = $this->_z * $k;
		$scProdVer = new Vertex(array('x'=>$scProdX, 'y'=>$scProdY, 'z'=>$scProdZ));
		$scProdVec = new Vector(array('dest'=>$scProdVer));
		return $scProdVec;
	}

	public function dotProduct($rhs) {
		$dProdX = $this->_x*$rhs->__get('_x');
		$dProdY = $this->_y*$rhs->__get('_y');
		$dProdZ = $this->_z*$rhs->__get('_z');
		return (float)($dProdX + $dProdY + $dProdZ);
	}

	public function cos($rhs) {
		$dotProd = $this->dotProduct($rhs);
		$mag1 = $this->magnitude();
		$mag2 = (float)sqrt($rhs->__get('_x')**2 + $rhs->__get('_y')**2 + $rhs->__get('_z')**2);
		return $dotProd / ($mag1 * $mag2);
	}

	public function crossProduct($rhs) {
		$crosProdX = $this->_y*$rhs->__get('_z') - $this->_z*$rhs->__get('_y');
		$crosProdY = $this->_z*$rhs->__get('_x') - $this->_x*$rhs->__get('_z');
		$crosProdZ = $this->_x*$rhs->__get('_y') - $this->_y*$rhs->__get('_x');
		$crosVer = new Vertex(array('x'=>$crosProdX, 'y'=>$crosProdY, 'z'=>$crosProdZ));
		$crosVec = new Vector(array('dest'=>$crosVer));
		return $crosVec;
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
