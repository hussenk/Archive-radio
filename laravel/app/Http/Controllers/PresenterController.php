<?php

namespace App\Http\Controllers;

use App\Models\Presenter;
use App\Models\MasterLog;
use Illuminate\Http\Request;

class PresenterController extends Controller
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
                $presenter = Presenter::paginate(10);
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' عرض قائمة المقدمين ',
                ]);


                return view('presenter.index')
                    ->with('presenter', $presenter)
                    ->with('user', $user);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }
    public function presenterTrashed()
    {

        $presenter = Presenter::onlyTrashed()->paginate(10);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => 'دخل قائمة المحذوفات مقدمين',
        ]);
        return view('presenter.index')
            ->with('presenter', $presenter)

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
                    'description' => ' تكوين مقدم جديد ',
                ]);

                return view('presenter.create');
            }
        }


        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:presenters'],

        ]);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حفظ',
            'description' => ' تكوين اسم مقدم جديد ' . $request->name,
        ]);
        $preparation = Presenter::create([
            'name' => $request->name,
        ]);
        return redirect()->route('presenter')->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Presenter $presenter)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        foreach ($user->role as $item) {
            if ($item->id == '3' || $item->id == '5') {
                $presenter = Presenter::findOrFail($id);
                $user = auth()->user();
                MasterLog::create([
                    'user_id' => $user->id,
                    'action' => 'عرض',
                    'description' => ' محاولة تعديل ' . $presenter->name,
                ]);

                return view('presenter.edit')->with('presenter', $presenter);
            }
        }
        return redirect()->route('categorysub')
            ->with('warning', 'لا تملك الصلاحية');
    }


    public function update(Request $request,  $id)
    {
        $presenter = Presenter::find($id);
        $this->validate($request, [
            'name' => ['required', 'unique:presenters'],

        ]);
        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'عرض',
            'description' => ' تعديل اسم المقدم ' . $presenter->name . ' الي ' . $request->name,
        ]);
        $presenter->name = $request->name;
        $presenter->save();
        return redirect()->route('presenter')->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presenter  $presenter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presenter = Presenter::where('id', $id)->first();
        if ($presenter === null) {
            return redirect()->back();
        }
        $presenter->delete($id);
        $user = auth()->user();

        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'حذف',
            'description' => 'تم الحذف اسم ' . $presenter->name,
        ]);
        return redirect()->route('presenter')
            ->with('success', 'تم الحذف');
    }
    public function hdelete($id)
    {
        $presenter = Presenter::withTrashed()->where('id', $id)->first();
        $presenter->foreceDelete();
        return redirect()->route('presenter')
            ->with('success', 'تم الحذف بشكل نهائي');
    }
    public function restore($id)
    {
        $presenter = Presenter::withTrashed()->where('id', $id)->first();
        $presenter->restore();

        $user = auth()->user();
        MasterLog::create([
            'user_id' => $user->id,
            'action' => 'استرجاع',
            'description' => 'تم استرجاع اسم ' . $presenter->name,
        ]);
        return redirect()->route('presenter')
            ->with('success', 'تم الاسترجاع');
    }
}
