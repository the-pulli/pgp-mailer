<?php

namespace Pulli\Mime\Part\Multipart;

use Symfony\Component\Mime\Part\AbstractMultipartPart;
use Symfony\Component\Mime\Part\AbstractPart;

/*
 * @author PuLLi <the@pulli.dev>
 */
class PGPSignedPart extends AbstractMultipartPart
{
    public function __construct(AbstractPart ...$parts)
    {
        parent::__construct(...$parts);
        $this->getHeaders()->addParameterizedHeader('Content-Type', 'multipart/signed', [
            'micalg' => 'SHA-512',
            'protocol' => 'application/pgp-signature',
        ]);
    }

    public function getMediaSubtype(): string
    {
        return 'signed';
    }
}
