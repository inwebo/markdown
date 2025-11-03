<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Model\Iterator;

use Inwebo\Markdown\Node\Node;

/**
 * @method Node current()
 *
 * @extends \RecursiveIteratorIterator<RecursiveNodeIterator<int, Node>>
 */
class RecursiveNodeIteratorIterator extends \RecursiveIteratorIterator
{
}
