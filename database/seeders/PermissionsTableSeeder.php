<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'projektleitung_access',
            ],
            [
                'id'    => 18,
                'title' => 'supporter_access',
            ],
            [
                'id'    => 19,
                'title' => 'team_create',
            ],
            [
                'id'    => 20,
                'title' => 'team_edit',
            ],
            [
                'id'    => 21,
                'title' => 'team_show',
            ],
            [
                'id'    => 22,
                'title' => 'team_delete',
            ],
            [
                'id'    => 23,
                'title' => 'team_access',
            ],
            [
                'id'    => 24,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 25,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 26,
                'title' => 'tebex_lizenzen_create',
            ],
            [
                'id'    => 27,
                'title' => 'tebex_lizenzen_edit',
            ],
            [
                'id'    => 28,
                'title' => 'tebex_lizenzen_show',
            ],
            [
                'id'    => 29,
                'title' => 'tebex_lizenzen_delete',
            ],
            [
                'id'    => 30,
                'title' => 'tebex_lizenzen_access',
            ],
            [
                'id'    => 31,
                'title' => 'kategorien_create',
            ],
            [
                'id'    => 32,
                'title' => 'kategorien_edit',
            ],
            [
                'id'    => 33,
                'title' => 'kategorien_show',
            ],
            [
                'id'    => 34,
                'title' => 'kategorien_delete',
            ],
            [
                'id'    => 35,
                'title' => 'kategorien_access',
            ],
            [
                'id'    => 36,
                'title' => 'item_create',
            ],
            [
                'id'    => 37,
                'title' => 'item_edit',
            ],
            [
                'id'    => 38,
                'title' => 'item_show',
            ],
            [
                'id'    => 39,
                'title' => 'item_delete',
            ],
            [
                'id'    => 40,
                'title' => 'item_access',
            ],
            [
                'id'    => 41,
                'title' => 'fahrzeuge_create',
            ],
            [
                'id'    => 42,
                'title' => 'fahrzeuge_edit',
            ],
            [
                'id'    => 43,
                'title' => 'fahrzeuge_show',
            ],
            [
                'id'    => 44,
                'title' => 'fahrzeuge_delete',
            ],
            [
                'id'    => 45,
                'title' => 'fahrzeuge_access',
            ],
            [
                'id'    => 46,
                'title' => 'werkbanke_create',
            ],
            [
                'id'    => 47,
                'title' => 'werkbanke_edit',
            ],
            [
                'id'    => 48,
                'title' => 'werkbanke_show',
            ],
            [
                'id'    => 49,
                'title' => 'werkbanke_delete',
            ],
            [
                'id'    => 50,
                'title' => 'werkbanke_access',
            ],
            [
                'id'    => 51,
                'title' => 'shop_create',
            ],
            [
                'id'    => 52,
                'title' => 'shop_edit',
            ],
            [
                'id'    => 53,
                'title' => 'shop_show',
            ],
            [
                'id'    => 54,
                'title' => 'shop_delete',
            ],
            [
                'id'    => 55,
                'title' => 'shop_access',
            ],
            [
                'id'    => 56,
                'title' => 'support_create',
            ],
            [
                'id'    => 57,
                'title' => 'support_edit',
            ],
            [
                'id'    => 58,
                'title' => 'support_show',
            ],
            [
                'id'    => 59,
                'title' => 'support_delete',
            ],
            [
                'id'    => 60,
                'title' => 'support_access',
            ],
            [
                'id'    => 61,
                'title' => 'datenbank_create',
            ],
            [
                'id'    => 62,
                'title' => 'datenbank_edit',
            ],
            [
                'id'    => 63,
                'title' => 'datenbank_show',
            ],
            [
                'id'    => 64,
                'title' => 'datenbank_delete',
            ],
            [
                'id'    => 65,
                'title' => 'datenbank_access',
            ],
            [
                'id'    => 66,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
