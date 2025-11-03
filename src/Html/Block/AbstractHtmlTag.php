<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Model\Interface\HtmlTagInterface;
use Inwebo\Markdown\Node\Node;

abstract class AbstractHtmlTag implements HtmlTagInterface
{
    public function __construct(private readonly NodeType $type)
    {
    }

    public function getTokenType(): NodeType
    {
        return $this->type;
    }

    protected function getOpeningTag(): string
    {
        return '<'.strtolower($this->type->name).'>';
    }

    protected function getClosingTag(): string
    {
        return '</'.strtolower($this->type->name).'>';
    }

    public function sanitize(Node $node): string
    {
        return trim($node->getMatches()->getContent());
    }

    public function getHtml(Node $node): string
    {
        $endOfLine = $node->getToken()->isBlock() ? PHP_EOL : '';

        return implode('', [
            $this->getOpeningTag(),
            $this->sanitize($node),
            $this->getClosingTag(),
        ]).$endOfLine;
    }
}
