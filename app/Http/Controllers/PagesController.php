<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\Event;
use App\Models\News;
use App\Models\PageContent;
use App\Models\Slide;

class PagesController extends Controller
{
    public function index()
    {
        $news  = News::orderByDesc( 'created_at' )->limit( 10 )->get();
        $event = Event::orderByDesc( 'created_at' )->limit( 6 )->get();
        $page  = PageContent::inRandomOrder()->limit( 20 )->get();
        $slide = Slide::inRandomOrder()->limit( 8 )->get();

        return view( 'pages.index', compact( 'news', 'event', 'page', 'slide' ) );
    }

    public function download()
    {
        return view( 'pages.download' );
    }

    public function information()
    {
        return view( 'pages.information' );
    }

    public function level_rank()
    {

    }

    public function news_all()
    {
        $news = News::orderByDesc( 'created_at' )->paginate( 30 );

        return view( 'pages.news-all', compact( 'news' ) );
    }

    public function event_all()
    {
        $event = Event::orderByDesc( 'created_at' )->paginate( 30 );

        return view( 'pages.event-all', compact( 'event' ) );
    }

    public function pages_all()
    {
        $pages = PageContent::orderByDesc( 'created_at' )->paginate( 30 );

        return view( 'pages.pages-all', compact( 'pages' ) );
    }

    public function viewpage( $url )
    {
        if ( PageContent::where( 'url', $url )->exists() )
        {
            $page  = PageContent::where( 'url', $url )->first();
            $pages = PageContent::inRandomOrder()->limit( 5 )->get();

            return view( 'pages.view', compact( 'page', 'pages' ) );
        }
        else
        {
            return abort( 404 );
        }
    }

    public function viewnews( $id )
    {
        if ( News::where( 'id', $id )->exists() )
        {
            $news   = News::where( 'id', $id )->first();
            $newses = News::inRandomOrder()->limit( 5 )->get();

            return view( 'pages.view-news', compact( 'news', 'newses' ) );
        }
        else
        {
            return abort( 404 );
        }
    }

    public function viewevent( $id )
    {
        if ( Event::where( 'id', $id )->exists() )
        {
            $event  = Event::where( 'id', $id )->first();
            $events = Event::inRandomOrder()->limit( 5 )->get();

            return view( 'pages.view-event', compact( 'event', 'events' ) );
        }
        else
        {
            return abort( 404 );
        }
    }

    public function patcher()
    {
        $news = News::orderByDesc( 'id' )->limit( 5 )->get();

        return view( 'pages.patcher', compact( 'news' ) );
    }

}
