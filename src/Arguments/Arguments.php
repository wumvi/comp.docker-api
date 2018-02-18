<?php
declare(strict_types=1);

namespace DockerApi\Arguments;

class Arguments
{
    private $stdIn;
    private $stdOut;
    private $stdErr;

    public function __construct(bool $stdIn = false, bool $stdOut = true, bool $stdErr = true)
    {
        $this->stdIn = $stdIn;
        $this->stdOut = $stdOut;
        $this->stdErr = $stdErr;
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
