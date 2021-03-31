<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Role;
use App\Models\MasterLog;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $tag = Tag::paginate(10);

                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'عرض اشارة'
                ]);
                return view('tag.index')->with('tag', $tag)->with('user', $user);
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

                $user = auth()->user();
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'تكوين اشارة'
                ]);
                return view('tag.create');
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag' => ['required', 'unique:tags'],

        ]);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حفظ',
            'description' => 'تكوين اشارة جديدة باسم ' . $request->tag,
        ]);
        $tag = Tag::create([
            'tag' => $request->tag,
        ]);
        return redirect()->route('tag')->with('success', "تم الاضافة بنجاح");
    }


    public function show(Tag $tag)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                //TAG SHOW
            }
            return redirect()->route('categorysub')
                ->with('warning', 'لا تملك الصلاحية');
        }
    }


    public function edit($id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $tag = Tag::findOrFail($id);
                return view('tag.edit')->with('tag', $tag);
            }
        }

        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function update(Request $request,  $id)
    {
        $tag = Tag::find($id);
        $this->validate($request, [
            'tag' => ['required', 'unique:tags'],

        ]);

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تعديل',
            'description' => 'تعديل اشارة من ' . $tag->tag . ' الي ' . $request->tag,
        ]);
        $tag->tag = $request->tag;
        $tag->save();
        return redirect()->route('tag')
            ->with('success', "تم التعديل بنجاح");
    }

    public function destroy($id)
    {
        $tag = Tag::where('id', $id)->first();
        if ($tag === null) {
            return redirect()->back()->with('warning', 'لم يعثر عليه');;
        }
        $tag->delete($id);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حذف',
            'description' => 'تم الحذف اشارة ' . $tag->tag,
        ]);
        return redirect()->route('tag')
            ->with('success', 'تم الحذف');
    }

    public function tagTrashed()
    {

        $tag = Tag::onlyTrashed()->paginate(10);
        $user = auth()->user();


        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل قائمة المحذوفات',
        ]);


        return view('tag.index')
            ->with('tag', $tag)
            ->with('user', $user);
    }

    public function restore($id)
    {
        $tag = Tag::withTrashed()->where('id', $id)->first();
        $tag->restore();

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'استرجاع',
            'description' => 'تم استرجاع مجلد ' . $tag->tag,
        ]);
        return redirect()->route('tag')
            ->with('success', 'تم الاسترجاع');
    }
}
