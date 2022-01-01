<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function allBrand(){
        $brands=Brand::latest()->paginate(5);
        return view('admin.brands.index',compact('brands'));
    }
    public function AddBrand(Request $request)
    {
        $request->validate([
            'Brand_name'=>'required|unique:Brands|min:2',
            'Brand_image'=>'required|mimes:jpg,jpeg,png']);

        $brand_Image=$request->file('Brand_image');
        $name_gen=hexdec(uniqid());
        $img_ext=strtolower($brand_Image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $upLocation='image/brand/';
        $imge="".$upLocation.$img_name;
        $brand_Image->move($upLocation,$img_name);
        
        Brand::insert([
            'Brand_name'=>$request->Brand_name,
            'Brand_Image'=>$imge,
            'created_at'=>Carbon::now()

        ]);
        return redirect()->back()->with('success',"Brand Inserted Successfully");
    }
}
