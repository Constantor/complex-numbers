<?php
#################################################################################################################################
#    _________ __                                ____  __.                      __                 __  .__                      #
#   /   _____//  |_  ____ ___________    ____   |    |/ _|____   ____   _______/  |______    _____/  |_|__| ____   _______  __  #
#   \_____  \\   __\/ __ \\____ \__  \  /    \  |      < /  _ \ /    \ /  ___/\   __\__  \  /    \   __\  |/    \ /  _ \  \/ /  #
#   /        \|  | \  ___/|  |_> > __ \|   |  \ |    |  (  <_> )   |  \\___ \  |  |  / __ \|   |  \  | |  |   |  (  <_> )   /   #
#  /_______  /|__|  \___  >   __(____  /___|  / |____|__ \____/|___|  /____  > |__| (____  /___|  /__| |__|___|  /\____/ \_/    #
#          \/           \/|__|       \/     \/          \/          \/     \/            \/     \/             \/               #
#################################################################################################################################

class complexNumber {
	public $a, $b;

	public function __construct($a = 0, $b = 0) {
		if(is_numeric($a) and is_numeric($b)) {
			$this->a = $a;
			$this->b = $b;
			return true;
		} else
			return false;
	}

	public function getNumber() {
		return $this->a.'+'.$this->b.'*i';
	}


	public function add($number) {
		if(is_numeric($number))
			return complexNumber($this->a + $number, $this->b);
		elseif(@get_class($number) == get_class($this))
			return complexNumber($this->a + $number->a, $this->b + $number->b);
	}

	public function sub($number) {
		if(is_numeric($number))
			return complexNumber($this->a - $number, $this->b);
		elseif(@get_class($number) == get_class($this))
			return complexNumber($this->a - $number->a, $this->b - $number->b);
	}


	public function multiply($number) {
		if(is_numeric($number))
			return complexNumber($this->a*$number, $this->b*$number);
		elseif(@get_class($number) == get_class($this))
			return complexNumber($this->a*$number->a - $this->b*$number->b, $this->b*$number->a + $this->a*$number->b);
	}

	public function divide($number) {
		if(is_numeric($number))
			return complexNumber();
		elseif(@get_class($number) == get_class($this))
			return complexNumber(($this->a*$number->a + $this->b*$number->b)/($number->a*$number->a + $number->b*$number->b), ($this->b*$number->a - $this->a*$number->b)/($number->a*$number->a + $number->b*$number->b));
	}


	public function absolute() {
		return sqrt($this->a*$this->a + $this->b*$this->b);
	}

	public function argument() {
		if($this->a > 0)
			return atan($this->b/$this->a);
		elseif($this->a < 0 and $this->b >= 0)
			return M_PI + atan($this->b/$this->a);
		elseif($this->a < 0 and $this->b < 0)
			return atan($this->b/$this->a) - M_PI;
		elseif($this->a == 0 and $this->b > 0)
			return M_PI/2;
		elseif($this->a == 0 and $this->b < 0)
			return -M_PI/2;
	}


	public function power($number) {
		if(is_numeric($number)) {
			$out = 1;
			for($i = 0; $i < $number; $i++)
				$out*=$number;
		}
	}

	public function root($base = 2, $k = 1) {
		if(is_numeric($base) and is_numeric($k))
			return complexNumber(cos(($this->argument + 2*M_PI*$k)/$base), sin(($this->argument + 2*M_PI*$k)/$base))->multiply(realRoot($this->absolute(), $base));
	}


	protected function realRoot($number, $base) {
		$out = $number/$base;
		for($i = 0; $i < round(pow(M_E, $number)); $i++) 
			$out = 1/$base * round(($base-1)*x + $number/(pow($out, $base-1)));
		return $out;
	}
}
?>
