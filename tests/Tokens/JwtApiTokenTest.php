<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyApiToken\Tests\Tokens;

use StepTheFkUp\EasyApiToken\Exceptions\InvalidArgumentException;
use StepTheFkUp\EasyApiToken\Tests\AbstractTestCase;
use StepTheFkUp\EasyApiToken\Tokens\JwtEasyApiToken;

final class JwtEasyApiTokenTest extends AbstractTestCase
{
    /**
     * JwtEasyApiToken should return identical payload as input.
     *
     * @return void
     */
    public function getPayloadSuccessfully(): void
    {
        $payload = ['claim' => 'claim'];

        self::assertEquals($payload, (new JwtEasyApiToken($payload))->getPayload());
    }

    /**
     * JwtEasyApiToken should return expected claim value.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidArgumentException
     */
    public function testGetClaimSuccessfully(): void
    {
        self::assertEquals('claim', (new JwtEasyApiToken(['claim' => 'claim']))->getClaim('claim'));
    }

    /**
     * JwtEasyApiToken should check successfully if claim exists.
     *
     * @return void
     */
    public function testHasClaimSuccessfully(): void
    {
        $token = new JwtEasyApiToken(['claim' => 'claim']);

        self::assertTrue($token->hasClaim('claim'));
        self::assertFalse($token->hasClaim('invalid'));
    }

    /**
     * JwtEasyApiToken should throw an exception when getting a claim which doesn't exist.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidArgumentException
     */
    public function testInvalidClaimException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new JwtEasyApiToken([]))->getClaim('invalid');
    }
}

\class_alias(
    JwtEasyApiTokenTest::class,
    'LoyaltyCorp\EasyApiToken\Tests\Tokens\JwtEasyApiTokenTest',
    false
);
