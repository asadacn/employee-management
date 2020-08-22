<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{

    public function index()
    {
        $ranks = Rank::latest()->paginate(15);
        return view('employees.rank.index',compact('ranks'));
    }


    public function create()
    {
        return view('employees.rank.create');
    }

    public function store(Request $request)
    {
          
        $request->validate([
            'rank_title' => 'required|unique:ranks,title|max:100',
            'description' => 'string|nullable|max:255',
        ]);

            $rank = new Rank();
            $rank->title = $request->rank_title;
            $rank->description = $request->description;
            
            if($rank->save()){
                return redirect()->back()->with('success','Rank Created');
            }else{
                return redirect()->back()->with('failed','Rank Creation Failed');
            }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $rank = Rank::findOrFail($id);
        return view('employees.rank.edit',compact('rank'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'rank_title' => 'required|max:100|unique:ranks,title,'.$id,
            'description' => 'string|nullable|max:255',
        ]);

            $rank = Rank::findOrFail($id);
            $rank->title = $request->rank_title;
            $rank->description = $request->description;
            
            if($rank->save()){
                return redirect()->back()->with('success','Rank Updated');
            }else{
                return redirect()->back()->with('failed','Rank Update Failed');
            }
    }


    public function destroy($id)
    {
        
        Rank::destroy($id);

        return redirect()->back()->with('success','Rank Deleted !');
    }

    public function search(Request $request)
    {
        $ranks = Rank::where('title','like',"%".$request->search."%")->orWhere('description','like',"%".$request->search)->get();

        return view('employees.rank.index',compact('ranks'));
    }
}
