@php
$empRole = \LaraSnap\LaravelAdmin\Models\Role::where('name', 'employee')->first();
$adRole = \LaraSnap\LaravelAdmin\Models\Role::where('name', 'admin')->first();
$role = auth()->user()->user_role->role_id;
@endphp
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" >
   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="<!-- sidebar-brand-text mx-3 -->" style="display: block;">
         @if(setting('site_logo'))
            <img class="<!-- logo sidebar-logo -->" src="{{ storageUrl(config('larasnap.uploads.site_settings.path')) .'/'. setting('site_logo') }}" alt="logo" style="width:100px;">
         @else
            {{ setting('site_name') }}
         @endif
      </div>
   </a>
   <!-- Divider -->
   <hr class="sidebar-divider my-0">
   <!-- SideBar Menu -->
    @if($role == $empRole->id)
    {!! menu('employee') !!}
    @elseif($role == $adRole->id)
    {!! menu('admin') !!}
    @else
    {!! menu(config('larasnap.menu.default_sidebar_menu')) !!}
    @endif

   <!-- SideBar Menu -->
   <!-- Sidebar Toggler (Sidebar) -->
   <!-- <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div> -->
</ul>
