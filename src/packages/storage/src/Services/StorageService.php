<?php
namespace GGPHP\Storage\Services;

use GGPHP\Storage\Models\UploadFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * Add file
     * @param array  $attributes
     * @param int $id         [id of object]
     */
    public static function add($files, $id, $modelType)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                $attributes['type'] = UploadFile::FILE;
                $name = $file->store('files');
                $link = Storage::url($name);
                $attributes['object_id'] = $id;
                $attributes['object_type'] = $modelType;
                $attributes['path'] = $link;
                $attributes['name'] = $file->getClientOriginalName();

                $uploadFile = UploadFile::create($attributes);
            }
        } else {
            $attributes['type'] = UploadFile::FILE;
            $name = $files->store('files');
            $link = Storage::url($name);
            $attributes['object_id'] = $id;
            $attributes['object_type'] = $modelType;
            $attributes['path'] = $link;
            $attributes['name'] = $files->getClientOriginalName();

            $uploadFile = UploadFile::create($attributes);
        }

    }

    /**
     * Delete File by id and type of object
     * @param  [id] $id   [description]
     * @param  [string] $type [type object]
     */
    public static function delete($id)
    {
        $query = UploadFile::whereIn('id', $id);
        $uploadFile = $query->get();

        foreach ($uploadFile as $upFile) {
            $name = explode('/', $upFile->path);
            Storage::delete("/files/$name[3]");
        }

        return $query->delete();
    }

}
