<?php

declare(strict_types=1);

namespace Tests\Part;

use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Part\PGPKeyPart;
use PHPUnit\Framework\TestCase;

#[CoversClass(PGPKeyPart::class)]
final class PGPKeyPartTest extends TestCase
{
    public function testPGPKeyPartWithStandardKeyName()
    {
        $part = (new PGPKeyPart(''))->toString();
        $this->assertStringContainsString('Content-Type: application/pgp-key', $part, 'Content-Type not found');
        $this->assertStringContainsString('Content-Disposition: attachment', $part, 'Content-Disposition not found');
        $this->assertStringContainsString('filename=public-key.asc', $part, 'filename not found');
        $this->assertStringContainsString('Content-Transfer-Encoding: base64', $part, 'Content-Transfer-Encoding not found');
        $this->assertStringContainsString('MIME-Version: 1.0', $part, 'MIME-Version not found');
    }

    public function testPGPKeyPartWithCustomKeyName()
    {
        $part = (new PGPKeyPart('', 'custom.asc'))->toString();
        $this->assertStringContainsString('Content-Type: application/pgp-key', $part, 'Content-Type not found');
        $this->assertStringContainsString('Content-Disposition: attachment', $part, 'Content-Disposition not found');
        $this->assertStringContainsString('filename=custom.asc', $part, 'filename not found');
        $this->assertStringContainsString('Content-Transfer-Encoding: base64', $part, 'Content-Transfer-Encoding not found');
        $this->assertStringContainsString('MIME-Version: 1.0', $part, 'MIME-Version not found');
    }
}
