<?php
class Matrix
{
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	protected $matrix = array();
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;

	static $verbose = false;

	public function __construct($arr = null) {
		if (isset($arr)) {
			if (isset($arr['preset'])) {
				$this->_preset = $arr['preset'];
			}
			if (isset($arr['scale'])){
				$this->_scale = $arr['scale'];
			}
			if (isset($arr['angle'])) {
				$this->_angle = $arr['angle'];
			}
			if (isset($arr['vtc'])) {
				$this->_vtc = $arr['vtc'];
			}
			if (isset($arr['fov'])) {
				$this->_fov = $arr['fov'];
			}
			if (isset($arr['ratio'])) {
				$this->_ratio = $arr['ratio'];
			}
			if (isset($arr['near'])) {
				$this->_near = $arr['near'];
			}
			if (isset($arr['far'])) {
				$this->_far = $arr['far'];
			}
			if (!$this->checkPreset())
				trigger_error("Oh no! Something went wrong!", E_USER_ERROR);
			$this->makeMatrix();
			if (Self::$verbose) {
				if ($this->_preset == Self::IDENTITY)
					print("Matrix IDENTITY instance constructed".PHP_EOL);
				else
					print("Matrix ".$this->_preset." preset instance constructed".PHP_EOL);
			}
			$this->makeMatrixType();
		}
	}

	private function checkPreset() {
		if (empty($this->_preset)) {
			return false;
		}
		if ($this->_preset == "SCALE" && empty($this->_scale)) {
			return false;
		}
		if (($this->_preset == Self::RX || $this->_preset == Self::RY
				|| $this->_preset == Self::RZ) && empty($this->_angle)) {
			return false;
		}
		if ($this->_preset == "TRANSLATION" && empty($this->_vtc)) {
			return false;
		}
		if ($this->_preset == "PROJECTION" &&
			(empty($this->_fov) || empty($this->_near) || empty($this->_far))) {
			return false;
		}
		return true;
	}

	private function makeMatrix() {
		for ($i = 0; $i < 16; $i++) {
			$this->matrix[$i] = 0;
		}
	}

	private function makeMatrixType() {
		if ($this->_preset == "IDENTITY")
			$this->makeIdentity(1);
		else if ($this->_preset == "SCALE")
			$this->makeIdentity($this->_scale);
		else if ($this->_preset == Self::RX)
			$this->makeRotX();
		else if ($this->_preset == Self::RY)
			$this->makeRotY();
		else if ($this->_preset == Self::RZ)
			$this->makeRotZ();
		else if ($this->_preset == "TRANSLATION")
			$this->makeTranslation();
		// else if ($this->_preset == "PROJECTION")
		// 	$this->makeProjection();
	}

	private function makeIdentity($scale) {
		$this->matrix[0] = $scale;
		$this->matrix[5] = $scale;
		$this->matrix[10] = $scale;
		$this->matrix[15] = 1;
	}

	private function makeRotX() {
		$this->makeIdentity(1);
		$this->matrix[5] = cos($this->_angle);
		$this->matrix[6] = -sin($this->_angle);
		$this->matrix[9] = sin($this->_angle);
		$this->matrix[10] = cos($this->_angle);
	}

	private function makeRotY() {
		$this->makeIdentity(1);
		$this->matrix[0] = cos($this->_angle);
		$this->matrix[2] = sin($this->_angle);
		$this->matrix[8] = -sin($this->_angle);
		$this->matrix[10] = cos($this->_angle);
	}

	private function makeRotZ() {
		$this->makeIdentity(1);
		$this->matrix[0] = cos($this->_angle);
		$this->matrix[1] = -sin($this->_angle);
		$this->matrix[4] = sin($this->_angle);
		$this->matrix[5] = cos($this->_angle);
	}

	private function makeTranslation() {
		$this->makeIdentity(1);
		$this->matrix[3] = $this->_vtc->__get('_x');
		$this->matrix[7] = $this->_vtc->__get('_y');
		$this->matrix[11] = $this->_vtc->__get('_z');
	}

	// private function makeProjection() {

	// }

	public function mult($rhs) {
		$mtxRet = array();
		$mtxA = $this->matrix;
		$mtxB = $rhs->matrix;
		for ($i = 0; $i < 16; $i++) {
			$j = $i * 4;
			$mtxRet[$j + $i] = 0;
			$mtxRet[$j + 0] += $mtxA[$j]*$mtxB[0] + $mtxA[$j + 1]*$mtxB[0+4];
			$mtxRet[$j + 1] += $mtxA[$j]*$mtxB[1] + $mtxA[$j + 1]*$mtxB[1+4];
			$mtxRet[$j + 2] += $mtxA[$j]*$mtxB[2] + $mtxA[$j + 1]*$mtxB[2+4];
			$mtxRet[$j + 3] += $mtxA[$j]*$mtxB[3] + $mtxA[$j + 1]*$mtxB[3+4];
		}
		$matrice = new Matrix();
		$matrice->matrix = $mtxRet;
		return $matrice;
	}

	function __destruct() {
		if (Self::$verbose == true) {
			print("Matrix instance destructed".PHP_EOL);
		}
	}

	function __toString(){
		$tab = "M | vtcX | vtcY | vtcZ | vtxO\n";
		$tab .= "-----------------------------\n";
		$tab .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tab .= "w | %0.2f | %0.2f | %0.2f | %0.2f\n";
		$tabArr = array();
		for ($i = 0; $i < 16; $i++)
			$tabArr[$i] = $this->matrix[$i];
		return vsprintf($tab, $tabArr);
	}


	static function doc() {
		return file_get_contents('Matrix.doc.txt');
	}
}
?>
