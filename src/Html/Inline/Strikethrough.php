<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Inline;

use Inwebo\Markdown\Html\Block\AbstractHtmlTag;
use Inwebo\Markdown\Model\Enum\NodeType;

class Strikethrough extends AbstractHtmlTag
{
    public function getOpeningTag(): string
    {
        return '<del>';
    }

    public function getClosingTag(): string
    {
        return '</del>';
    }

    public function __construct(NodeType $type = NodeType::STRIKETHROUGH)
    {
        parent::__construct($type);
    }
}
