phing-composer-security-checker
===============================

[![Packagist](http://img.shields.io/packagist/v/notfloran/phing-composer-security-checker.svg)](https://packagist.org/packages/notfloran/phing-composer-security-checker)
[![Packagist](http://img.shields.io/packagist/dt/notfloran/phing-composer-security-checker.svg)](https://packagist.org/packages/notfloran/phing-composer-security-checker)
A Phing task that use Sensio Security Advisories Checker to checks if your application uses dependencies with known security vulnerabilities.

Installation
------------

The preferred way of installation is through Composer. Add `notfloran/phing-composer-security-checker` as a requirement to composer.json:

```javascript
{
    "require": {
        "notfloran/phing-composer-security-checker": "~1.0"
    }
}
```

Example
-------

Let Phing know about the Security Checker task:

```xml
    <taskdef name="security-checker" classname="notFloran\SecurityChecker\PhingTask" />
```

Then :

```xml
    <security-checker />
```
    
Or :

```xml
    <security-checker file="/var/www/symfony/composer.lock" />
```

With all attributes :


```xml
    <security-checker file="/var/www/symfony/composer.lock"  haltOnError="false" format="text" outputProperty="alerts" />
    <echo msg="Alerts : ${alerts} ..." />
```


Attributes :
------------

* **file** : path to the composer.lock file (default: composer.lock)
* **haltOnError** : indicate if an exception is thrown or not when vulnerabilities are detected (default: true)
* **format** : format of the list of vulnerabilities (json or text) (default: text)
* **outputProperty** : property name to set with output value

License
-------

phing-composer-security-checker is released under the MIT public license.
