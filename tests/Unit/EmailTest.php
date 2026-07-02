<?php

namespace Silassiai\LaravelEmailValidation\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Silassiai\LaravelEmailValidation\Validation\Email;

class EmailTest extends TestCase
{
    public function testNormalizesToLowercaseAndParsesTwoLabelDomain(): void
    {
        $email = new Email('FOO@BAR.COM');

        $this->assertSame('foo@bar.com', $email->email);
        $this->assertSame('bar.com', $email->getDomain());
        $this->assertSame('bar', $email->getDomainName());
        $this->assertSame('com', $email->getTld());
    }

    public function testParsesPlainTwoLabelDomain(): void
    {
        $email = new Email('a@bar.com');

        $this->assertSame('bar', $email->getDomainName());
        $this->assertSame('com', $email->getTld());
    }

    public function testUsesRegistrableDomainForSubdomains(): void
    {
        $email = new Email('a@sub.example.org');

        $this->assertSame('example', $email->getDomainName());
        $this->assertSame('org', $email->getTld());
    }

    public function testHandlesSingleLabelDomainWithoutTld(): void
    {
        $email = new Email('a@localhost');

        $this->assertSame('localhost', $email->getDomainName());
        $this->assertSame('', $email->getTld());
    }

    public function testIgnoresTrailingDotEmptyLabels(): void
    {
        $email = new Email('a@bar.com.');

        $this->assertSame('bar', $email->getDomainName());
        $this->assertSame('com', $email->getTld());
    }
}
