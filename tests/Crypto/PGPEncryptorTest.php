<?php

declare(strict_types=1);

namespace Tests\Crypto;

use Crypt_GPG;
use PHPUnit\Framework\Attributes\CoversClass;
use Pulli\Mime\Crypto\PGPEncrypter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

#[CoversClass(PGPEncrypter::class)]
final class PGPEncryptorTest extends TestCase
{
    private Crypt_GPG $gpg;

    private Email $email;

    private PGPEncrypter $encrypter;

    public function setUp(): void
    {
        parent::setUp();
        $this->gpg = new Crypt_GPG();
        $this->gpg->importKeyFile(__DIR__ . '/../Fixtures/_data/pgp.asc');
        $this->email = (new Email())
            ->from(new Address('pgp@pulli.dev', 'PuLLi'))
            ->to(new Address('pgp@pulli.dev', 'PuLLi'))
            ->text("Hello there!\n\nHow are you?")
            ->subject('PGP Mail');
        $this->encrypter = new PGPEncrypter();
    }

    public function tearDown(): void
    {
        $this->removeKey('pgp@pulli.dev');
        parent::tearDown();
    }

    public function testEncrypting()
    {
        $encrypted = ($this->encrypter->encrypt($this->email))->toString();
        $this->assertStringContainsString('-----BEGIN PGP MESSAGE-----', $encrypted);
        $this->assertStringContainsString('-----END PGP MESSAGE-----', $encrypted);
    }

    public function testEncryptingAndSigning()
    {
        $encrypted = ($this->encrypter->encryptAndSign($this->email, 'test1234'))->toString();
        $this->assertStringContainsString('-----BEGIN PGP MESSAGE-----', $encrypted);
        $this->assertStringContainsString('-----END PGP MESSAGE-----', $encrypted);
        $this->assertStringNotContainsString('-----BEGIN PGP SIGNATURE-----', $encrypted);
        $this->assertStringNotContainsString('-----END PGP SIGNATURE-----', $encrypted);
    }

    public function testSigning()
    {
        $this->encrypter->sign($this->email, 'test1234');
        $this->assertStringContainsString('-----BEGIN PGP SIGNATURE-----', $this->encrypter->signature);
        $this->assertStringContainsString('-----END PGP SIGNATURE-----', $this->encrypter->signature);

        $key = $this->gpg->verify($this->encrypter->signed, $this->encrypter->signature);
        $this->assertCount(1, $key);
        $this->assertEquals('pgp@pulli.dev', $key[0]->getUserId()->getEmail());
    }

    private function removeKey(string $name)
    {
        $this->gpg->deletePrivateKey($name);
        $this->gpg->deletePublicKey($name);
    }
}
