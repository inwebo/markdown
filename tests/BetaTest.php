<?php

declare(strict_types=1);

namespace Inwebo\Markdown\Tests;

use Inwebo\Markdown;
use Inwebo\Markdown\Html;
use Inwebo\Markdown\Token\Token;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[CoversClass(Token::class)]
#[CoversClass(Markdown\Parser::class)]
#[CoversClass(Html\TagFactory::class)]
#[CoversClass(Markdown\Factory::class)]
#[Group('markdown')]
class BetaTest extends TestCase
{
    use Fixtures\Model\HasParserTrait;
    use Fixtures\Model\HasTagFactoryTrait;

    public function testParse(): void
    {
        file_put_contents('Fixtures/output/recursive.html', '');
        $content = file_get_contents(__DIR__.'/Fixtures/Markdown/recursive.md');
        $rootNodes = $this->getParser()->parse($content);

        $html = '';
        foreach ($rootNodes as $rootNode) {
            $childrenNodes = $this->getParser()->parse($rootNode);

            foreach ($childrenNodes as $childNode) {
                $rootNode->getChildren()->addNode($childNode);
            }

            $html .= $this->getTagFactory()->toHtml($rootNode);
        }

        $this->assertCount(2, $rootNodes);
        file_put_contents('Fixtures/output/recursive.html', $html);
    }

    public function testBuggy(): void
    {
        $content = file_get_contents(__DIR__.'/Fixtures/Markdown/buggy.md');
        $factory = new Markdown\Factory($this->getParser(), $this->getTagFactory());
        $content = $factory->parse($content);

        $this->assertEquals('<ol>'."\n\t".'<li>Liste item</li>'."\n\t".'<li><i>ul</i></li>'."\n\t".'<li>Liste item</li>'."\n".'</ol>'."\n", $content);
    }
}
