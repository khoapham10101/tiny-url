<?php

namespace App\Models;

use App\Helper\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kyslik\ColumnSortable\Sortable;

class Url extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'short_url',
        'long_url',
        'hits',
        'user_id'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'urls';

    public $sortable = [
        'id',
        'short_url',
        'long_url',
        'hits',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function findOneByUser($id, Request $request)
    {
        $url = self::select('*')
            ->where('id', '=', $id)
            ->where('user_id', '=', $request->user()->id)
            ->first();
        Helpers::rememberForever($url->short_url, $url->long_url);
        return $url;
    }

    public function findOneByPath($path)
    {
        $url = self::select('*')
            ->where('short_url', '=', $path)
            ->first();
        Helpers::rememberForever($url->short_url, $url->long_url);
        return $url;
    }
}
