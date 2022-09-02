<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Gallery::orderByDesc( 'id' )->paginate( 20 );

        return view( 'admin.gallery.index', compact( 'images' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.gallery.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreGalleryRequest $request )
    {

        $img = $request->file( 'img' );
        if ( count( $img ) == 1 )
        {
            foreach ( $img as $key => $value )
            {
                $image_name = genImageName() . '.' . $value->extension();
                if ( !Gallery::where( 'checksum', hash_file( 'md5', $value ) )->exists() )
                {
                    $path  = $value->storeAs( 'public/gallery', $image_name );
                    $image = Gallery::create( [
                        'url'      => $path,
                        'name'     => $image_name,
                        'checksum' => hash_file( 'md5', $value ),
                        'size'     => $value->getSize() / 1024,
                        'ext'      => $value->extension(),
                    ] );

                    return redirect( route( 'gallery.show', $image->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'เพิ่มรูปภาพเสร็จสิ้น'] );
                }
                else
                {
                    return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
                }
            }
        }
        else
        {
            foreach ( $img as $key => $value )
            {
                $image_name = genImageName() . '.' . $value->extension();
                if ( !Gallery::where( 'checksum', hash_file( 'md5', $value ) )->exists() )
                {
                    $path  = $value->storeAs( 'public/gallery', $image_name );
                    $image = Gallery::create( [
                        'url'      => $path,
                        'name'     => $image_name,
                        'checksum' => hash_file( 'md5', $value ),
                        'size'     => $value->getSize() / 1024,
                        'ext'      => $value->extension(),
                    ] );
                }
            }

            return redirect( route( 'gallery.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'เพิ่มรูปภาพเสร็จสิ้น ' . count( $img ) . ' รูป'] );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show( Gallery $gallery )
    {
        return view( 'admin.gallery.show', compact( 'gallery' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit( Gallery $gallery )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateGalleryRequest $request, Gallery $gallery )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy( Gallery $gallery )
    {
        Storage::delete( $gallery->url );
        $gallery->delete();

        return redirect( route( 'gallery.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ลบภาพแล้ว'] );
    }
}
