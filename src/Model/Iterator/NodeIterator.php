<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Iterator;

use Inwebo\Markdown\Node\Node;

/**
 * @extends \ArrayIterator<int, Node>
 *
 * @method Node current()
 */
class NodeIterator extends \ArrayIterator
{
}
