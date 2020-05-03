<?php

namespace DarkDevLab\Collection;

/**
 * Class GeneratorCollection
 * @package DarkDevLab\Collection
 */
abstract class GeneratorCollection implements \Iterator
{
    /**
     * @var \Generator
     */
    private $generator;

    /**
     * GeneratorCollection constructor.
     *
     * @param \Generator $generator
     */
    public function __construct(\Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->generator->current();
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->generator->next();
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->generator->key();
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->generator->valid();
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->generator->rewind();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return iterator_to_array($this->generator);
    }
}
