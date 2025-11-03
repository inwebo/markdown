<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Inline;

use Inwebo\Markdown\Html\Block\AbstractHtmlTag;
use Inwebo\Markdown\Model\Enum\NodeType;

class Bold extends AbstractHtmlTag
{
    protected function getOpeningTag(): string
    {
        return '<b>';
    }

    public function getClosingTag(): string
    {
        return '</b>';
    }

    public function __construct(NodeType $type = NodeType::BOLD)
    {
        parent::__construct($type);
    }
}
