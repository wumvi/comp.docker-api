<?php
declare(strict_types=1);

namespace DockerApi\Response\Containers;

use DockerApi\Model\Containers\State;

class Inspect
{
    /**
     * @var string[]
     */
    private $args;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $name;

    /**
     * @var State
     */
    private $state;

    public function __construct(string $rawData)
    {
        $data = json_decode($rawData);

        $this->args = $data->Args;
        $this->id = $data->Id;
        $this->image = $data->Image;
        $this->name = $data->Name;

        $this->state = new State($data->State);
    }

    /**
     * @return string[]
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }
}
