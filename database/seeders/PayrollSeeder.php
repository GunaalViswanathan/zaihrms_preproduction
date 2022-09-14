<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Menu;
use LaraSnap\LaravelAdmin\Models\MenuItem;
use LaraSnap\LaravelAdmin\Models\Module;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class PayrollSeeder extends Seeder
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
        $module1->label ='Payroll Management';
        $module1->save();
        $screens=[
            ['name'=>'payrolls.index','label'=>'Payroll List','module_id'=>$module1->id],
            ['name' => 'payrolls.generate','label' => 'Generate Pay Slip', 'module_id' => $module1->id],
            ['name' => 'payrolls.download','label' => 'Download Pay Slip', 'module_id' => $module1->id],
        ];
        foreach ($screens as $screen){
            $newScreen=Screen::create($screen);
            $role->assignScreen($newScreen->id);
        }
        $menus=Menu::whereIn('name',['super-admin','admin'])->get();
        foreach ($menus as $menu){
            $menuItem1 = new MenuItem();
            $menuItem1->title='Payroll Management';
            $menuItem1->icon='fa-money';
            $menuItem1->order=6;
            $menuItem1->target='_self';
            $menuItem1->route='payrolls.index';
            $menu=$menu->items()->saveMany([$menuItem1]);
        }

    }
}
