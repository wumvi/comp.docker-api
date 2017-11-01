<?php
declare(strict_types=1);

namespace DockerApi\Arguments\Exec;

class Prepare
{
    private $cmd;
    private $stdIn;
    private $stdOut;
    private $stdErr;
    private $container;

    /**
     * @return string
     */
    public function getContainer(): string
    {
        return $this->container;
    }

    public function __construct(string $container, string $cmd, bool $stdIn = false, bool $stdOut = true, bool $stdErr = true)
    {
        $this->cmd = $cmd;
        $this->stdIn = $stdIn;
        $this->stdOut = $stdOut;
        $this->stdErr = $stdErr;
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getCmd(): string
    {
        return $this->cmd;
    }

    /**
     * @return bool
     */
    public function isStdIn(): bool
    {
        return $this->stdIn;
    }

    /**
     * @return bool
     */
    public function isStdOut(): bool
    {
        return $this->stdOut;
    }

    /**
     * @return bool
     */
    public function isStdErr(): bool
    {
        return $this->stdErr;
    }
}
