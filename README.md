# Complex numbers class
The class providing you to use complex numbers.

This class support many main things to work with imaginary numbers, for example

  - add real and complex number
  - add complex with complex number
  - multiply real and complex number
  - multiply complex and complex number
  - divide complex by real
  - divide complex by complex
  - divide real by complex
  - power complex number by integer exponent

### How to use
Include the class file in your code. Than you need create as many numbers as you need. Complex numbers in the class have the form a*i+b, where a and b is real and i is imaginary unit. To create complex number use code like this:
```php
...
$complexNumber1 = new complexNumber($a, $b);
...
```
There are many methods to manipulate with created number, class structure:
```php
class complexNumber {
	public var $a, $b; // a and b from a*i+b

	void public function __construct(numeric $a, numeric $b) { ... } // Initialize class

	string public function getNumber() { ... } // Returns $a.'*i+'.$b

	void public function add(numeric/complexNumber $number) { ... } // Add $number to your complex number

	void public function subtract(numeric/complexNumber $number) { ... } // Subtract $number to your complex number

	void public function multiply(numeric/complexNumber $number) { ... } // Multiply $number to your complex number

	void public function divide(numeric/complexNumber $number) { ... } // Divide $number to your complex number

	void public function power(int $exponent) { ... } // Power your complex number by $exponent
}
```

### Version
1.3

License
----

[Apache License](http://www.apache.org/licenses/)

---
##### Stepan Konstantinov
I am on 

[VKontakte](http://vk.com/stepankonstantinovboss)

[CodeForces](http://codeforces.com/profile/Constantor)

[FightCode](http://fightcodegame.com/profile/NaiKoNGod/)
