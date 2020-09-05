<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{

    public function index()
    {
        $data['menus'] = Menu::orderBy('priority', 'desc')->get();
        return view('admin.menu.menu')->with($data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'source_id' => 'required',
            'name' => 'required',
        ]);
        $data = new Menu();
        $data->name = $request->name;
        $data->menu_source = $request->menu_type;
        $data->source_id = implode(',', $request->source_id);
        $data->status = ($request->status ? 1 : 0);

        $store = $data->save();
        if($store){
            if($request->menu_type == 'category'){
               foreach ($request->source_id as $id){
                    $category = Category::find($id);
                    $category->menu_id = $data->id;
                    $category->save();
                }

            }elseif($request->menu_type == 'page'){
                foreach ($request->source_id as $id){
                    $category = Page::find($id);
                    $category->menu_id = $data->id;
                    $category->save();
                }
            }else{
                echo '';
            }
            Toastr::success('Menu Create Successfully.');
        }else{
            Toastr::error('Menu Cannot Create.!');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
