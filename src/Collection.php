<?php

declare(strict_types=1);

namespace DarkDevLab\Collection;

/**
 * Class Collection
 * @package DarkDevLab\Collection
 */
abstract class Collection implements \Iterator, \Countable
{
    /**
     * @var array
     */
    protected $container = [];

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * @param $value
     * @return $this
     */
    protected function add($value)
    {
        if (!$this->contains($value)) {
            $this->container[] = $value;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function rewind()
    {
        return reset($this->container);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return key($this->container);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return null !== key($this->container);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->container);
    }

    /**
     * @param int $offset
     * @return mixed
     */
    public function get(int $offset)
    {
        return $this->container[$offset];
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->container;
    }

    /**
     * @param mixed $needle
     * @return bool
     */
    public function contains($needle): bool
    {
        return \in_array($needle, $this->container, false);
    }

    /**
     * @param int $offset
     */
    public function delete(int $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * @param Collection $collection
     * @return bool
     */
    public function isEquals(Collection $collection): bool
    {
        return $this->getAll() == $collection->getAll();
    }
}
