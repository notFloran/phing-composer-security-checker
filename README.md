phing-composer-security-checker
===============================

A Phing task for Sensio Security Advisories Checker.

Installation
------------

The preferred way of installation is through Composer. Add `notfloran/phing-composer-security-checker` as a requirement to composer.json:

```javascript
{
    "require": {
        "notfloran/phing-composer-security-checker": "dev-master"
    }
}
```

Example
-------

Let Phing know about the Security Checker task:

    <taskdef name="security-checker" classname="notFloran\SecurityChecker\PhingTask" />