<?php

namespace Silassiai\LaravelEmailValidation\Tests\Unit;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Silassiai\LaravelEmailValidation\Services\MailProviderDomainService;
use Silassiai\LaravelEmailValidation\Validation\EmailValidation;

class EmailValidationTest extends TestCase
{
    private function makeValidation(): EmailValidation
    {
        $all = new Collection(['hotmail' => ['com', 'nl']]);

        return new EmailValidation(
            new MailProviderDomainService($all),
            new MailProviderDomainService($all),
            new MailProviderDomainService(new Collection([]))
        );
    }

    public function testForWiresUpNormalizedEmail(): void
    {
        $validation = $this->makeValidation();

        $this->assertTrue($validation->for('User@Hotmail.com')->hasValidDomain());
    }

    public function testForReturnsFalseForUnknownDomain(): void
    {
        $validation = $this->makeValidation();

        $this->assertFalse($validation->for('x@example.com')->hasValidDomain());
    }
}
