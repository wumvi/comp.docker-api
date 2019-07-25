<?php
declare(strict_types=1);


namespace DockerApi\Arguments\Containers;


use DockerApi\Arguments\Arguments;

class CreateOptions extends Arguments
{
    private $hostname = '';
    private $cmd = [];
    private $image = '';

    /**
     * @var HostConfig|null
     */
    private $hostConfig = null;

    public function __construct(bool $stdIn = false, bool $stdOut = true, bool $stdErr = true, bool $tty = false)
    {
        parent::__construct($stdIn, $stdOut, $stdErr, $tty);
    }

    /**
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = $hostname;
    }

    /**
     * @return array
     */
    public function getCmd(): array
    {
        return $this->cmd;
    }

    /**
     * @param array $cmd
     */
    public function setCmd(array $cmd): void
    {
        $this->cmd = $cmd;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return HostConfig|null
     */
    public function getHostConfig(): ?HostConfig
    {
        return $this->hostConfig;
    }

    /**
     * @param HostConfig|null $hostConfig
     */
    public function setHostConfig(?HostConfig $hostConfig): void
    {
        $this->hostConfig = $hostConfig;
    }
}
