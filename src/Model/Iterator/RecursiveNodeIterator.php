<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Iterator;

use Inwebo\Markdown\Node\Node;

/**
 * @extends \RecursiveArrayIterator<int, Node>
 *
 * @method Node current()
 */
class RecursiveNodeIterator extends \RecursiveArrayIterator
{
    public function hasChildren(): bool
    {
        return $this->current()->hasChildren();
    }

    public function getChildren(): ?RecursiveNodeIterator
    {
        if ($this->hasChildren()) {
            return new RecursiveNodeIterator($this->current()->getChildren()->getArrayCopy());
        } else {
            return null;
        }
    }
}
