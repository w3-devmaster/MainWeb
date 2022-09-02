<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::orderByDesc( 'id' )->paginate( 30 );

        return view( 'admin.event.index', compact( 'event' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.event.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreEventRequest $request )
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

            Event::create( $request->all() );

            return redirect( route( 'event.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ดำเนินการเพิ่มกิจกรรมเสร็จสิ้น'] );
        }
        else
        {
            return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show( Event $event )
    {
        return view( 'admin.event.show', compact( 'event' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit( Event $event )
    {
        return view( 'admin.event.edit', compact( 'event' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateEventRequest $request, Event $event )
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

                $event->img     = $request->img;
                $event->title   = $request->title;
                $event->content = $request->content;
                $event->save();

                return redirect( route( 'event.show', $event->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขกิจกรรมเสร็จสิ้น'] );
            }
            else
            {
                return redirect()->back()->with( ['alert' => true, 'resp' => 'error', 'msg' => 'รูปภาพนี้เคยอัพโหลดไปแล้ว'] );
            }
        }
        else
        {

            $event->title   = $request->title;
            $event->content = $request->content;
            $event->save();

            return redirect( route( 'event.show', $event->id ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'แก้ไขกิจกรรมเสร็จสิ้น'] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy( Event $event )
    {
        $event->delete();

        return redirect( route( 'event.index' ) )->with( ['alert' => true, 'resp' => 'success', 'msg' => 'ลบข้อมูลเสร็จสิ้น'] );
    }
}