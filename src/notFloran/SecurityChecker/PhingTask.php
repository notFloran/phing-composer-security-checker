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
    protected $haltonerror = true;

    /**
     * The return format : text or json
     *
     * @var string
     */
    protected $format = "text";

    /**
     * Property name to set with output value
     *
     * @var string
     */
    protected $outputProperty;

    public function main()
    {
        if(!in_array($this->format, ['text', 'json'])) {
            throw new BuildException(sprintf('Unsupported format "%s"',$this->format));
        }

        if(!file_exists($this->file)) {
            throw new BuildException('File not found');
        }

        try {
            $checker = new SecurityChecker();
            $alerts = $checker->check($this->file, $this->format);
        } catch (\Exception $e) {
            throw new BuildException('Exception with SecurityChecker : ' . $e->getMessage());
        }

        if(!$checker->getLastVulnerabilityCount()) {
            $this->log("Great! The checker did not detected known* vulnerabilities in your project dependencies.");
            return;
        }

        print($alerts);

        if ($this->outputProperty) {
            $this->project->setProperty($this->outputProperty, $alerts);
        }

        $this->logError("Caution ! The checker detected package(s) that have known* vulnerabilities in your project. We recommend you to check the related security advisories and upgrade these dependencies.");
    }

    /**
     * Path to the composer.lock file
     *
     * @param string $file
     */
    public function setFile($value) {
        $this->file = $value;
    }

    /**
     * Indicate if we thrown an error when vulnerabilities are detected
     *
     * @param boolean $value
     */
    public function setHaltOnError($value)
    {
        $this->haltOnError = $value;
    }

    /**
     * Set the format (json or text)
     *
     * @param string $format
     */
    public function setFormat($value) {
        $this->format = $value;
    }

    /**
     * Sets the Property name to set with output value.
     *
     * @param string $outputProperty the output property
     *
     * @return self
     */
    public function setOutputProperty($value)
    {
        $this->outputProperty = $value;

        return $this;
    }

    protected function logError($message, $location = NULL)
    {
        if ($this->haltonerror) {
            throw new BuildException($message, $location);
        } else {
            $this->log($message, Project::MSG_ERR);
        }
    }

}
