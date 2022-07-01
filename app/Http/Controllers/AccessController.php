<?php

namespace App\Http\Controllers;

use App\Http\Requests\Access\AddRequest;
use App\Models\AccessList;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function add(AddRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->user()->id;
        AccessList::firstOrCreate($data);
        return back();
    }

    public function delete(AddRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->user()->id;
        $item = AccessList::where('author_id', '=', $data['author_id'])->where(
            'reader_id',
            '=',
            $data['reader_id']
        )->get();
        if (!empty($item)) {
            AccessList::destroy($item);
        }
        return back();
    }
}
