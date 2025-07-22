<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Administrator Role
         */
        $administrator = Role::firstOrCreate(
            [
                'name' => 'Administrator',
                'guard_name' => 'admin',
            ]
        );

        /**
         * Assign role to the admin
         */
        $admin = Admin::findOrFail(1);
        $admin->assignRole($administrator);

        /**
         * Categories Permission
         */
        $categories = [
            'Read Category',
            'Create Category',
            'Update Category',
            'Delete Category',
        ];

        foreach($categories as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Categories',
                ]
            );
        }

        /**
         * News Permission
         */
        $news = [
            'Read News',
            'Create News',
            'Update News',
            'Delete News',
        ];

        foreach($news as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'News',
                ]
            );
        }

        /**
         * Subscribers Permission
         */
        $subscribers = [
            'Read Subscriber',
            'Delete Subscriber',
        ];

        foreach($subscribers as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Subscribers',
                ]
            );
        }

        /**
         * Permissions Permission
         */
        $permissions = [
            'Read Permission',
            'Create Permission',
            'Update Permission',
            'Delete Permission',
        ];

        foreach($permissions as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Permissions',
                ]
            );
        }

        /**
         * Languages Permission
         */
        $languages = [
            'Read Language',
            'Create Language',
            'Update Language',
            'Delete Language',
        ];

        foreach($languages as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Languages',
                ]
            );
        }

        /**
         * Home Permission
         */
        $homes = [
            'Read Home',
            'Update Home',
        ];

        foreach($homes as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Home',
                ]
            );
        }

        /**
         * Footer Permission
         */
        $footers = [
            'Read Footer',
            'Create Footer',
            'Update Footer',
            'Delete Footer',
        ];

        foreach($footers as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Footer',
                ]
            );
        }

        /**
         * Social Media Permission
         */
        $socialmedia = [
            'Read Social',
            'Create Social',
            'Update Social',
            'Delete Social',
        ];

        foreach($socialmedia as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Social Media',
                ]
            );
        }

        /**
         * Advertisements Permission
         */
        $advertisements = [
            'Read Advertisement',
            'Update Advertisement',
        ];

        foreach($advertisements as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Advertisements',
                ]
            );
        }

        /**
         * Platforms Permission
         */
        $platforms = [
            'Read Platform',
            'Create Platform',
            'Update Platform',
            'Delete Platform',
        ];

        foreach($platforms as $item) {
            Permission::firstOrCreate(
                [
                    'name' => $item,
                    'guard_name' => 'admin',
                    'group_name' => 'Platforms',
                ]
            );
        }
    }
}
