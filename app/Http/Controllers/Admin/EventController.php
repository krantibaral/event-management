<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class EventController extends BaseController
{
    public function __construct()
    {

        $this->title = 'Events';
        $this->resources = 'admin.events.';
        $this->route = 'events.';

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::with('category')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('title', function ($row) {
                    return '<p class="text-dark-75 font-weight-normal d-block font-size-h6">' . $row->title . '</p>';
                })
                ->editColumn('attendees', function ($row) {

                    if ($row->attendees->isNotEmpty()) {
                        return $row->attendees->pluck('name')->implode(', ');
                    }
                    return 'No attendees';
                })

                ->addColumn('action', function ($data) {
                    return view('admin.templates.index_actions', [
                        'id' => $data->id,
                        'route' => $this->route
                    ])->render();
                })

                ->rawColumns(['action', 'title'])
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
        $info['categories'] = Category::pluck('name', 'id');
        return view($this->createResource(), $info);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'description' => 'required',

        ]);
        $data = $request->all();
        $category = new Event($data);
        $category->save();

        return redirect()->route($this->indexRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $info = $this->crudInfo();
        $event = Event::with(['category', 'attendees'])->findOrFail($id);

        $info['item'] = $event;
        $info['attendees'] = $event->attendees;

        return view($this->showResource(), $info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $info = $this->crudInfo();
        $info['item'] = Event::findOrFail($id);
        //        dd($info);
        $info['categories'] = Category::pluck('name', 'id');
        return view($this->editResource(), $info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'description' => 'required',

        ]);
        $data = $request->all();
        $item = Event::findOrFail($id);
        $item->update($data);


        return redirect()->route($this->indexRoute());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $item = Event::findOrFail($id);

            $item->delete();
        } catch (\Exception $e) {
            return redirect()->route($this->indexRoute());
        }
        return redirect()->route($this->indexRoute());
    }
}
