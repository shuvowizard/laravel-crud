<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // $shopList = app('db')->table('shops')->get();
        // $shopList = DB::table('shops')->orderBy('id', 'desc')->paginate(5);

        $shopCount = DB::table('shops')->count();

        $query = DB::table('shops')->orderBy('id');

        if($search = $request->search){
            $query->where(function ($q) use ($search) {
                $q->where('shop_name', 'like', '%' . $search . '%')
                    ->orWhere('shop_number', 'like', '%' . $search . '%')
                    ->orWhere('shop_phone', 'like', '%' . $search . '%')
                    ->orWhere('shop_email', 'like', '%' . $search . '%');
            });
        }

        $shopList = $query->cursorPaginate(5)->appends(['search' => $request->search]);

        return view('shop.index', compact('shopList', 'shopCount'));
    }

    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255|unique:shops,shop_name',
            'shop_number' => 'required|string|max:255',
            'shop_address' => 'required|string|max:255',
            'shop_phone' => 'required|string|max:255',
            'shop_email' => 'required|email|max:255',
        ]);

        // DB::table('shops')->insert($validatedData);
        // DB::table('shops')->insert([
        //     'shop_name' => $validatedData['shop_name'],
        //     'shop_number' => $validatedData['shop_number'],
        //     'shop_phone' => $validatedData['shop_phone'],
        //     'shop_address' => $validatedData['shop_address'],
        //     'shop_email' => $validatedData['shop_email'],
        //     'tin_number' => $validatedData['tin_number'],
        // ]);

        DB::table('shops')->insert([
            'shop_name' => $request->shop_name,
            'shop_number' => $request->shop_number,
            'shop_address' => $request->shop_address,
            'shop_phone' => $request->shop_phone,
            'shop_email' => $request->shop_email,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('shop.index')->with('success', 'Shop created successfully.');
    }

    public function edit($id)
    {
        $shop = DB::table('shops')->whereId($id)->first();
        return view('shop.edit', compact('shop'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255|unique:shops,shop_name,' . $id,
            'shop_number' => 'required|string|max:255',
            'shop_address' => 'required|string|max:255',
            'shop_phone' => 'required|string|max:255',
            'shop_email' => 'required|email|max:255',
        ]);

        DB::table('shops')->whereId($id)->update([
            'shop_name' => $request->shop_name,
            'shop_number' => $request->shop_number,
            'shop_address' => $request->shop_address,
            'shop_phone' => $request->shop_phone,
            'shop_email' => $request->shop_email,
            'updated_at' => now(),
        ]);

        return redirect()->route('shop.index')->with('success', 'Shop updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('shops')->whereId($id)->delete();
        return redirect()->route('shop.index')->with('success', 'Shop deleted successfully.');
    }   

}