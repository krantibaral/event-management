<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends BaseController
{
    public function __construct()
    {

        $this->title = 'Categories';
        $this->resources = 'admin.categories.';
        $this->route = 'categories.';

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<p class="text-dark-75 font-weight-normal d-block font-size-h6">' . ' ' . $row->name . '</p>';
                })

                ->addColumn('action', function ($data) {
                    return view('admin.templates.index_actions', [
                        'id' => $data->id,
                        'route' => $this->route
                    ])->render();
                })

                ->rawColumns(['action', 'name'])
                ->make(true);
        }

        $info = $this->crudInfo();
        return view($this->indexResource(), $info);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = $this->crudInfo();
        return view($this->createResource(), $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);
        $data = $request->all();
        $category = new Category($data);
        $category->save();

        return redirect()->route($this->indexRoute());
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->crudInfo();
        $info['item'] = Category::findOrFail($id);
        return view($this->showResource(), $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->crudInfo();
        $info['item'] = Category::findOrFail($id);
        //        dd($info);
        return view($this->editResource(), $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',

        ]);
        $data = $request->all();
        $item = Category::findOrFail($id);
        $item->update($data);


        return redirect()->route($this->indexRoute());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $item = Category::findOrFail($id);

            $item->delete();
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute());
        }
        return redirect()->route($this->indexRoute());
    }

}
