<?php

namespace App\Http\Controllers\Admin;

use App\Traits\CreateSlug;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    use CreateSlug;

    //view page lists
    public function index()
    {
        $pages = Page::get();
        return view('admin.pages.page-lists')->with(compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.pages');
    }

    //create new page
    public function store(Request $request)
    {
        $data  = new Page();
        $data->title = $request->page_title;
        $data->slug = $request->slug;
        $data->description = $request->page_dsc;
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = ($request->meta_keywords) ? implode(',', $request->meta_keywords) : null;
        $data->meta_description = $request->meta_description;
        $data->show_header = ($request->show_header ? 1 : 0);
        $data->show_footer = ($request->show_footer ? 1 : 0);
        $data->status = ($request->status ? 1 : 0);
        $data->created_by = Auth::id();

        $store = $data->save();
        if($store){
            Toastr::success('Page Create Successfully.');
        }else{
            Toastr::error('Page Cannot Create.!');
        }

        return back();
    }


    // View edit data by item ID
    public function edit(Page $page)
    {
        //
    }

    //update page
    public function update(Request $request, Page $page)
    {
        //
    }

    // Delete page
    public function delete($id)
    {
        $delete = Page::where('id', $id)->delete();

        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    //get slug by title
    public function getSlug(Request $request)
    {
        echo $this->createSlug('pages', $request->title);
    }

    // Status change function
    public function status($status){
        $status = Page::find($status);
        if($status){
            if($status->status == 1){
                $status->update(['status' => 0]);
                $output = array( 'status' => 'unpublish',  'message'  => 'Page Unpublished');
            }else{
                $status->update(['status' => 1]);
                $output = array( 'status' => 'publish',  'message'  => 'Page Published');
            }
        }
        return response()->json($output);
    }

    // Change menu status
    public function MenuStatus(Request $request, $id){
        $status = Page::find($id);
        if($request->type == 'header'){
            if($status->show_header != null){
                $status->update(['show_header' => $request->status]);
                $output = array( 'status' => 'remove',  'message'  => 'Remove From Menu');
            }else{
                $status->update(['show_header' => $request->status]);
                $output = array( 'status' => 'added',  'message'  => 'Added To Menu');
            }
        }else{
            if($status->show_footer != null){
                $status->update(['show_footer' => $request->status]);
                $output = array( 'status' => 'remove',  'message'  => 'Remove From Menu');
            }else{
                $status->update(['show_footer' => $request->status]);
                $output = array( 'status' => 'added',  'message'  => 'Added To Menu');
            }
        }


        return response()->json($output);
    }
}
