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
	public var $a, $b;

	public function __construct($a, $b) {
		$this->a = $a;
		$this->b = $b;
	}

	public function getNumber() {
		return $this->a.'*i+'.$this->b
	}

	public function add($number) {
		if(is_numeric($number))
			$this->b += $number;
		elseif(@get_class($number) == get_class($this)) {
			$this->a += $number->a;
			$this->b += $number->b;
		}
	}

	public function subtract($number) {
		if(is_numeric($number))
			$this->b -= $number;
		elseif(@get_class($number) == get_class($this)) {
			$this->a -= $number->a;
			$this->b -= $number->b;
		}
	}

	public function multiply($number) {
		if(is_numeric($number)) {
			$this->a *= $number;
			$this->b *= $number;
		} elseif(@get_class($number) == get_class($this)) {
			$this->a = $this->b*$number->a + $number->b*$this->a;
			$this->b = $this->b*$number->b - $this->a*$number->a;
		}
	}

	public function divide($number) {
		if(is_numeric($number)) {
			$this->a /= $number;
			$this->b /= $number;
		} elseif(@get_class($number) == get_class($this)) {
			$this->a = ($this->a*$number->b - $this->b*$number->a) / ($number->a*$number->a + $number->b*$number->b);
			$this->b = ($this->b*$number->b + $this->a*$number->a) / ($number->a*$number->a + $number->b*$number->b);
		}
	}

	public function power($exponent) if(is_numeric($exponent)) for($i = 1;$i < $exponent;$i++) $this->multiplyNumber($this);
}
?>
