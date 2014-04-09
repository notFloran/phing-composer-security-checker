<?php

namespace notFloran\SecurityChecker;

use SensioLabs\Security\SecurityChecker;

use Task;
use Project;
use BuildException;

class PhingTask extends Task
{
    protected $file = null;

    public function main($transport = null)
    {
        throw new BuildException('Security Checker exception');
        $checker = new SecurityChecker();
        $alerts = $checker->check('composer.lock', 'json');
    }

    public function setFile($file) {
        $this->file = $file;
    }
}