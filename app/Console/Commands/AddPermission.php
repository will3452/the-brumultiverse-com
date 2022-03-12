<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class AddPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:permission {permission_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new permission, if the given argument is equal to the word "all" this will create permissions base from the file /public/setup/permissions.txt';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function generatePermission(string $permissionName)
    {
        $permissions = [
            "view list: $permissionName",
            "view details: $permissionName",
            "create $permissionName",
            "update $permissionName",
            "delete $permissionName",
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'group'=>Str::plural($permissionName),
                'name'=>$permission,
            ]);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissionName = $this->argument('permission_name');

        $arr = Arr::wrap($permissionName);

        if ($permissionName === 'all') {
            $rawArray = [
                // "art scene",
                // "audio book",
                // "book",
                // "film",
                // "category",
                // "chapter",
                // "club",
                // "college",
                // "course",
                // "epilogue",
                // "free art scene",
                // "genre",
                // "inquiry",
                // "interest",
                // "language",
                // "level",
                // "media",
                // "permission",
                // "podcast",
                // "policy",
                // "prologue",
                // "review question",
                // "role",
                // "song",
                // "user",
                // "account",
                // "series",
                // "file",
                // "collection",
                // "album",
                // 'publish approval',
                // 'brunity',
                'group type',
                'group',
                'group member',
                'pending account',
                'pending group',
                'group invitation',
                // 'invitation',
            ];
            $arr = collect($rawArray)->filter(fn ($a) => strlen($a));
        }

        foreach ($arr as $name) {
            $this->generatePermission($name);
        }

        error_log(' permission(s) has been created!');
        return 0;
    }
}
