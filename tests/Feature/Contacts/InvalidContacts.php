<?php

namespace Tests\Feature\Contacts;

trait InvalidContacts
{
    public static function invalidContactsProvider()
    {
        return [
            'missing email' => [
                ['email' => null],
                ['email' => 'required'],
            ],
            'missing nickname' => [
                ['nickname' => null],
                ['nickname' => 'required'],
            ],
            'missing phone' => [
                ['phone' => null],
                ['phone' => 'required']
            ],
            'invalid nickname' => [
                ['nickname' => 'john d0e'],
                ['nickname' => 'letters, numbers, dashes']
            ],
            'too short nickname' => [
                ['nickname' => 'es'],
                ['nickname' => 'at least 3']
            ],
            'too short name' => [
                ['name' => 'es'],
                ['name' => 'at least 3']
            ],
            'invalid email' => [
                ['email' => 'john2doe.com'],
                ['email' => 'valid email address']
            ],
            'invalid phone number' => [
                ['phone' => 'abcd123544'],
                ['phone' => 'format is invalid']
            ],
            'too short phone number' => [
                ['phone' => '089800'],
                ['phone' => 'at least 10']
            ]
        ];
    }
}
