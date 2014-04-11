<?php

namespace notFloran\SecurityChecker;

use SensioLabs\Security\SecurityChecker;

use Task;
use Project;
use BuildException;

class PhingTask extends Task
{
    /**
     * The composer.lock file to check
     *
     * @var string
     */
    protected $file = "composer.lock";

    /**
     * If true, an exception is throw
     *
     * @var boolean
     */
    protected $checkreturn = true;

    public function main()
    {
        $checker = new SecurityChecker();
        $alerts = json_decode($checker->check($this->file, 'json'), true);

        if(empty($alerts)) {
            $this->log("Great! The checker did not detected known* vulnerabilities in your project dependencies.");
            return;
        }

        $this->logError("Caution ! The checker detected package(s) that have known* vulnerabilities in your project. We recommend you to check the related security advisories and upgrade these dependencies.");
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setCheckreturn($checkreturn) {
        $this->checkreturn = $checkreturn;
    }

    protected function logError($message, $location = NULL)
    {
        if ($this->checkreturn) {
            throw new BuildException($message, $location);
        } else {
            $this->log($message, Project::MSG_ERR);
        }
    }
}
