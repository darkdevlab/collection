<?php

declare(strict_types=1);

namespace DarkDevLab\Collection\Tests;

use DarkDevLab\Collection\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class CollectionTest
 * @package DarkDevLab\Collection\Tests
 */
class CollectionTest extends TestCase
{
    private $collection;

    protected function setUp(): void
    {
        $this->collection = new class extends Collection {
            public function addItem(string $item)
            {
                return parent::add($item);
            }
        };
    }

    public function testCollection()
    {
        $this->collection
            ->addItem('one')
            ->addItem('one')
            ->addItem('two');
        $this->assertSame(2, $this->collection->count());
        $this->assertSame(['one', 'two'], $this->collection->getAll());
        $this->assertTrue($this->collection->contains('one'));
        $this->assertFalse($this->collection->contains('three'));
        $this->collection->delete(0);
        $this->assertSame(1, $this->collection->count());
        $this->assertTrue($this->collection->contains('two'));
        $this->assertFalse($this->collection->contains('one'));
    }
}
