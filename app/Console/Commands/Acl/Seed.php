<?php

namespace App\Console\Commands\Acl;

use Illuminate\Console\Command;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Seed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:seed {--domain=} {--role=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds one user for each role';

    /**
     * This is the place where you can add new properties to the user before it is saved
     *
     * @param User $user
     */
    protected function user(User $user, Role $role)
    {
        $user->first_name = ucfirst($role->slug);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Prepare arguments
        $domain = $this->option('domain');

        if (!isset($domain) || (strlen($domain) === 0)) {
            $domain = 'morningtrain.dk';
        }

        $rolesSlugs = $this->option('role');

        // Prepare data
        $query = Role::query();

        if (is_array($rolesSlugs) && !empty($rolesSlugs)) {
            $query->whereIn('slug', $rolesSlugs);
        }

        $roles = $query->get();

        foreach ($roles as $role) {
            // Only seed leaf nodes
            if (!$role->isLeaf()) {
                continue;
            }

            // Check if a user with this role already exists
            $user = User::assigned([$role])->first();

            if (!is_null($user)) {
                continue;
            }

            // Create the user
            $user = new User();
            $user->email = $role->slug . "@$domain";
            $user->password = Hash::make($role->slug);

            // Call user
            $this->user($user, $role);

            $user->save();

            // Attach the role
            $user->assign([$role]);
        }

        $this->info('ACL has been seeded!');
    }
}
