<?php

namespace Pulli\Mime\Part\Multipart;

use Pulli\Mime\Helper\PGPSigningPreparer;
use Symfony\Component\Mime\Part\AbstractMultipartPart;
use Symfony\Component\Mime\Part\AbstractPart;

/*
 * @author PuLLi <the@pulli.dev>
 */
class PGPSignedPart extends AbstractMultipartPart
{
    use PGPSigningPreparer;

    public function __construct(AbstractPart ...$parts)
    {
        parent::__construct(...$parts);
        $this->getHeaders()->addParameterizedHeader('Content-Type', 'multipart/signed', [
            'micalg' => 'pgp-sha512',
            'protocol' => 'application/pgp-signature',
        ]);
    }

    public function getMediaSubtype(): string
    {
        return 'signed';
    }

    public function toString(): string
    {
        // We only have a text/multipart and the signature
        $parts = $this->getParts();

        return $this->prepareMessageForSigning($parts[0], parent::toString());
    }

    public function toIterable(): iterable
    {
        yield $this->toString();
    }
}
