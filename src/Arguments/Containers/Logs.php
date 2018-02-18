<?php
declare(strict_types=1);


namespace DockerApi\Arguments\Containers;


class Logs
{
    private $stderr = true;
    private $stdout = true;
    private $since = 0;
    private $until = 0;
    private $name = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isStderr(): bool
    {
        return $this->stderr;
    }

    /**
     * @param bool $stderr
     */
    public function setStderr(bool $stderr): void
    {
        $this->stderr = $stderr;
    }

    /**
     * @return bool
     */
    public function isStdout(): bool
    {
        return $this->stdout;
    }

    /**
     * @param bool $stdout
     */
    public function setStdout(bool $stdout): void
    {
        $this->stdout = $stdout;
    }

    /**
     * @return int
     */
    public function getSince(): int
    {
        return $this->since;
    }

    /**
     * @param int $since
     */
    public function setSince(int $since): void
    {
        $this->since = $since;
    }

    /**
     * @return int
     */
    public function getUntil(): int
    {
        return $this->until;
    }

    /**
     * @param int $until
     */
    public function setUntil(int $until): void
    {
        $this->until = $until;
    }
}
