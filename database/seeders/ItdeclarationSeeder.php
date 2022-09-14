<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Menu;
use LaraSnap\LaravelAdmin\Models\MenuItem;
use LaraSnap\LaravelAdmin\Models\Module;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class ItdeclarationSeeder extends Seeder
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
        $module1->label ='IT Declaration';
        $module1->save();
        $screens=[
            ['name'=>'itdeclaration.index','label'=>'IT Declaration List','module_id'=>$module1->id],
            ['name' => 'itdeclaration.create','label' => 'IT Declaration Create', 'module_id' => $module1->id],
            ['name' => 'itdeclaration.edit','label' => 'IT Declaration Edit', 'module_id' => $module1->id],
            ['name' => 'itdeclaration.show','label' => 'IT Declaration View', 'module_id' => $module1->id],
            ['name' => 'itdeclaration.destroy','label' => 'IT Declaration Delete', 'module_id' => $module1->id],
        ];
        foreach ($screens as $screen){
            $newScreen=Screen::create($screen);
            $role->assignScreen($newScreen->id);
        }
        $menus=Menu::whereIn('name',['super-admin','admin','employee'])->get();
        foreach ($menus as $menu){
            $menuItem1 = new MenuItem();
            $menuItem1->title='IT Declaration';
            $menuItem1->icon='fa-file';
            $menuItem1->order=6;
            $menuItem1->target='_self';
            $menuItem1->route='itdeclaration.index';
            $menu=$menu->items()->saveMany([$menuItem1]);
        }
    }
}
