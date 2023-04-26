# PGP Mailing for Symfony Mailer (WIP)

Implements PGP encryption and signing of a Symfony Message via [Crypt_GPG](https://pear.php.net/package/Crypt_GPG/docs/latest/Crypt_GPG/Crypt_GPG.html).

## Installation

```bash
composer require pulli/pgp-mailer
```

## Functions

Supports:

- encrypting a message
- encrypt and sign a message
- only sign a message

## Caveats

The only signing part isn't working on all of my test clients (probably due to some formatting of the line endings).
It's working with my test clients MailMate and ProtonMail but not in Canary Mail.

## Example file

Can be found [here](https://github.com/the-pulli/pgp-mailer/blob/main/example.php)

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/the-pulli/pgp-mailer.

## License

The package is available as open source under the terms of the [MIT License](https://opensource.org/licenses/MIT).
