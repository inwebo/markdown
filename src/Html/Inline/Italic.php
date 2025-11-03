<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Inline;

use Inwebo\Markdown\Html\Block\AbstractHtmlTag;
use Inwebo\Markdown\Model\Enum\NodeType;

class Italic extends AbstractHtmlTag
{
    public function getOpeningTag(): string
    {
        return '<i>';
    }

    public function getClosingTag(): string
    {
        return '</i>';
    }

    public function __construct(NodeType $type = NodeType::ITALIC)
    {
        parent::__construct($type);
    }
}
