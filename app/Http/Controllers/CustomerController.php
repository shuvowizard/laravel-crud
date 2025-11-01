<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $customerCount = Customer::count();

        $query = Customer::withTrashed()->orderByDesc('id');

        if ($search = $request->search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $customers = $query->cursorPaginate(5)->appends(['search' => $request->search]);

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.customer-create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment' => 'required|numeric|min:0',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $directory = 'images/customers';
            $customer->image = imageUpload($file, 400, 300, $directory);
        }
        $customer->payment = usd_to_bdt($request->payment);
        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.customer-edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment' => 'required|numeric|min:0',            
        ]);

        $customer = Customer::findOrFail($id);

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        if ($request->hasFile('image')) {
            // Find the image path
            $fullPath = parse_url($customer->image, PHP_URL_PATH);
            $path = public_path($fullPath);
            
            // If file exists then delete it
            if (file_exists($path)){
                File::delete($path);
            }

            // Update new image
            $file = $request->file('image');
            $directory = 'images/customers';
            $customer->image = imageUpload($file, 400, 300, $directory);
        }
        $customer->payment = usd_to_bdt($request->payment);

        $customer->save();

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        // Customer::destroy($id);
        $customer = Customer::findOrFail($id);
        // $customer->delete();

        // Image path find then DELETE image
        $fullPath = parse_url($customer->image, PHP_URL_PATH);
        $path = public_path($fullPath);
        if (file_exists($path)) {
            File::delete($path);
        }

        $customer->forceDelete();
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }

    public function restore($id)
    {
        Customer::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('success', 'Customer restored successfully.');
    }

}
