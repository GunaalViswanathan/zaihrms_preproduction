<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Menu;
use LaraSnap\LaravelAdmin\Models\MenuItem;
use LaraSnap\LaravelAdmin\Models\Module;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=Role::where('name','super-admin')->first();
        $adminrole=Role::where('name','admin')->first();
        $module1= new Module();
        $module1->label ='Holidays';
        $module1->save();

        $screens=[
            ['name'=>'holidays.index','label'=>'Holiday List','module_id'=>$module1->id],
            ['name' => 'holidays.create','label' => 'Holiday Create', 'module_id' => $module1->id],
            ['name' => 'holidays.store','label' => 'Holiday Store', 'module_id' => $module1->id],
            ['name' => 'holidays.edit','label' => 'Holiday Edit', 'module_id' => $module1->id],
            ['name' => 'holidays.update','label' => 'Holiday Update', 'module_id' => $module1->id],
            ['name' => 'holidays.destroy','label' => 'Holiday Delete', 'module_id' => $module1->id],
            ];
        foreach ($screens as $screen){
            $newScreen=Screen::create($screen);
            $role->assignScreen($newScreen->id);
            $adminrole->assignScreen($newScreen->id);
        }
        $menu=Menu::where('name','admin')->first();
        $menusuperadmin=Menu::where('name','super-admin')->first();
        if($menu){
            $menuItem1 = new MenuItem();
            $menuItem1->title='Holidays';
            $menuItem1->icon='fa-list';
            $menuItem1->order=3;
            $menuItem1->target='_self';
            $menuItem1->route='holidays.index';
            $menu=$menu->items()->saveMany([$menuItem1]);
        }
        if($menusuperadmin){
            $menuItem1 = new MenuItem();
            $menuItem1->title='Holidays';
            $menuItem1->icon='fa-list';
            $menuItem1->order=3;
            $menuItem1->target='_self';
            $menuItem1->route='holidays.index';
            $menusuperadmin=$menusuperadmin->items()->saveMany([$menuItem1]);
        }


    }
}
