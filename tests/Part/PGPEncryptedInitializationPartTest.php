<?php

declare(strict_types=1);

namespace Tests\Part;

use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Part\PGPEncryptedInitializationPart;
use PHPUnit\Framework\TestCase;

#[CoversClass(PGPEncryptedInitializationPart::class)]
final class PGPEncryptedInitializationPartTest extends TestCase
{
    public function testPGPEncryptedInitializationPart()
    {
        $part = (new PGPEncryptedInitializationPart())->toString();
        $this->assertStringContainsString('Content-Type: application/pgp-encrypted', $part, 'Content-Type not found');
        $this->assertStringContainsString('Content-Disposition: attachment', $part, 'Content-Disposition not found');
        $this->assertStringContainsString("\r\n\r\nVersion: 1\r\n", $part, 'Version not found');
    }
}
