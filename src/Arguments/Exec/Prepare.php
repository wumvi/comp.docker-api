<?php
declare(strict_types=1);

namespace DockerApi\Arguments\Exec;

use DockerApi\Arguments\Arguments;

class Prepare extends Arguments
{
    private $cmd;
    private $container;

    public function __construct(string $container, string $cmd, bool $stdIn = false, bool $stdOut = true, bool $stdErr = true)
    {
        parent::__construct($stdIn, $stdOut, $stdErr);

        $this->cmd = $cmd;
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getContainer(): string
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getCmd(): string
    {
        return $this->cmd;
    }
}
