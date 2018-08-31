<?php

namespace App\Console\Commands\Acl;

use Illuminate\Console\Command;
use App\Models\Role;

class Build extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs the database with the acl config';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->syncRoles(config('system.roles', []));
        $this->info('ACL has been built.');
    }

    protected function syncRoles(array $roles, Role $parent = null)
    {
        foreach ($roles as $slug => $data) {
            // Check if it needs update
            $role = Role::where('slug', $slug)->first();
            $name = isset($data['name']) ? $data['name'] : null;
            $super = isset($data['super']) && $data['super'] ? 1 : 0;
            $children = isset($data['children']) && is_array($data['children']) ? $data['children'] : [];

            // Create the role if missing
            if (is_null($role)) {
                $role = new Role();
                $role->slug = $slug;
            }

            // Update and save role
            $role->name = $name;
            $role->super = $super;
            $role->save();

            // Attach to parent
            if (!is_null($parent)) {
                $parent->addChild($role);
            }

            // Child roles
            if (count($children) > 0) {
                $this->syncRoles($children, $role);
            }
        }
    }
}
