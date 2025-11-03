<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class H3 extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::H3)
    {
        parent::__construct($type);
    }
}
