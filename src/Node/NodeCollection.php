<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Node;

use Inwebo\Markdown\Model\Iterator\NodeIterator;
use Inwebo\Markdown\Model\Iterator\RecursiveNodeIterator;

/**
 * @extends \ArrayObject<int, Node>
 *
 * @method NodeIterator getIterator()
 */
class NodeCollection extends \ArrayObject
{
    public function addNode(Node $node): void
    {
        $this->offsetSet($node->getId(), $node);
        $this->uasort(function (Node $a, Node $b): int {
            return $a->getMatches()->getMarkdownStartPosition() <=> $b->getMatches()->getMarkdownStartPosition();
        });

        if (false === $node->hasParent()) {
            $this->buildTree($node);
        }
    }

    protected function buildTree(Node $subject): void
    {
        $nodes = new RecursiveNodeIterator($subject->getChildren()->getArrayCopy());
        $buffer = [];

        foreach ($nodes as $node) {
            $iterator = new RecursiveNodeIterator($buffer, \RecursiveIteratorIterator::CHILD_FIRST);

            if (!$iterator->valid()) {
                $buffer[] = $node;
            }

            foreach ($iterator as $child) {
                if ($child->isWithin($node)) {
                    $node->setParent($child);
                    $child->getChildren()->addNode($node);
                } else {
                    $buffer[] = $node;
                }
            }
        }

        $subject->getChildren()->exchangeArray($buffer);
    }
}
