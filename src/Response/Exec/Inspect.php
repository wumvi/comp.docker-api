<?php
declare(strict_types=1);

namespace DockerApi\Response\Exec;

class Inspect
{
    /**
     * @var bool`
     */
    private $isRunning;

    /**
     * @var int
     */
    private $pid;

    /**
     * @var int
     */
    private $exitCode;

    public function __construct(string $rawData)
    {
        $data = json_decode($rawData);

        $this->isRunning = $data->Running;
        $this->pid = $data->Pid;
        $this->exitCode = $data->ExitCode;
    }


    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @return int
     */
    public function getExitCode(): int
    {
        return $this->exitCode;
    }
}
