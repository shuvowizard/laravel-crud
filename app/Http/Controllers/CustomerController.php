<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request){

        $customerCount = Customer::count();
        
        $query = Customer::withTrashed()->orderBy('id');

        if($search = $request->search){
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $customers = $query->cursorPaginate(5)->appends(['search' => $request->search]);

        return view('customer.index', compact('customers'));
    }

    public function create(){
        return view('customer.customer-create');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return view('customer.customer-edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Customer::where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        // Customer::destroy($id);
        $customer = Customer::findOrFail($id);
        $customer->delete();
        // $customer->forceDelete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }

    public function restore($id)
    {
        Customer::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Customer restored successfully.');
    }

}
