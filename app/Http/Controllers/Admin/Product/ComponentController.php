<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\ConstructorBasketColor;
use App\Models\ConstructorTrolleyColor;
use App\Models\Wheel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
{

    public function components() {

        $title = 'Componente';

        $components = [
            [   'id'=>1,
                'name'=>'Trolley wheels',
                'route'=>'client.componentEdit',],
            [   'id'=>2,
                'name'=>'Trolley colors',
                'route'=>'client.componentEdit',],
            [   'id'=>3,
                'name'=>'Basket colors',
                'route'=>'client.componentEdit',],
        ];

        return view('panel.product.components.index', compact('components', 'title'));
    }

    public function componentEdit($component) {

        if($component == 1) {
            $title = 'Roți de cărucior';
            $wheels = Wheel::query()->orderBy('sort_order')->get();
            return view('panel.product.components.showWheels', compact('wheels', 'title'));
        } elseif($component == 2) {
            $title = 'Culorile cărucioarelor';
            $colors = ConstructorTrolleyColor::all();
            return view('panel.product.components.showColors', compact('colors', 'title', 'component'));
        }elseif($component == 3) {
            $title = 'Culorile coșului';
            $colors = ConstructorBasketColor::all();
            return view('panel.product.components.showColors', compact('colors', 'title', 'component'));
        }


    }

    public function wheelCreate() {
        $title = 'Create roata';
        $wheels = Wheel::all();
        return view('panel.product.components.createWheel', compact( 'title', 'wheels'));
    }




    public function wheelStore(Request $request) {
        $data = $request->validate([
            'name_ro'=>'required|min:1|string',
            'name_ru'=>'required|min:1|string',
            'name_en'=>'required|min:1|string',
            'sort_order'=>'required|integer',
            'image'=>'nullable',
        ]);

        $image = $request->file('image');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/product/components' , $image );
            $data['image'] = $path;
        }

        Wheel::firstOrCreate($data);
        return redirect()->route('product.componentEdit', 1);
    }

    public function wheelEdit(Wheel $wheel) {
        $title = $wheel->name_ro;

        return view('panel.product.components.editWheel', compact( 'title', 'wheel'));
    }

    public function wheelUpdate(Request $request, Wheel $wheel) {
        $data = $request->validate([
            'name_ro'=>'required|min:1|string',
            'name_ru'=>'required|min:1|string',
            'name_en'=>'required|min:1|string',
            'sort_order'=>'required|integer',
            'image'=>'nullable',
        ]);

        $image = $request->file('image');

        if(isset( $image)) {
            if(isset($wheel->image)) {
                Storage::disk('public')->delete($wheel->image);
            }
            $path = Storage::disk('public')->put('/images/product/components' , $image );
            $data['image'] = $path;
        }

        $wheel->update($data);
        return redirect()->route('product.componentEdit', 1);
    }

    public function wheellDelete( Wheel $wheel) {

        $wheel->delete();
        return redirect()->route('product.componentEdit', 1);
    }

// --------------------Color ------------

    public function colorCreate($component) {
        $title = 'Create color';

        return view('panel.product.components.createColor', compact( 'title', 'component'));
    }

    public function colorStore(Request $request) {
        $data = $request->validate([
            'name_ro'=>'required|min:1|string',
            'name_ru'=>'required|min:1|string',
            'name_en'=>'required|min:1|string',
            'code'=>'required|min:1|string',
            'component'=>'required|integer',
        ]);
        $component = $data['component'];
        unset($data['component']);

        if($component == 2) {
            ConstructorTrolleyColor::firstOrCreate($data);
        } else ConstructorBasketColor::firstOrCreate($data);

        return redirect()->route('product.componentEdit', $component);
    }

    public function colorEdit( $color, $component) {

        if($component == 2) {
            $color = ConstructorTrolleyColor::where('id',$color )->first();
        } else  $color = ConstructorBasketColor::where('id',$color )->first();
        $title = $color->name_ro;
        return view('panel.product.components.editColor', compact( 'title', 'color', 'component'));
    }

    public function colorUpdate(Request $request, $color) {
        $data = $request->validate([
            'name_ro'=>'required|min:1|string',
            'name_ru'=>'required|min:1|string',
            'name_en'=>'required|min:1|string',
            'code'=>'required|min:1|string',
            'component'=>'required|integer',
        ]);
        $component = $data['component'];
        unset($data['component']);
        if($component == 2) {
            $colorTable = ConstructorTrolleyColor::where('id',$color )->first();
        } else  $colorTable = ConstructorBasketColor::where('id',$color )->first();
        $colorTable->update($data);
        return redirect()->route('product.componentEdit', $component);
    }

    public function colorDelete($color, $component) {
        if($component == 2) {
            $color = ConstructorTrolleyColor::where('id',$color )->first();
        } else  $color = ConstructorBasketColor::where('id',$color )->first();

        $color->delete();
        return redirect()->route('product.componentEdit', $component);
    }

}
