<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use FFI\Exception;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Grads = Grade::all();
        return view('pages.Grades.Grades' , compact('Grads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrades $request)
    {
        // if(Grade::where('Name->ar' , $request->Name)->orWhere('Name->en' , $request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('Grade_tranc.exists'));
        // }

        $validated = $request->validated();
        $Grade = new Grade();
        $Translations = [
            'en' => $request->Name_en,
            'ar' => $request->Name
        ];
        // 'Name' => اسم الحقل في الداتا بيز
        $Grade->setTranslations('Name' , $Translations);
      //  $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

          $Grade->Notes = $request->Notes;
          $Grade->save();
          toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGrades $request)
    {
        // if(Grade::where('Name->ar' , $request->Name)->orWhere('Name->en' , $request->Name_en)->exists()){
        //     return redirect()->back()->withErrors(trans('Grade_tranc.exists'));
        // }
        try
        {
            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                $Grades->Name = ['ar' => $request->Name , 'en' => $request->Name_en],
                $Grades->Notes = $request->Notes,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');

      if($MyClass_id->count() == 0){

          $Grades = Grade::findOrFail($request->id)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Grades.index');
      }

      else{

          toastr()->error(trans('Grade_tranc.delete_Grade_Error'));
          return redirect()->route('Grades.index');

    }
}
}
