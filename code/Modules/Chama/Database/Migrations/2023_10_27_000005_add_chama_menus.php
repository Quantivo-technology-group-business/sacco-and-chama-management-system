<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddChamaMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Admin Menu
        $chamaParentId = DB::table('menus')->insertGetId([
            'parent_id' => null,
            'is_parent' => 1,
            'name' => 'Chama/Merry-Go-Round',
            'slug' => 'chama',
            'description' => 'Chama Module',
            'menu_order' => 31,
            'url' => 'chama/group',
            'permissions' => 'chama.groups.index',
            'icon' => 'fas fa-sync',
            'module' => 'Chama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menus')->insert([
            'parent_id' => $chamaParentId,
            'parent_slug' => 'chama',
            'is_parent' => 0,
            'name' => 'Manage Groups',
            'slug' => 'manage_chama_groups',
            'menu_order' => 1,
            'url' => 'chama/group',
            'permissions' => 'chama.groups.index',
            'icon' => 'far fa-circle',
            'module' => 'Chama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Portal Menu
        DB::table('menus')->insert([
            'parent_id' => null,
            'is_parent' => 1,
            'name' => 'My Chamas',
            'slug' => 'portal_chamas',
            'description' => 'Member Chama Portal',
            'menu_order' => 5,
            'url' => 'portal/chama',
            'permissions' => 'portal.chama.index',
            'icon' => 'fas fa-sync',
            'module' => 'Portal',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menus')->where('module', 'Chama')->delete();
        DB::table('menus')->where('slug', 'portal_chamas')->delete();
    }
}
