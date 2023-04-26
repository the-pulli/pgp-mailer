<?php

declare(strict_types=1);

namespace Tests\Part\Multipart;

use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Part\Multipart\PGPEncryptedPart;
use PHPUnit\Framework\TestCase;

#[CoversClass(PGPEncryptedPart::class)]
final class PGPEncryptedPartTest extends TestCase
{
    public function testPGPEncryptedPart()
    {
        $part = (new PGPEncryptedPart())->toString();
        $this->assertStringContainsString('Content-Type: multipart/encrypted', $part, 'Content-Type not found.');
        $this->assertStringContainsString('protocol="application/pgp-encrypted"', $part, 'Protocol not found');
    }
}
