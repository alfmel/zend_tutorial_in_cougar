# ZF2 Tutorial in Cougar
----

This project demonstrates how to implement the Zend Framework 2 Album tutorial
using the [Cougar Framework](https://github.com/alfmel/cougar). Please note that
the Cougar framework is only for building REST-based APIs. That means this
implementation does not have a real User Infterface (UI). (In the future we hope
to create an interface in Angular.js to make a full comparison.)

The purpose of the comparison is not to say that one framework is better than
another; it is to show how the Cougar Framework can help you build REST-based
APIs faster. The Cougar Framework is optimized to solve the REST API problem and
pales in comparison to the Zend Framework in terms of features and flexibility.

If you are wondering if the Cougar Framework is worth using, look at the code.
We believe the APIs written with Cougar are simpler to write and manage. They
also requires less lines of code.

To write the API backend for the ZF2 tutorial in Cougar, it takes 5 files and
about 150 lines of code (101 lines in PHP and about 40 in required annotations
in the comments).

```
$ cloc lib web
       8 text files.
       8 unique files.
       2 files ignored.

http://cloc.sourceforge.net v 1.60  T=0.03 s (198.8 files/s, 9972.2 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                              5             35            160            101
HTML                             1              0              0              5
-------------------------------------------------------------------------------
SUM:                             6             35            160            106
-------------------------------------------------------------------------------
```

Looking at only the backend for the ZF2 implementation, it takes 13 files and
378 lines of code:

```
$ cloc config init_autoloader.php module/Album/{*.php,config,src}
      13 text files.
      13 unique files.
       3 files ignored.

http://cloc.sourceforge.net v 1.60  T=0.04 s (256.5 files/s, 12004.6 lines/s)
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                             10             62             28            378
-------------------------------------------------------------------------------
SUM:                            10             62             28            378
-------------------------------------------------------------------------------
```

Lines of code is only one measure of productivity. So look at the code, check
out the [Cougar Tutorial](https://github.com/alfmel/cougar_tutorial) and see if
the Cougar Framework can help you be more productive.
