<?php

namespace Tests\Feature\ContactGroups;

trait InvalidContactGroups
{
    public static function invalidContactGroupsProvider()
    {
        return [
            'missing name' => [
                ['name' => null],
                ['name' => 'required'],
            ],
            'too short name' => [
                ['name' => 'es'],
                ['name' => 'at least 3']
            ],
        ];
    }
}
