<?php

declare(strict_types=1);

namespace DarkDevLab\Collection;

class IntegerCollection extends Collection
{
    public function addItem(int $item): self
    {
        return parent::add($item);
    }
}
