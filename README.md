# MyanmarParser-PHP

PHP version of https://github.com/thanlwinsoft/MyanmarParser

Porting Directly from Python Version https://github.com/thantthet/MyanmarParser-Py

Minimum PHP 5.6 required.

## Usage

```php

function println($text)
{
	$newline = (PHP_SAPI === 'cli') ? PHP_EOL : '<br/>';

	print $text . $newline;
}

$m = new MyParser();
$str = 'ဘီးကျဲတွေ ခေတ်ကုန်သွားပြီ';

//ဘီး
//ကျဲ
//တွေ

//ခေတ်
//ကုန်
//သွား
//ပြီ

$offset = 0;

while ($offset < mb_strlen($str)) {
	list($breaktype, $next_offset) = $m->get_next_syllable($str, mb_strlen($str), $offset); # parse
	println(mb_substr($str, $offset, $next_offset - $offset));
    $offset = $next_offset;
}
```
