<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class My_Parent extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
    protected $table = 'my__parents';
    protected $guarded=[];

    public function attachments(){
        return $this->hasMany(ParentAttachment::class, 'parent_id', 'id');
    }
}
