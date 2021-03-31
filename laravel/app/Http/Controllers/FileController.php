<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\CategorySub;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Presenter;
use App\Models\Preparation;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\MasterLog;
use App\Models\User;
use App\Models\Role;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Rename_File($path, $filename, $title, $classid, $subclass, $date)
    {
        if ($pos = strrpos($filename, '.')) {
            $name = substr($filename, 0, $pos);
            $ext = substr($filename, $pos);
        } else {
            $name = $filename;
        }
        $newpath = $path . '/' . $filename;
        $newname = $filename;
        $counter = 0;
        while (file_exists($newpath)) {
            $counter++;
        }
        $newname = $title . '_' . $classid . '_' . $subclass . '_[' . $date . ']_' . $counter . $ext;
        $newpath = $path . '/' . $newname;
        return $newname;
    }

    public function index()
    {
        $user = auth()->user();

        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                // $role = Role::all();
                $category = Category::all();
                // $file = File::all();
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'عرض قائمة الرفع',
                ]);
                return view('file.index')
                    ->with('category', $category)
                    ->with('user', $user);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }

    public function create()
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $category = Category::all();

                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' محاولة تكوين ملف جديد ',
                ]);
                return view('file.create')->with('category', $category);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }

    public function store(Request $request)
    {

        $this->validate($request, [

            'title' => 'required',
            'path_file' => 'required',
            'category_id' => 'required',
            // 'description' => 'required',
            'user_date' => 'required',
            'category_sub_id' => 'required',
            //   'tags' => 'required',
            //   'preparation' => 'required',
            //   'presenter' => 'required',

        ]);

        $category_name = Category::where('id', $request->category_id)->first();
        $category_sub_name = CategorySub::where('id', $request->category_sub_id)->first();
        $path = 'uploads/Main/' . str_slug($category_name->type) . '/' . str_slug($category_sub_name->title) . '/';



        $newFile =  $this->Rename_File(
            $path,
            $request->file('path_file')->getClientOriginalName(),
            str_slug($request->title),
            str_slug($category_name->type),
            str_slug($category_sub_name->title),
            $request->user_date
        );

        $upload = $request->path_file->move($path, $newFile);

        $file = File::create([

            'title' => $request->title,
            'path_file' =>  $path . $newFile,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'user_date' => $request->user_date,
            'category_sub_id' => $request->category_sub_id,

        ]);
        $file->tag()->sync($request->tags);
        $file->preparation()->sync($request->preparation);
        $file->presenter()->sync($request->presenter);

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حفظ',
            'description' => ' تكوين ملف جديد باسم  ' . $file->title,
        ]);


        Log::create([
            'user_id' => $user->id,
            'description' => 'upload',
            'file_id' => $file->id,
        ]);


        return redirect()->route('file')
            ->with('success', 'تم اضافة بنجاح');
    }

    public function show(File $file)
    {
        //
    }

    public function edit($category_id, $id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $file = File::findOrFail($id);
                $category = Category::where('id', $category_id)->first();
                $categorysub = CategorySub::where('category_id', $category_id)->get();
                $tag = Tag::all();
                $preparation = Preparation::all();
                $presenter = Presenter::all();

                $user = auth()->user();
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' محاولة تعديل ملف باسم  ' . $file->title,
                ]);

                return view('file.edit')
                    ->with('category', $category)
                    ->with('categorysub', $categorysub)
                    ->with('tag', $tag)
                    ->with('presenter', $presenter)
                    ->with('preparation', $preparation)
                    ->with('file', $file);
            }
        }

        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }

    public function update(Request $request, $id)
    {
        $file = File::find($id);
        $this->validate($request, [

            'title' => 'required',
            //  'path_file' => 'required',
            'category_id' => 'required',
            // 'description' => 'required',
            'user_date' => 'required',
            'category_sub_id' => 'required',
            //   'tags' => 'required',
            //   'preparation' => 'required',
            //   'presenter' => 'required',

        ]);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تعديل',
            'description' => 'تعديل ملف باسم  ' . $file->title,
        ]);
        $category_name = Category::where('id', $request->category_id)->first();
        $category_sub_name = CategorySub::where('id', $request->category_sub_id)->first();
        $path = 'uploads/Main/' . str_slug($category_name->type) . '/' . str_slug($category_sub_name->title) . '/';


        if ($request->has('path_file')) {
            $newFile =  $this->Rename_File(
                $path,
                $request->file('path_file')->getClientOriginalName(),
                str_slug($request->title),
                str_slug($category_name->type),
                str_slug($category_sub_name->title),
                $request->user_date
            );

            $upload = $request->path_file->move($path, $newFile);
            $file->path_file =  $path . $newFile;
        }
        $file->title = $request->title;

        $file->category_id = $request->category_id;
        $file->description = $request->description;
        $file->user_date = $request->user_date;
        $file->category_sub_id = $request->category_sub_id;

        $file->save();
        $file->tag()->sync($request->tags);
        $file->preparation()->sync($request->preparation);
        $file->presenter()->sync($request->presenter);

        $user = auth()->user();

        Log::create([
            'user_id' => $user->id,
            'description' => 'edit from' . $request->old_title . 'to' . $request->title,
            'file_id' => $file->id,
        ]);


        return redirect()->route('file')
            ->with('success', 'تم التعديل');
    }

    public function destroy($id)
    {
        //
    }

    public function showcategory($category_id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {

                $category = Category::where('id', $category_id)->first();
                $categorysub = CategorySub::where('category_id', $category_id)->get();
                $tag = Tag::all();
                $preparation = Preparation::all();
                $presenter = Presenter::all();
                $user = auth()->user();
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' عرض محتوى ملف ' . $category->title,
                ]);
                return view('file.create2')
                    ->with('category', $category)
                    ->with('categorysub', $categorysub)
                    ->with('tag', $tag)
                    ->with('presenter', $presenter)
                    ->with('preparation', $preparation);
            }
        }

        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');;
    }


    public function search($id)
    {
    }
    public function download($id)
    {
        $file = File::find($id);
        $user = auth()->user();
        Log::create([
            'user_id' => $user->id,
            'description' => 'download',
            'file_id' => $file->id,
        ]);


        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تحميل',
            'description' => ' تحميل ملف ' . $file->title,
        ]);
        return response()->download($file->path_file);

        // return asset('' . $file->path_file . '');
    }
}
