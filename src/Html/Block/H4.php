<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class H4 extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::H4)
    {
        parent::__construct($type);
    }
}
