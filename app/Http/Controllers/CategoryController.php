<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {
        // $categories =DB::table("categories")
        // ->join('users', 'categories.user_id','users.id')
        // ->select('categories.*','users.name')
        // ->latest()->paginate(10);
        $categories=Category::latest()->paginate(5);
        $trashCat=Category::onlyTrashed()->latest()->paginate(2);
        // $categories=DB::table('categories')->latest()->get();
        return view("admin\category\index",compact('categories','trashCat'));
    }

    public function AddCat(Request $req)
    {
        $validatedData=$req->validate([
            'category_name'=>'required|unique:categories|max:255',            
        ],
    ['category_name.required'=>'please input category Name',]
        ,);
        // Category::insert([
            // 'category_name'=>$req->category_name,
            // 'user_id'=>Auth::user()->id,
            // 'created_at'=>Carbon::now()
        // ]);

        // $category=new Category;
        // $category->category_name=$req->category_name;
        // $category->user_id=Auth::user()->id;
        // $category->created_at=Carbon::now();
        // $category->save();
        $data=array(
            'category_name'=>$req->category_name,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now(),
        );
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category Inserted Successfuly');


    }
    public function editCat($id)
    {
        // $category=Category::find($id);
        $category=DB::table('categories')->where('id',$id)->first();
        // echo $category;
        return view('admin.category.edit',compact('category'));
    }
    public function updateCat(Request $req,$id)
    {
        $validatedData=$req->validate([
            'category_name'=>'required|unique:categories|max:255',            
        ],
    ['category_name.required'=>'please input new category Name',]
        ,);
        $cat=DB::table('categories')->where('id',$id)->update([
            'category_name'=>$req->category_name,
            "user_id"=>Auth::user()->id,
        ]);

        // $cat=Category::find($id)->update([
        //     'category_name'=>$req->category_name,
        //     "user_id"=>Auth::user()->id,
        // ]);

        return redirect()->route('all.category')->with('success','Category Updated Successfuly');
    }
    public function deleteCat($id)
    {
        Category::find($id)->delete();
        return redirect()->route('all.category')->with('success','Category Soft Delete Successfuly');
    }
    public function restoreCat($id)
    {
        Category::withTrashed()->find($id)->restore();
        return redirect()->route('all.category')->with('success','Category Restore Successfuly');

    }

    public function removeCat($id)
    {
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('all.category')->with('success','Category Removed Successfuly');
    }
}
