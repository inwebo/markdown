<?php

declare(strict_types=1);

namespace Inwebo\Markdown;

use Inwebo\Markdown\Html\TagFactory;

readonly class Factory
{
    public function __construct(
        private Parser $parser,
        private TagFactory $tagFactory,
    ) {
    }

    public function parse(string $input): string
    {
        $rootNodes = $this->parser->parse($input);
        $html = '';
        foreach ($rootNodes as $rootNode) {
            $childNodes = $this->parser->parse($rootNode);

            foreach ($childNodes as $childNode) {
                $rootNode->getChildren()->addNode($childNode);
            }

            $html .= $this->tagFactory->toHtml($rootNode);
        }

        return $html;
    }
}
