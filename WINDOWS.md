# Zephir Parser

## Installation Guide

This guide explains how to install Zephir Parser using a Windows operating system.
Some parts are optional, when you have a specific PHP version.
Parts which are only necessary for a specific PHP version, are marked as such.
PHP-Version requirements are marked using `[]`

### Software Requirements [PHP 5.5 or later]

* [Install Visual Studio 2012 Express](http://www.microsoft.com/en-US/download/details.aspx?id=34673)
(You should start it and activate it)

### Software Requirements [below PHP 5.5]

* [Install Windows SDK 6.1](http://www.microsoft.com/en-us/download/details.aspx?id=24826)
**WARNING:** This usually takes very long to install and is very big

* [Install Visual Studio 2008 Express (after SDK 6.1!)](http://go.microsoft.com/fwlink/?LinkId=104679)
Install C++ Express Edition, (You should start and activate it)

### Software Requirements General

* [Install PHP (NTS)](http://windows.php.net/download/)
    * Download and extract it
    * Make sure it is in the PATH, as for example below:
    ```cmd
    setx path "%path%;c:\path-to-php\"
    ```
* [Install PHP SDK](http://windows.php.net/downloads/php-sdk/)
(Currently `php-sdk-binary-tools-20110915.zip` is the newest)

```cmd
setx php_sdk "c:\path-to-php-sdk"
```

* [Download PHP Developer Pack(NTS!)](http://windows.php.net/downloads/releases/)
(or build it yourself with `--enable-debug --disable-zts` and `nmake build-devel` or just `nmake snap` by using the PHP-SDK)

```cmd
setx php_devpack "c:\path-to-extracted-devpack"
```

### Installation of Zephir Parser

* Clone/Download the repostiory
* Copy `re2c.exe` to the `parser` folder (from PHP-SDK for example)
* Go to `parser` directory
* Next, build `lemon`:
    * PHP 5
    ```cmd
    cmd /c install-win32-php5.bat
    ```
    * PHP 7
    ```cmd
    cmd /c install-win32-php7.bat
    ```

* Go to project root and compile Zephir Parser:

```cmd
%PHP_DEVPACK%\phpize
configure --enable-zephir_parser
nmake 2> compile-errors.log 1> compile.log
```

### Additional Links

Building PHP under Windows: https://wiki.php.net/internals/windows/stepbystepbuild
