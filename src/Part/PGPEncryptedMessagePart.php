<?php

namespace Pulli\Mime\Part;

use Pulli\Mime\Helper\PGPSigningPreparer;
use Symfony\Component\Mime\Part\AbstractPart;

/*
 * @author PuLLi <the@pulli.dev>
 */
class PGPEncryptedMessagePart extends AbstractPart
{
    use PGPSigningPreparer;

    private string $body;

    public function __construct(string $body)
    {
        parent::__construct();

        $this->body = $this->normalize($body);
        $this->getHeaders()->addParameterizedHeader('Content-Disposition', 'inline', [
            'filename' => 'msg.asc',
        ]);
    }

    public function bodyToString(): string
    {
        return $this->body;
    }

    public function bodyToIterable(): iterable
    {
        yield $this->body;
    }

    public function getMediaType(): string
    {
        return 'application';
    }

    public function getMediaSubtype(): string
    {
        return 'octet-stream';
    }
}
