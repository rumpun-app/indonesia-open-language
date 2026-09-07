<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RbacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect(['language.view','language.create','contribution.create','contribution.submit','review.create','entry.publish','moderation.manage'])->mapWithKeys(fn ($slug) => [$slug => Permission::updateOrCreate(['slug' => $slug], ['name' => str($slug)->headline()])]);
        foreach (['learner' => ['language.view'], 'contributor' => ['language.view','contribution.create','contribution.submit'], 'reviewer' => ['language.view','review.create'], 'administrator' => $permissions->keys()->all()] as $roleSlug => $slugs) {
            $role = Role::updateOrCreate(['slug' => $roleSlug], ['name' => str($roleSlug)->headline()]);
            $role->permissions()->sync($permissions->only($slugs)->pluck('id'));
        }
    }
}
