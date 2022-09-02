<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Gallery;
use App\Models\Slide;
use Illuminate\Support\Facades\Auth;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::orderByDesc( 'id' )->paginate( 30 );

        return view( 'admin.slide.index', compact( 'slide' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.slide.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSlideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreSlideRequest $request )
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
                'img' => $path,
            ] );

            Slide::create( $request->all() );

            return redirect( route( 'slide.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเพิ่มภาพเสร็จสิ้นเสร็จสิ้น'] );
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show( Slide $slide )
    {
        return view( 'admin.slide.show', compact( 'slide' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit( Slide $slide )
    {
        return view( 'admin.slide.edit', compact( 'slide' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateSlideRequest $request, Slide $slide )
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

                $slide->img          = $request->img;
                $slide->title        = $request->title;
                $slide->descriptions = $request->descriptions;
                $slide->url          = $request->url;
                $slide->save();

                return redirect( route( 'slide.show', $slide->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขเสร็จสิ้น'] );
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
            }
        }
        else
        {

            $slide->title        = $request->title;
            $slide->descriptions = $request->descriptions;
            $slide->url          = $request->url;
            $slide->save();

            return redirect( route( 'slide.show', $slide->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขเสร็จสิ้น'] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy( Slide $slide )
    {
        $slide->delete();

        return redirect( route( 'slide.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ลบข้อมูลเสร็จสิ้น'] );
    }
}
