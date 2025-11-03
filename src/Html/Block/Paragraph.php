<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Node\Node;

class Paragraph extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::PARAGRAPH)
    {
        parent::__construct($type);
    }

    protected function getOpeningTag(): string
    {
        return '<p>';
    }

    public function getClosingTag(): string
    {
        return '</p>';
    }

    public function sanitize(Node $node): string
    {
        return trim(str_replace(PHP_EOL, ' ', $node->getMatches()->getContent()));
    }

    public function getHtml(Node $node): string
    {
        return implode(PHP_EOL, [
            $this->getOpeningTag(),
            "\t".$this->sanitize($node),
            $this->getClosingTag(),
        ]).PHP_EOL;
    }
}
