<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    private $_category;

    public function __construct(Category $category)
    {
        $this->_category = $category;
    }

    public function index(Request $request)
    {
        $keyword = $request->get('s');
        $query = CategoryView::orderBy('id', 'desc');

        if ($keyword != '') {
            $categories = $query->where('id', 'like', '%' . $keyword . '%')->orWhere('category_name', 'like', '%' . $keyword . '%')->get();
        } else {
            $categories = $query->get();
        }

        $categoriesOptions = $this->_category->categoryOptions(); //getting this for ajax edit form only
        return view('roles.admin.categories.list', compact('categories','categoriesOptions'));
    }


    public function create()
    {
        $categories = $this->_category->categoryOptions();
        return view('roles.admin.categories.create', compact('categories'));
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'category_name' => 'required|max:255|unique:categories',
            'category_name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {


            $data = [
                'category_name'  =>  $request->category_name,
                'description'  =>  $request->description,
                'parent_id'      =>  $request->parent,
            ];

            $this->_category->store($data);
            return response()->json(['success' => 'Create Successfully.']);
        }
    }


    public function edit(Category $category)
    {
        $categories = $this->_category->categoryOptions();
        return view('roles.admin.categories.edit', compact('category','categories'));
    }


    public function update(Request $request , Category $category)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        $validator = Validator::make($request->all(), [
            // 'category_name' => 'required|max:255|unique:categories,category_name,'.$category->id.',id',
            'category_name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'category_name'  =>  $request->category_name,
                'description'    =>  $request->description,
                'parent_id'      =>  $request->parent,
                'active'         =>  ($request->has('status')) ? $request->status : 'N',
            ];

            $this->_category->store($data , $category->id);
            return response()->json(['success' => 'Update Successfully.']);
        }
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category has been Delete successfully.');
    }





}
