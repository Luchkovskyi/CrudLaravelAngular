<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Category;

class SupplierController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index($id = null) {
        $Product = Supplier::all();
        $AllCategory = Category::all();
        if ($id == null){
           foreach($Product as $item) {
                foreach ($AllCategory as $item2) {
                    if ($item->supplierCategories_id == $item2->id) {
                        $item->supplierCategories_id = $item2->name;
                    }
                }
            }
        return $Product;
        } else {
            $Product = Supplier::find($id);
            $AllCategory = Category::all();

            foreach ($AllCategory as $item2) {
                if ($Product->supplierCategories_id == $item2->id) {
                    $Product->supplierCategories_id = $item2->name;
                }
            }
            return $Product;
        }
    }


    public function store(Request $request) {
        $supplier = new Supplier;
        $supplier->supplierName = $request->input('supplierName');
        $supplier->supplierEmail = $request->input('supplierEmail');
        $supplier->supplierContact = $request->input('supplierContact');
        $supplier->supplierPosition = $request->input('supplierPosition');
        $supplier->save();
        return 'Supplier record successfully created with id' . $supplier->id;
    }

    public function show($id) {
        $Product = Supplier::find($id);
        $AllCategory = Category::all();

        foreach ($AllCategory as $item2) {
            if ($Product->supplierCategories_id == $item2->id) {
                        $Product->supplierCategories_id = $item2->name;
            }
        }
        return $Product;
    }

    public function update(Request $request, $id) {


        $supplier = Supplier::find($id);

        $supplier->supplierName = $request->input('supplierName');
        $supplier->supplierEmail = $request->input('supplierEmail');
        $supplier->supplierCategories_id = $request->input('supplierContact');
        $supplier->supplierImage = $request->input('supplierPosition');

        $supplier->save();
        return 'Supplier record successfully updated with id ' . $supplier->id;
    }
    public function destroy($id) {
        $supplier = Supplier::find($id)->delete();
        return 'Employee record successfully deleted';
    }
}
