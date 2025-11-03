<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Html;

use Inwebo\Markdown\Model\Interface\HtmlTagInterface;
use Inwebo\Markdown\Model\Iterator\RecursiveNodeIterator;
use Inwebo\Markdown\Model\Iterator\RecursiveNodeIteratorIterator;
use Inwebo\Markdown\Node\Node;

class TagFactory
{
    /**
     * @var \ArrayObject<string, HtmlTagInterface>
     */
    protected \ArrayObject $factories;

    public function __construct(HtmlTagInterface ...$factories)
    {
        $this->factories = new \ArrayObject();

        foreach ($factories as $factory) {
            $this->factories->offsetSet($factory->getTokenType()->name, $factory);
        }
    }

    public function getFactoryHtmlTag(Node $subject): HtmlTagInterface
    {
        $factory = $this->factories->offsetGet($subject->getToken()->getType()->name);

        if (is_null($factory)) {
            throw new \UnexpectedValueException(sprintf('Html tag : %s not supported. Try to configure a HtmlFactory.', $subject->getToken()->getType()->name));
        }

        return $factory;
    }

    public function toHtml(Node $subject): string
    {
        $content = $this->getFactoryHtmlTag($subject)->getHtml($subject);

        $nodes = new RecursiveNodeIteratorIterator(new RecursiveNodeIterator($subject->getChildren()->getArrayCopy()), \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($nodes as $node) {
            $html = $this->getFactoryHtmlTag($node)->getHtml($node);

            $pos = strpos($content, $node->getMatches()->getMarkdown());
            if (false !== $pos) {
                $content = substr_replace($content, $html, $pos, strlen($node->getMatches()->getMarkdown()));
            }
        }

        return $content;
    }
}
