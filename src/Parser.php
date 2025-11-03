<?php

declare(strict_types=1);

namespace Inwebo\Markdown;

use Inwebo\Markdown\Model\Enum;
use Inwebo\Markdown\Node\Node;
use Inwebo\Markdown\Node\NodeCollection;
use Inwebo\Markdown\Parser\Matches;
use Inwebo\Markdown\Token\Token;

class Parser
{
    /**
     * @var \ArrayObject<int, Token>
     */
    private \ArrayObject $tokens;

    public function __construct(Token ...$tokens)
    {
        $this->tokens = new \ArrayObject(array_values($tokens));
    }

    /**
     * @return array<int, Token>
     */
    public function getTokens(Enum\ParserType $type = Enum\ParserType::BOTH): array
    {
        switch ($type) {
            case Enum\ParserType::BOTH:
                return $this->tokens->getArrayCopy();
            case Enum\ParserType::INLINE:
                return array_values(array_filter($this->tokens->getArrayCopy(), fn (Token $token) => $token->isInline()));
            case Enum\ParserType::BLOCK:
                return array_values(array_filter($this->tokens->getArrayCopy(), fn (Token $token) => $token->isBlock()));
        }
    }

    /**
     * @return NodeCollection<int, Node>
     */
    public function parse(Node|string $input): NodeCollection
    {
        $tokenType = is_string($input) ? Enum\ParserType::BLOCK : Enum\ParserType::INLINE;
        $subject = is_string($input) ? $input : $input->getMatches()->getContent();
        $nodes = new NodeCollection();

        foreach ($this->getTokens($tokenType) as $token) {
            $results = preg_match_all($token->getRegex(), $subject, $matches, \PREG_OFFSET_CAPTURE);

            if (false !== $results && $results > 0 && !empty($matches)) {
                $length = count($matches['md']);
                for ($i = 0; $i < $length; ++$i) {
                    $md = $matches['md'][$i][0];
                    $startPosition = (int) $matches['md'][$i][1];
                    $content = $matches['content'][$i][0];
                    $href = $matches['href'][$i][0] ?? null;
                    $src = $matches['src'][$i][0] ?? null;

                    $normalisedMatches = new Matches($md, $startPosition, $content, $href, $src);
                    $newNode = new Node($normalisedMatches, $token);

                    if ($input instanceof Node) {
                        $newNode->setParent($input);
                    }
                    $nodes->addNode($newNode);
                }
            }
        }

        return $nodes;
    }
}
