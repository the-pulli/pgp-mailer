<?php

require __DIR__ . '/vendor/autoload.php';

use Pulli\Mime\Crypto\PGPEncrypter;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

$email = (new Email())
    ->from(new Address('the@pulli.dev', 'PuLLi'))
    ->to(new Address('fabien@symfony.com', 'Fabien Potencier'))
    ->text("Hello there!\n\nHow are you?")
    ->subject('PGP Mail')
    ->attachFromPath('SomeFile.pdf');

$transport = Transport::fromDsn('valid_dsn');
$mailer = new Mailer($transport);

$pgpEncryptor = new PGPEncrypter();
// only needed if you have more than one key belonging to the from-email address
$pgpEncryptor->signingKey('key_identifier');
// method arguments: Message $message, string $passphrase, bool $attachKey
$messageSigned = $pgpEncryptor->sign($email, 'signing_key_passphrase', true);
// method arguments: Message $message, string $passphrase, bool $attachKey
$messageEncryptedAndSigned = $pgpEncryptor->encryptAndSign($email, 'signing_key_passphrase', true);
// method arguments: Message $message, bool $attachKey
$messageEncrypted = $pgpEncryptor->encrypt($email, true);

$mailer->send($messageSigned);
$mailer->send($messageEncryptedAndSigned);
$mailer->send($messageEncrypted);
