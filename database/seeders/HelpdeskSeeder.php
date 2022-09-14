<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Menu;
use LaraSnap\LaravelAdmin\Models\MenuItem;
use LaraSnap\LaravelAdmin\Models\Module;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class HelpdeskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::where('name','super-admin')->first();
        $module1= new Module();
        $module1->label ='Help Desk';
        $module1->save();
        $screens=[
            ['name'=>'helpdesks.index','label'=>'Help Desk List','module_id'=>$module1->id],
            ['name' => 'helpdesks.create','label' => 'Help Desk Create', 'module_id' => $module1->id],
            ['name' => 'helpdesks.store','label' => 'Help Desk Store', 'module_id' => $module1->id],
            ['name' => 'helpdesks.edit','label' => 'Help Desk Edit', 'module_id' => $module1->id],
            ['name' => 'helpdesks.update','label' => 'Help Desk Update', 'module_id' => $module1->id],
            ['name' => 'helpdesks.destroy','label' => 'Help Desk Delete', 'module_id' => $module1->id],
        ];
        foreach ($screens as $screen){
            $newScreen=Screen::create($screen);
            $role->assignScreen($newScreen->id);
        }
        $menus=Menu::whereIn('name',['super-admin','admin','employee'])->get();
        foreach ($menus as $menu){
            $menuItem1 = new MenuItem();
            $menuItem1->title='Help Desk';
            $menuItem1->icon='fa-hands-helping';
            $menuItem1->order=6;
            $menuItem1->target='_self';
            $menuItem1->route='helpdesks.index';
            $menu=$menu->items()->saveMany([$menuItem1]);
        }

    }
}
