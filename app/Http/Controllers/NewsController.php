<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderByDesc( 'id' )->paginate( 30 );

        return view( 'admin.news.index', compact( 'news' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.news.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreNewsRequest $request )
    {
        $img        = $request->file( 'image' );
        $image_name = genImageName() . '.' . $img->extension();
        if ( !Gallery::where( 'checksum', hash_file( 'md5', $img ) )->exists() )
        {
            $path  = $img->storeAs( 'public/gallery', $image_name );
            $image = Gallery::create( [
                'url'      => $path,
                'name'     => $image_name,
                'checksum' => hash_file( 'md5', $img ),
                'size'     => $img->getSize() / 1024,
                'ext'      => $img->extension(),
            ] );

            $request->merge( [
                'img'  => $path,
                'user' => Auth::user()->id,
            ] );

            News::create( $request->all() );

            return redirect( route( 'news.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเพิ่มข่าวสารเสร็จสิ้น'] );
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show( News $news )
    {
        return view( 'admin.news.show', compact( 'news' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit( News $news )
    {
        return view( 'admin.news.edit', compact( 'news' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateNewsRequest $request, News $news )
    {
        if ( $request->hasFile( 'image' ) )
        {
            $img        = $request->file( 'image' );
            $image_name = genImageName() . '.' . $img->extension();
            if ( !Gallery::where( 'checksum', hash_file( 'md5', $img ) )->exists() )
            {
                $path  = $img->storeAs( 'public/gallery', $image_name );
                $image = Gallery::create( [
                    'url'      => $path,
                    'name'     => $image_name,
                    'checksum' => hash_file( 'md5', $img ),
                    'size'     => $img->getSize() / 1024,
                    'ext'      => $img->extension(),
                ] );

                $request->merge( [
                    'img'  => $path,
                    'user' => Auth::user()->id,
                ] );

                $news->img     = $request->img;
                $news->title   = $request->title;
                $news->content = $request->content;
                $news->save();

                return redirect( route( 'news.show', $news->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขข่าวสารเสร็จสิ้น'] );
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
            }
        }
        else
        {

            $news->title   = $request->title;
            $news->content = $request->content;
            $news->save();

            return redirect( route( 'news.show', $news->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขข่าวสารเสร็จสิ้น'] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy( News $news )
    {
        $news->delete();

        return redirect( route( 'news.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ลบข้อมูลเสร็จสิ้น'] );
    }
}
