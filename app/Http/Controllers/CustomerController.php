<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\EditCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities'));
    }

    public function create()
    {
        $cities = City::all();

        return view('customers.create', compact('cities'));
    }

    public function store(CreateCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->city_id = $request->city_id;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = $image->store('images', 'public');
            $customer->image = $path;
        }
        $customer->save();

        Session::flash('success', 'Tao moi khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities = City::all();

        return view('customers.edit', compact('customer', 'cities'));
    }

    public function update(EditCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->city_id = $request->city_id;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $path = $image->store('images', 'public');
            $customer->image = $path;
        }
        $customer->save();

        Session::flash('success', 'Cap nhat khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        Session::flash('success', 'Xoa khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function filterByCity(Request $request)
    {
        $idCity = $request->city_id;
        $cityFilter = City::findOrFail($idCity);
        $customers = Customer::where('city_id', $cityFilter->id)->paginate(5);
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if (!$keyword){
            return redirect()->route('customers.index');
        } else {
            $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')->paginate(5);
        }
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities'));
    }
}
