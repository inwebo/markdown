<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Node\Node;

class Hr extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::HR)
    {
        parent::__construct($type);
    }

    public function getHtml(Node $node): string
    {
        return '<hr>'.PHP_EOL;
    }
}
