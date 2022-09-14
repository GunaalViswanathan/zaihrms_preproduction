<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Menu;
use LaraSnap\LaravelAdmin\Models\MenuItem;
use LaraSnap\LaravelAdmin\Models\Module;
use LaraSnap\LaravelAdmin\Models\Role;
use LaraSnap\LaravelAdmin\Models\Screen;

class AnnouncementAndPolicySeeder extends Seeder
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
        $module1->label ='Announcements';
        $module1->save();
        $module2= new Module();
        $module2->label ='Policy & Documents';
        $module2->save();


        $screens=[
            ['name'=>'announcement.index','label'=>'Announcement List','module_id'=>$module1->id],
            ['name' => 'announcement.create','label' => 'Announcement Create', 'module_id' => $module1->id],
            ['name' => 'announcement.store','label' => 'Announcement Store', 'module_id' => $module1->id],
            ['name' => 'announcement.edit','label' => 'Announcement Edit', 'module_id' => $module1->id],
            ['name' => 'announcement.update','label' => 'Announcement Update', 'module_id' => $module1->id],
            ['name' => 'announcement.destroy','label' => 'Announcement Delete', 'module_id' => $module1->id],
            ['name'=>'policyanddocuments.index','label'=>'Policy and Document List','module_id'=>$module2->id],
            ['name' => 'policyanddocuments.create','label' => 'Policy and Document Create', 'module_id' => $module2->id],
            ['name' => 'policyanddocuments.store','label' => 'Policy and Document Create', 'module_id' => $module2->id],
            ['name' => 'policyanddocuments.edit','label' => 'Policy and Document Edit', 'module_id' => $module2->id] ,
            ['name' => 'policyanddocuments.update','label' => 'Policy and Document Update', 'module_id' => $module2->id],
            ['name' => 'policyanddocuments.destroy','label' => 'Policy and Document Delete', 'module_id' => $module2->id],
        ];
        foreach ($screens as $screen){
            $newScreen=Screen::create($screen);
            $role->assignScreen($newScreen->id);
        }
        $menu=Menu::where('name','admin')->first();
        $menusuperadmin=Menu::where('name','super-admin')->first();
        if($menu){
            $menuItem1 = new MenuItem();
            $menuItem1->title='Announcements';
            $menuItem1->icon='fa-bullhorn';
            $menuItem1->order=3;
            $menuItem1->target='_self';
            $menuItem1->route='announcement.index';
            $menuItem2 = new MenuItem();
            $menuItem2->title='Policy & Documents';
            $menuItem2->icon='fa-lock';
            $menuItem2->order=4;
            $menuItem2->target='_self';
            $menuItem2->route='policyanddocuments.index';

        }

        $menu=$menu->items()->saveMany([$menuItem1,$menuItem2]);
        $menusuperadmin=$menusuperadmin->items()->saveMany([$menuItem1,$menuItem2]);

    }
}
