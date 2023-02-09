# Math
Objective wrapper over BCMath

## Installation
Install via composer
```shell
composer require kdabrow/math
```

## Usage
First declare mutable number. Second string is validated and mutated to correct format. Here are examples with 
converted number in the comment: 

```php
use Kdabrow\Math\Number;

new Number("100"); // 100

new Number("-100"); // -100

new Number("100,11"); // 100.11

new Number("100.11"); // 100.11

new Number("10,000.11"); // 10000.11

new Number("10 000.11"); // 10000.11

new Number("10'000.11"); // 10000.11

new Number(".11"); // 0.11

new Number(",11"); // 0.11

new Number("0,11"); // 0.11

new Number("0.11"); // 0.11
```

Then use API provided by Number class. All methods (with the 'sqrt' exception) accept arguments in a given formats: 

```php
// numeric string
$number->add('100');

// Number object
$number->add(new Number('100'));

// array of strings  
$number->add(['100', '100']);

// array of Number objects
$number->add([new Number('100'), new Number('100')]);
 
// object implementing ArrayAccess interface
$number->add(new Collection()); 

// many formats or same elements at the same time
$number->add('100', new Number('200'), ['100', new Number('200')]);  
```

### Add
```php
use Kdabrow\Math\Number;

$number = new Number('700');

$number->add('100'); // 800
```

### Subtract

```php
use Kdabrow\Math\Number;

$number = new Number('700');

$number->subtract('100'); // 600
```

### Multiply

```php
use Kdabrow\Math\Number;

$number = new Number('700');

$number->multiply('2'); // 1400
```

### Divide

```php
use Kdabrow\Math\Number;

$number = new Number('700');

$number->divide('2'); // 350
```

### Square root

```php
use Kdabrow\Math\Number;

$number = new Number('16');

$number->sqrt(); // 4
```

### Power

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->pow('3'); // 8
```

### Is equal

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->isEqual('3'); // false
$number->isEqual('2'); // true
$number->isEqual('1'); // false
```

### Is equal or bigger

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->isEqualOrBigger('3'); // true
$number->isEqualOrBigger('2'); // true
$number->isEqualOrBigger('1'); // false
```

### Is equal or lower

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->isEqualOrLower('3'); // false
$number->isEqualOrLower('2'); // true
$number->isEqualOrLower('1'); // true
```

### Is lower

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->isLower('3'); // false
$number->isLower('2'); // false
$number->isLower('1'); // true
```

### Is bigger

```php
use Kdabrow\Math\Number;

$number = new Number('2');

$number->isBigger('3'); // true
$number->isBigger('2'); // false
$number->isBigger('1'); // false
```

## Development
To run unit tests go into project folder and type in the console
```shell
vendor/bin/phpunit
```

Package contains docker container capable of running tests
```shell
docker compose run php vendor/bin/phpunit
```