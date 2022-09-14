<?php

namespace App\Services;

use LaraSnap\LaravelAdmin\Models\Setting;
use LaraSnap\LaravelAdmin\Traits\Upload;
use File;

class SettingServices
{
    use Upload;

    public function store($name, $value)
    {

        if($name=='admin_notification'){
            $data= implode(',',$value);
        }
        else{
            $data = $value;
        }
        $setting = Setting::where('name', $name)->first();
        if($setting) {
            $setting->update(['value' => $data]);
        }
    }

    public function storeAttachement($name, $value, $request)
    {
        /* handle if attachement uploaded*/
        if ($request->has($name)) {
            $attachement = $request->file($name);
            $folder = config('larasnap.uploads.site_settings.path');
            $exAttachement = setting($name);
            if ($exAttachement) {
                File::delete(storage_path() .'/app/' .$folder .'/'.  $exAttachement);
            }
            $attachement_name = $this->upload($attachement, $folder);

            $this->store($name, $attachement_name);
        }
    }

}