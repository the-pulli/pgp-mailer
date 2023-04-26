<?php

declare(strict_types=1);

namespace Tests\Part;

use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Part\PGPEncryptedMessagePart;
use PHPUnit\Framework\TestCase;

#[CoversClass(PGPEncryptedMessagePart::class)]
final class PGPEncryptedMessagePartTest extends TestCase
{
    public function testPGPEncryptedMessagePart()
    {
        $part = (new PGPEncryptedMessagePart(''))->toString();
        $this->assertStringContainsString('Content-Type: application/octet-stream', $part, 'Content-Type not found');
        $this->assertStringContainsString('Content-Disposition: inline', $part, 'Content-Disposition not found');
        $this->assertStringContainsString('filename=msg.asc', $part, 'filename not found');
    }
}
