<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;

class H6 extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::H6)
    {
        parent::__construct($type);
    }
}
