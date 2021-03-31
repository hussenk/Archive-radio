<?php

namespace App\Http\Controllers;

use App\Models\Preparation;
use App\Models\MasterLog;
use Illuminate\Http\Request;

class PreparationController extends Controller
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
                $preparation = Preparation::paginate(10);
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'دخل قائمة المعدون',
                ]);
                return view('preparation.index')
                    ->with('preparation', $preparation)
                    ->with('user', $user);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }
    public function preparationTrashed()
    {

        $preparation = Preparation::onlyTrashed()->paginate(10);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل قائمة المحذوفات',
        ]);
        return view('preparation.index')
            ->with('preparation', $preparation)
            ->with('user', $user);
    }
    public function create()
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {

                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'تكوين معد جديد',
                ]);
                return view('preparation.create');
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:preparations'],
        ]);

        $preparation = Preparation::create([
            'name' => $request->name,
        ]);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حفظ',
            'description' => 'حفظ معد جديد باسم ' . $request->name,
        ]);

        return redirect()
            ->route('preparation')
            ->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Preparation $preparation)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $preparation = Preparation::findOrFail($id);
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => 'محاولة تعديل المعد باسم ' . $preparation->name,
                ]);

                return view('preparation.edit')->with('preparation', $preparation);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function update(Request $request,  $id)
    {
        $preparation = Preparation::find($id);
        $this->validate($request, [
            'name' => ['required', 'unique:preparations'],

        ]);

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'تعديل',
            'description' => ' تعديل اسم المعد من ' . $preparation->name . ' الي ' . $request->name,
        ]);
        $preparation->name = $request->name;
        $preparation->save();
        return redirect()->route('preparation')
            ->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $preparation = Preparation::where('id', $id)->first();
        if ($preparation === null) {
            return redirect()->back();
        }
        $preparation->delete($id);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حذف',
            'description' => 'تم الحذف اسم المعد ' . $preparation->name,
        ]);
        return redirect()->route('preparation')
            ->with('success', 'تم الحذف');
    }

    public function hdelete($id)
    {
        $preparation = Preparation::withTrashed()->where('id', $id)->first();
        $preparation->foreceDelete();
        return redirect()->route('preparation')
            ->with('success', 'تم الحذف بشكل نهائي');
    }

    public function restore($id)
    {
        $preparation = Preparation::withTrashed()->where('id', $id)->first();
        $preparation->restore();

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'استرجاع',
            'description' => 'تم استرجاع معد ' . $preparation->name,
        ]);
        return redirect()->route('preparation')
            ->with('success', 'تم الاسترجاع');
    }
}
