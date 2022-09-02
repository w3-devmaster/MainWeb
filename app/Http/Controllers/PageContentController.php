<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageContentRequest;
use App\Http\Requests\UpdatePageContentRequest;
use App\Models\PageContent;

class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = PageContent::orderByDesc( 'id' )->paginate( 30 );

        return view( 'admin.page-content.index', compact( 'pages' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.page-content.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StorePageContentRequest $request )
    {
        $request->merge( [
            'url' => genPageName(),
        ] );

        PageContent::create( $request->all() );

        return redirect( route( 'page-content.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเพิ่มหน้าเสร็จสิ้น'] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function show( PageContent $pageContent )
    {
        return view( 'admin.page-content.show', compact( 'pageContent' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function edit( PageContent $pageContent )
    {
        return view( 'admin.page-content.edit', compact( 'pageContent' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageContentRequest  $request
     * @param  \App\Models\PageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function update( UpdatePageContentRequest $request, PageContent $pageContent )
    {
        $pageContent->title   = $request->title;
        $pageContent->content = $request->content;
        $pageContent->save();

        return redirect( route( 'page-content.show', $pageContent->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขเสร็จสิ้น'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function destroy( PageContent $pageContent )
    {
        $pageContent->delete();

        return redirect( route( 'page-content.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ลบข้อมูลเสร็จสิ้น'] );
    }
}