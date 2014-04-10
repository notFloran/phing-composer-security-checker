<?php

namespace notFloran\SecurityChecker;

use SensioLabs\Security\SecurityChecker;

use Task;
use Project;
use BuildException;

class PhingTask extends Task
{
    protected $file = "composer.lock";

    public function main()
    {
        $checker = new SecurityChecker();
        $alerts = $checker->check($this->file, 'json');

        if(empty($alerts)) {
            $this->log("Great!");
            $this->log("The checker did not detected known* vulnerabilities in your project dependencies.");
            return;
        }

        throw new BuildException('Security errors');
    }

    public function setFile($file) {
        $this->file = $file;
    }
}
