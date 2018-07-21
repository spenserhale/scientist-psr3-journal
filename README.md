# PSR3 Compatible Journal for Scientist

A PSR-3 / Monolog Journal for [PHP Scientist](https://github.com/daylerees/scientist).
Originally created and [composer packaged](https://packagist.org/packages/nx/scientist-psr3-journal) by [Nikko Bautista](https://github.com/nikkobautista).

This project is my version updating to support latest Scientist, removing NX namespace, and upgrading code to PHP 7.2.

## Installation
Add repository:
```
"repositories": [
     {
       "type": "vcs",
       "url": "https://github.com/spenserhale/scientist-psr3-journal"
     }
   ],`

```
Require package:

`composer require spenserhale/scientist-psr3-journal`
## Usage
```
$config = new \Scientist\Journal\PSR3JournalConfig(); //or anything that implements \Scientist\Journal\Contracts\PSR3ConfigInterface
$logger = new \Monolog\Monolog(); // or anything that implements Psr\Log\LoggerInterface
$journal = new \Scientist\Journals\PSR3Journal($logger, $config);
```

## Copyright and License

Original Copyright &copy; 2016 Nikko Bautista; Current Copyright &copy; 2018 Spenser Hale; Code released under the [MIT license](LICENSE).