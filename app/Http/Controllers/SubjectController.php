<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Database\SubjectService;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = new SubjectService;
        $search = $request->search;
        if($search == "") {
            return response()->json($subjects->index(['without_pagination' => true]));
        } else {
            return response()->json($subjects->index(['name' => $search, 'page' => 50]));
        }
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
    public function store(Request $request)
    {
        $subjectDB = new SubjectService;
        $getOrder = $subjectDB->index(['order_by' => 'DESC', 'page' => 1]);
        if(!count($getOrder)) {
            $order = 1;
        }else {
            $order = $getOrder[0]['order'] + 1;
        }
        return response()->json($subjectDB->create([
            'name' => $request->name,
            'group' => $request->group,
            'order' => $order,
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjectDB = new SubjectService;
        return response()->json($subjectDB->detail($id));
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
    public function update(Request $request, $id)
    {
        $subjectDB = new SubjectService;
        return response()->json($subjectDB->update($id,[
            'name' => $request->name,
            'group' => $request->group,
            'order' => $request->order,
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
