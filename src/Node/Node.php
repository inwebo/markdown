<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Node;

use Inwebo\Markdown\Parser\Matches;
use Inwebo\Markdown\Token\Token;

/**
 * Class Node.
 *
 * Represents a single element (node) in the Markdown abstract syntax tree (AST).
 * Each Node corresponds to a parsed Markdown token and may contain nested child nodes.
 * Nodes are linked together to form a hierarchical representation of the Markdown document.
 */
class Node
{
    protected ?Node $parent = null;
    protected NodeCollection $children;
    protected int $id;

    public function __construct(
        private readonly Matches $matches,
        private readonly Token $token,
    ) {
        $this->children = new NodeCollection();
        $this->id = spl_object_id($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    public function getParent(): ?Node
    {
        return $this->parent;
    }

    public function setParent(?Node $parent): void
    {
        $this->parent = $parent;
    }

    public function hasParent(): bool
    {
        return !is_null($this->parent);
    }

    public function getMatches(): Matches
    {
        return $this->matches;
    }

    public function getChildren(): NodeCollection
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return $this->children->count() > 0;
    }

    public function isWithin(Node $node): bool
    {
        return $node->getMatches()->getMarkdownStartPosition() > $this->getMatches()->getMarkdownStartPosition()
            && $node->getMatches()->getMarkdownEndPosition() < $this->getMatches()->getMarkdownEndPosition();
    }
}
