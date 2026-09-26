<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Tim;

/**
 * @property int $id
 * @property int $id_tim
 * @property string $judul
 * @property string $file_path
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Tim $tim
 */
class Submission extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_tim', 'judul', 'file_path', 'data', 'token', 'created_at', 'updated_at', 'deleted_at'];

    public static function createSubmissionPenyisihan1($id_tim, $judul, $path, $token, $file){

        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $upload = Storage::disk('public_uploads')->putFile($path, $file);
        } else {
            $upload = $file;
        }

        if(!$upload){
            return false;
        }

        $submission = Submission::create([
            'id_tim' => $id_tim,
            'judul' => $judul,
            'file_path' => $upload,
            'token' => $token
        ]);

        return $submission;
    }

    public static function createSubmissionPenyisihan2($id_tim, $judul, $path, $data, $token, $file = ''){
        
        $tim = Tim::where('id', $id_tim)->get()->first();
        if ($tim->id_kategori == 2){
            $submission = Submission::create([
                'id_tim' => $id_tim,
                'judul' => $judul,
                'file_path' => $path,
                'data' => $data . '',
                'token' => $token
            ]);
            
            return $submission;
        } else {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $upload = Storage::disk('public_uploads')->putFile($path, $file);
            } else {
                $upload = $file;
            }

            if(!$upload){
                return false;
            }
            
            $submission = Submission::create([
                'id_tim' => $id_tim,
                'judul' => $judul,
                'file_path' => $upload,
                'data' => $data . '',
                'token' => $token
            ]);
    
            return $submission;
        }
    }

    public static function createSubmissionFinal($id_tim, $judul, $path, $token, $file){

        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $upload = Storage::disk('public_uploads')->putFile($path, $file);
        } else {
            $upload = $file;
        }

        if(!$upload) {
            return false;
        }

        $submission = Submission::create([
            'id_tim' => $id_tim,
            'judul' => $judul,
            'file_path' => $upload,
            'token' => $token
        ]);

        return $submission;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tim()
    {
        return $this->belongsTo('App\Tim', 'id_tim');
    }
}
