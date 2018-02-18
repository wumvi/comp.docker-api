<?php
declare(strict_types=1);

namespace DockerApi\Arguments\Containers;


class HostConfig
{
    private $autoRemove = true;
    /**
     * @var string[]
     */
    private $binds = [];

    /**
     * @return string[]
     */
    public function getBinds(): array
    {
        return $this->binds;
    }

    /**
     * @param string[] $binds
     */
    public function setBinds(array $binds): void
    {
        $this->binds = $binds;
    }

    /**
     * @return bool
     */
    public function isAutoRemove(): bool
    {
        return $this->autoRemove;
    }

    /**
     * @param bool $autoRemove
     */
    public function setAutoRemove(bool $autoRemove): void
    {
        $this->autoRemove = $autoRemove;
    }
}
