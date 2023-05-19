<?php
namespace App\Traits;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
trait FileUploadTrait
{
    public function storeFile(UploadedFile $file,$path='',$fileableType,$fileableId,$fileType,$disc='public')
    {
        $fileName=generate_random_filename($file->getClientOriginalExtension());
        $filePath = $file->storeAs($path,$fileName);
       return File::create([
            'file_name'=> $fileType,
            'file_path'=> $filePath,
            'fileable_type'=>$fileableType,
            'fileable_id'=>$fileableId
        ]);
    }
}
