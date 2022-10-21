<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'totalLink',
        'targetLink'
    ];

    /**
     *
     * @param int $id
     *
     * @return string
     */
    public function getToltalLink($id)
    {
        $totalLink = DB::table('count_links')->where('id', $id)->value('totalLink');
        return $totalLink;
    }

    public function updateToltalLink($id, $ttLink)
    {
        $link = DB::table('count_links')->where('id', $id)->update(array('totalLink' => DB::raw('totalLink + ' . $ttLink)));
        return $link;
    }

    public function getTargetLink($id)
    {
        $totalLink = DB::table('count_links')->where('id', $id)->value('targetLink');
        return $totalLink;
    }

    public function updateTargetLink($id, $target)
    {
        $tgLink = DB::table('count_links')->where('id', $id)->update(array('targetLink' => $target));
        return $tgLink;
    }

    public function resetLink($id) {
        $updateLink = DB::table('count_links')->where('id', $id)->update(array('targetLink' => '0', 'totalLink' => '0'));
        return $updateLink;
    }
}
