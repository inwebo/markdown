<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Inline;

use Inwebo\Markdown\Html\Block\AbstractHtmlTag;
use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Node\Node;

class Image extends AbstractHtmlTag
{
    public function getOpeningTag(): string
    {
        return '<img src="%s" title="%s">';
    }

    public function getClosingTag(): string
    {
        return '';
    }

    public function __construct(NodeType $type = NodeType::IMAGE)
    {
        parent::__construct($type);
    }

    public function getHtml(Node $node): string
    {
        $endOfLine = $node->getToken()->isBlock() ? PHP_EOL : '';

        return implode('', [
            sprintf($this->getOpeningTag(), $node->getMatches()->getSrc(), $node->getMatches()->getContent()),
            '',
            $this->getClosingTag(),
        ]).$endOfLine;
    }
}
