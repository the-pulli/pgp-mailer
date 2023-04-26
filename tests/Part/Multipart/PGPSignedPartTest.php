<?php

declare(strict_types=1);

namespace Tests\Part\Multipart;

use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Part\Multipart\PGPSignedPart;
use PHPUnit\Framework\TestCase;

#[CoversClass(PGPSignedPart::class)]
final class PGPSignedPartTest extends TestCase
{
    public function testPGPSignedPart()
    {
        $part = (new PGPSignedPart())->toString();
        $this->assertStringContainsString('Content-Type: multipart/signed', $part, 'Content-Type not found');
        $this->assertStringContainsString('micalg=SHA-512', $part, 'micalg not found');
        $this->assertStringContainsString('protocol="application/pgp-signature"', $part, 'protocol not found');
    }
}
