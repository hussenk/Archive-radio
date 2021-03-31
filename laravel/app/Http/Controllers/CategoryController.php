<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Category;
use App\Models\CategorySub;
use App\Models\MasterLog;
use Illuminate\Http\Request;

//use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorysub = CategorySub::All();
        $category = Category::paginate(10);


        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل صفحة تصنيف رئسي',
        ]);

        return view('category.index')
            ->with('category', $category)
            ->with('categorysub', $categorysub)
            ->with('user', auth()->user());
    }

    public function create()
    {

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل صفحة تكوين تصنيف رئسي جديد',
        ]);
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                return view('category.create');
            }
        }
        return redirect()->route('category')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function store(Request $request)
    {


        $this->validate($request, [
            'type' => ['required', 'unique:categories'],
        ]);


        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حفظ',
            'description' => 'كون تصنيف جديد ' .  $request->type,
        ]);

        $category = Category::create([
            'type' => $request->type,
        ]);
        return redirect()->route('category')
            ->with('success', 'تم الاضافة بنجاح');;
    }

    public function show(Category $category)
    {
        //
    }


    public function edit($id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $category = Category::findOrFail($id);


                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'دخل لتعديل اسم ' . $category->type,
                ]);


                return view('category.edit')->with('category', $category);
            }
        }

        return redirect()->route('category')
            ->with('warning', 'لا تملك الصلاحية');;
    }


    public function update(Request $request,  $id)
    {



        $category = Category::find($id);
        $this->validate($request, [
            'type' => ['required', 'unique:categories'],
        ]);

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تعديل',
            'description' => ' تم التعديل من ' . $category->type . ' الي ' . $request->type,
        ]);

        $category->type = $request->type;
        $category->save();
        return redirect()->route('category')
            ->with('success', 'تم تعديل بنجاح');;
    }

    public function destroy(Category $category)
    {
        //
    }

    public function showcategorysub($category_id)
    {

        $user = auth()->user();
        $role = Role::all();
        $category = Category::All();
        $categoryname = Category::findOrFail($category_id);
        $categorysub = CategorySub::where('category_id', $category_id)->paginate(10);
        if ($categorysub->count() > 0) {
        }

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => ' عرض محتوى ' . $categoryname->type,
        ]);
        // return view('categorysub.index')->with('categorysub',)->with('category', $category);
        return view('categorysub.index')
            ->with('categorysub', $categorysub)
            ->with('category', $category)
            ->with('user', $user)
            ->with('role', $role);
    }
}
