<?php

namespace notFloran\SecurityChecker;

use Task;
use Project;
use BuildException;

class PhingTask extends Task
{
    public function main($transport = null)
    {
        throw new BuildException('Security Checker exception');
    }
}