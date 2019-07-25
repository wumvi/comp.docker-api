<?php
declare(strict_types=1);

namespace DockerApi\Arguments;

class Arguments
{
    private $stdIn;
    private $stdOut;
    private $stdErr;
    private $tty;

    public function __construct(bool $stdIn = false, bool $stdOut = true, bool $stdErr = true, $tty = false)
    {
        $this->stdIn = $stdIn;
        $this->stdOut = $stdOut;
        $this->stdErr = $stdErr;
        $this->tty = $tty;
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

    /**
     * @return bool
     */
    public function isTty(): bool
    {
        return $this->tty;
    }
}
