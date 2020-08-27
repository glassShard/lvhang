<?php

namespace App\Http\Controllers\Api\V1;

use App\Device;
use App\Gallery;
use App\Http\Controllers\Controller;
use App\LiveRef;
use App\LiveRefPlace;
use App\News;
use App\Record;
use Illuminate\Http\Request;
use Te7aHoudini\LaravelTrix\Models\TrixRichText;

class SearchController extends Controller
{
    public function searchQuery(Request $request, $orig_query) {
        $query = str_replace('_', ' ', $orig_query);
        
        $records = Record::where([
            ['performer', 'LIKE', '%'.$query.'%'] 
        ])->orWhere([
            ['title', 'LIKE', '%'.$query.'%']
        ])->get()->toArray();

        $record_contents = TrixRichText::where([
            ['content', 'LIKE', '%'.$query.'%'],
            ['model_type', '=', 'App\Record']
        ])->get();

        $record_ids = [];
        
        foreach ($records as $record) {
            $record_ids[] = $record['id'];
        };

        foreach ($record_contents as $record_content) {
            $newRec = Record::find($record_content->model_id);
            
            if (!in_array($newRec['id'], $record_ids) && $newRec !== null) {
                $records[] = $newRec;
            }
        }

        $news = News::where([
            ['title', 'LIKE', '%'.$query.'%'] 
        ])->get()->toArray();

        $news_contents = TrixRichText::where([
            ['content', 'LIKE', '%'.$query.'%'],
            ['model_type', '=', 'App\News']
        ])->get();

        $news_ids = [];
        
        foreach ($news as $new) {
            $news_ids[] = $new['id'];
        };
        
        foreach ($news_contents as $news_content) {
            $newNews = News::find($news_content->model_id);
            
            if (!in_array($newNews['id'], $news_ids) AND $newNews !== null) {
                $news[] = $newNews;
            }
        }

        $referencePlaces = LiveRefPlace::where([
            ['name', 'LIKE', '%'.$query.'%']
        ])->get()->toArray();

        $references = LiveRef::where([
            ['performer', 'LIKE', '%'.$query.'%']
        ])->get()->toArray();

        $devices = Device::where([
            ['name', 'LIKE', '%'.$query.'%'] 
        ])->get();

        $galleries = Gallery::where([
            ['title', 'LIKE', '%'.$query.'%']
        ])->get();

        $foot = [];

        if (!empty($referencePlaces) OR !empty($references)) {
            $foot[] = 'live';
        }

        foreach ($devices as $device) {
            $parent = null;
            if ($device->parent_id === null) {
                $parent = $device;
            } else {
                $parent = $this->checkParent($device->parent_id);
            }
            
            if ($parent->id === 1) {
                $str = 'live';
            }
            if ($parent->id === 2) {
                $str = 'studio';
            }
            if (!in_array($str, $foot)) {
                $foot[] = $str;
            }        
        }

        return [
            'records' => $records,
            'news' => $news,
            'foot' => $foot,
            'galleries' => $galleries,
            'val' => $record_ids
        ];
    } 

    private function checkParent($id) {
        $parent = Device::find($id);
        if ($parent->parent_id !== null) {
            $parent = $this->checkParent($parent->parent_id);
        }
        return $parent;
    }
}
