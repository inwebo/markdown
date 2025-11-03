<?php

declare(strict_types=1);

namespace Inwebo\Markdown;

use Inwebo\Markdown\Html\TagFactory;

/**
 * Class Factory.
 *
 * The Factory class serves as a high-level Markdown rendering facade.
 * It orchestrates the parsing of Markdown text into a node tree using {@see Parser},
 * and subsequently converts that node tree into an HTML string via {@see TagFactory}.
 *
 * This class effectively provides a single entry point for converting
 * Markdown input into fully rendered HTML output.
 */
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
