<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mission\StoreRequest;
use App\Http\Requests\Mission\UpdateRequest;

use App\Models\Mission;

use Illuminate\Support\Facades\Storage;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::all();
        $title = 'Misiunea';
        return view('panel.mission.index', compact('missions', 'title'));

    }
    public function create()
    {
        $title = 'Adauga Misiunea';
        $missions = Mission::all();
        return view('panel.mission.create', compact( 'missions','title'));
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $image = $request->file('image');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/missions' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }

        $mission = Mission::firstOrCreate($data);


        if($mission) {
            return redirect()->route('mission');
        } else {
            return back()->with('flash_message_error', 'industry n-a fost creat');
        }
    }

    public function edit(Mission $mission)
    {
        $title = 'Editarea Industriei';


        return view('panel.mission.edit', compact( 'title',  'mission'));
    }

    public function update(UpdateRequest $request, Mission $mission)
    {
        $data = $request->validated();

            $image = $request->file('image');

            if (isset($image)) {
                if (isset($mission->image)) {
                    Storage::disk('public')->delete($mission->image);
                }
                $path = Storage::disk('public')->put('/images/missions', $image);
                compressFiles($path);
                $data['image'] = $path;
            }


            $mission->update($data);
            return redirect()->route('mission');

    }
    public function delete(Mission $mission)
    {
        if(isset($mission->image)) {
            Storage::disk('public')->delete($mission->image);
        }

        $mission->delete();
        return redirect()->route('mission');
    }

}
