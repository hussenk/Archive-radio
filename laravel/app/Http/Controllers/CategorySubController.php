<?php

namespace App\Http\Controllers;

use App\Models\CategorySub;
use App\Models\Category;
use App\Models\File;
use App\Models\Role;
use App\Models\MasterLog;
use Illuminate\Http\Request;

class CategorySubController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::All();
        $categorysub = CategorySub::paginate(10);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل تصنيف الفرعي',
        ]);

        return view('categorysub.index')
            ->with('categorysub', $categorysub)
            ->with('category', $category)
            ->with('user', $user);
    }

    public function categorysubTrashed()
    {
        $category = Category::All();
        $categorysub = CategorySub::onlyTrashed()->paginate(10);
        $user = auth()->user();
        $role = Role::all();

        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل قائمة المحذوفات',
        ]);

        return view('categorysub.index')
            ->with('categorysub', $categorysub)
            ->with('category', $category)
            ->with('user', $user);
    }

    public function create()
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $category = Category::All();



                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'دخول لانشاء تصنيف فرعي جديد',
                ]);


                return view('categorysub.create')
                    ->with('category', $category);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'category_id' => 'required',
            'action' => 'حفظ',
            'title' => ['required', 'unique:category_subs'],
        ]);

        $categorysub = CategorySub::create([
            'category_id' =>  $request->category_id,
            'description' => $request->description,
            'title' => $request->title,
        ]);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'description' => 'حفظ المكون جديد' . $request->title,
        ]);


        return redirect()->route('categorysub')
            ->with('success', 'تم الاضافة بنجاح');
    }

    public function show($id)
    {
        $categorysub = CategorySub::where('id', $id)->first();
        $file = File::where('category_sub_id', $id)->orderBy('user_date', 'DESC')->paginate(10);

        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => ' عرض مجلد ' . $categorysub->title,
        ]);

        return view('categorysub.show')
            ->with('file', $file)
            ->with('categorysub', $categorysub)
            ->with('user', auth()->user());
    }


    public function edit($id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $category = Category::All();
                $categorysub = CategorySub::findOrFail($id);

                $user = auth()->user();

                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' محاولة تعديل مجلد ' . $categorysub->title,
                ]);
                return view('categorysub.edit')
                    ->with('categorysub', $categorysub)
                    ->with('category', $category);
            }
        }

        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function update(Request $request,  $id)
    {
        $categorysub = CategorySub::find($id);
        $this->validate($request, [
            'category_id' => 'required',
            'title' => ['required', 'unique:category_subs'],
        ]);

        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تعديل',
            'description' => ' تم التعديل من ' . $categorysub->title . ' الي ' . $request->title,
        ]);
        $categorysub->category_id =  $request->category_id;
        $categorysub->description = $request->description;
        $categorysub->title = $request->title;


        $categorysub->save();



        return redirect()->route('categorysub')
            ->with('success', ' تم تعديل بنجاح ');
    }

    public function destroy($id)
    {
        $categorysub = CategorySub::where('id', $id)->first();
        if ($categorysub === null) {
            return redirect()->back();
        }
        $categorysub->delete($id);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حذف',
            'description' => ' تم الحذف مجلد ' . $categorysub->title,
        ]);
        return redirect()->route('categorysub')
            ->with('success', ' تم الحذف ');
    }

    public function hdelete($id)
    {
        $categorysub = CategorySub::withTrashed()->where('id', $id)->first();
        $categorysub->foreceDelete();
        return redirect()->route('categorysub')
            ->with('success', ' تم الحذف بشكل نهائي ');
    }

    public function restore($id)
    {
        $categorysub = CategorySub::withTrashed()->where('id', $id)->first();
        $categorysub->restore();

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'استرجاع',
            'description' => ' تم استرجاع مجلد ' . $categorysub->title,
        ]);
        return redirect()->route('categorysub')
            ->with('success', ' تم الاسترجاع ');
    }
}
