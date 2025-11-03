<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html\Block;

use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Node\Node;

class Ul extends AbstractHtmlTag
{
    public function __construct(NodeType $type = NodeType::UL)
    {
        parent::__construct($type);
    }

    public function sanitize(Node $node): string
    {
        $items = explode(PHP_EOL, $node->getMatches()->getContent());
        $return = '';
        $index = 0;
        foreach ($items as $item) {
            if (0 !== $index) {
                $item = trim(mb_substr($item, 1));
            }
            $return .= PHP_EOL."\t".'<li>'.$item.'</li>';

            ++$index;
        }

        return $return.PHP_EOL;
    }

    public function getHtml(Node $node): string
    {
        return implode('', [
            $this->getOpeningTag(),
            $this->sanitize($node),
            $this->getClosingTag(),
        ]).PHP_EOL;
    }
}
