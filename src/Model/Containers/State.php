<?php
declare(strict_types=1);

namespace DockerApi\Model\Containers;

class State
{
    /**
     * @var string
     */
    private $error;

    /**
     * @var int
     */
    private $exitCode;

    /**
     * @var bool
     */
    private $dead;

    /**
     * @var bool
     */
    private $paused;

    /**
     * @var int
     */
    private $pid;

    /**
     * @var bool
     */
    private $restarting;

    /**
     * @var bool
     */
    private $running;

    /**
     * @var string
     */
    private $status;

    public function __construct(\stdClass $data)
    {
        $this->error = $data->Error;
        $this->exitCode = $data->ExitCode;
        $this->dead = $data->Dead;
        $this->paused = $data->Paused;
        $this->pid = $data->Pid;
        $this->restarting = $data->Restarting;
        $this->running = $data->Running;
        $this->status = $data->Status;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @return int
     */
    public function getExitCode(): int
    {
        return $this->exitCode;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->dead;
    }

    /**
     * @return bool
     */
    public function isPaused(): bool
    {
        return $this->paused;
    }

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @return bool
     */
    public function isRestarting(): bool
    {
        return $this->restarting;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->running;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
