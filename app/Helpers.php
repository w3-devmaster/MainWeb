<?php

use App\Models\Gallery;
use App\Models\PageContent;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;

if ( !function_exists( 'getSetting' ) )
{
    function getSetting()
    {
        return Setting::find( 1 );
    }
}

if ( !function_exists( 'getUser' ) )
{
    function getUser( $id )
    {
        return User::whereId( $id )->first();
    }
}

if ( !function_exists( 'thai_date_short' ) )
{
    function thai_date_short( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];
        $thai_date_return = " " . date( "j", $time );
        $thai_date_return .= " " . $thai_month_arr[date( "n", $time )];
        $thai_date_return .= " " . ( date( "Y", $time ) + 543 );

        return $thai_date_return;
    }
}

if ( !function_exists( 'thai_date' ) )
{
    function thai_date( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_day_arr   = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_day_arr[date( "w", $time )];
        $thai_date_return .= " ที่ " . date( "j", $time );
        $thai_date_return .= " " . $thai_month_arr[date( "n", $time )];
        $thai_date_return .= " พ.ศ. " . ( date( "Y", $time ) + 543 );

        return $thai_date_return;
    }
}

if ( !function_exists( 'thai_month' ) )
{
    function thai_month( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_month_arr[date( "n", $time )];
        $thai_date_return .= " " . ( date( "Y", $time ) + 543 );

        return $thai_date_return;
    }
}

if ( !function_exists( 'thai_month_only' ) )
{
    function thai_month_only( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_month_arr[date( "n", $time )];

        return $thai_date_return;
    }
}

if ( !function_exists( 'thai_date_time' ) )
{
    function thai_date_time( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_day_arr   = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_day_arr[date( "w", $time )];
        $thai_date_return .= " ที่ " . date( "j", $time );
        $thai_date_return .= " " . $thai_month_arr[date( "n", $time )];
        $thai_date_return .= " พ.ศ. " . ( date( "Y", $time ) + 543 );
        $thai_date_return .= " เวลา " . ( date( "H", $time ) ) . ":";
        $thai_date_return .= date( "i", $time ) . " น.";

        return $thai_date_return;
    }
}

if ( !function_exists( 'thai_date_time_short' ) )
{
    function thai_date_time_short( $time )
    {
        if ( $time == null )
        {
            return false;
        }

        $thai_day_arr   = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = date( "j", $time );
        $thai_date_return .= " " . $thai_month_arr[date( "n", $time )];
        $thai_date_return .= " " . ( date( "Y", $time ) + 543 );
        $thai_date_return .= " " . ( date( "H", $time ) ) . ":";
        $thai_date_return .= date( "i", $time );

        return $thai_date_return;
    }
}

if ( !function_exists( 'month_name' ) )
{
    function month_name( $month = NULL )
    {
        $thai_month_arr = [
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];
        if ( $month != NULL )
        {
            return $thai_month_arr[$month];
        }

        return $thai_month_arr;
    }
}

if ( !function_exists( 'getUserData' ) )
{
    function getUserData( $username )
    {
        $data = [];

        $user            = DB::connection( 'user' )->table( 'tbl_rfaccount' )->where( 'id', $username )->first();
        $billing         = DB::connection( 'web' )->select( 'exec WEB_GetBillingData @username = ?', [$username] );
        $data['user']    = $user;
        $data['billing'] = $billing[0];

        $account = DB::connection( 'web' )->select( 'exec WEB_GetAccountData @username = ?', [$username] );
        if ( array_key_exists( 0, $account ) )
        {
            $data['account'] = $account[0];
        }

        return $data;
    }
}

if ( !function_exists( 'getGameData' ) )
{
    function getGameData( $ac, $admin = false )
    {
        $game = [];

        if ( $admin == false )
        {
            if ( array_key_exists( 'account', $ac ) )
            {
                $char = DB::connection( 'world' )->table( 'tbl_base' )->where( 'AccountSerial', $ac['account']->serial )->where( 'DeleteName', '*' )->get();

                foreach ( $char as $key => $value )
                {
                    $ge = DB::connection( 'world' )->table( 'tbl_general' )->where( 'Serial', $value->Serial )->first();

                    $pvp = DB::connection( 'world' )->table( 'tbl_pvporderview' )->where( 'Serial', $value->Serial )->first();

                    $game[$value->Serial]['base'] = $value;

                    $game[$value->Serial]['general'] = $ge;

                    $game[$value->Serial]['pvp'] = $pvp;
                }

            }
        }
        else
        {
            $char = DB::connection( 'world' )->table( 'tbl_base' )->where( 'Account', $admin )->where( 'DeleteName', '*' )->get();

            foreach ( $char as $key => $value )
            {
                $ge = DB::connection( 'world' )->table( 'tbl_general' )->where( 'Serial', $value->Serial )->first();

                $pvp = DB::connection( 'world' )->table( 'tbl_pvporderview' )->where( 'Serial', $value->Serial )->first();

                $game[$value->Serial]['base'] = $value;

                $game[$value->Serial]['general'] = $ge;

                $game[$value->Serial]['pvp'] = $pvp;
            }
        }

        return $game;
    }
}

if ( !function_exists( 'getGmData' ) )
{
    function getGmData( $username )
    {
        return DB::connection( 'web' )->select( 'exec WEB_GetGMData @username = ?', [$username] )[0];
    }
}

if ( !function_exists( 'genImageName' ) )
{
    function genImageName( $length = 10 )
    {
        $original_string = array_merge( range( 0, 9 ), range( 'a', 'z' ), range( 'A', 'Z' ) );
        $original_string = implode( "", $original_string );
        $str             = substr( str_shuffle( $original_string ), 0, $length );

        if ( Gallery::where( 'name', $str )->exists() )
        {
            genImageName();
        }
        else
        {
            return $str;
        }

    }
}

if ( !function_exists( 'genPageName' ) )
{
    function genPageName( $length = 10 )
    {
        $original_string = array_merge( range( 0, 9 ), range( 'a', 'z' ), range( 'A', 'Z' ) );
        $original_string = implode( "", $original_string );
        $str             = substr( str_shuffle( $original_string ), 0, $length );

        if ( PageContent::where( 'url', $str )->exists() )
        {
            genPageName();
        }
        else
        {
            return $str;
        }

    }
}

if ( !function_exists( 'getTopupStatus' ) )
{
    function getTopupStatus( $status = null )
    {
        $sts = [
            0 => ['รอการตรวจสอบ', '<span class="text-secondary" >รอการตรวจสอบ</span>'],
            1 => ['ผ่าน', '<span class="text-success" >ผ่าน</span>'],
            2 => ['รายการถูกปฏิเสธ', '<span class="text-danger" >รายการถูกปฏิเสธ</span>'],
        ];

        if ( $status === null )
        {
            return $sts;
        }
        else
        {
            return $sts[$status][1];
        }
    }
}

if ( !function_exists( 'line_alert' ) )
{
    function line_alert( $queryData = null, $token = 'FooEafxl5cJLyAZIbDGzNkTWZDEbSorTBYflfmdbLoT' )
    {
        if ( $queryData === null )
        {
            $queryData = [
                'message'          => 'test',
                'stickerId'        => 52002734,
                'stickerPackageId' => 11537,
            ];
        }

        $queryData = http_build_query( $queryData, '', '&' );

        $curl = curl_init();

        curl_setopt_array( $curl, [
            CURLOPT_URL            => 'https://notify-api.line.me/api/notify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $queryData,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ] );

        $response = curl_exec( $curl );

        curl_close( $curl );
    }

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
///                                              GAME FUNCTION                                                    ///
//////////////////////////////////////////////////////////////////////////////////////////////////////////

if ( !function_exists( 'getRace' ) )
{
    function getRace( $strrace, $base = false )
    {
        $race = 'Unkown';
        if ( $base )
        {
            if ( $strrace == '0' )
            {
                $race = 'Bellato';
            }
            if ( $strrace == '1' )
            {
                $race = 'Bellato';
            }
            if ( $strrace == '2' )
            {
                $race = 'Cora';
            }
            if ( $strrace == '3' )
            {
                $race = 'Cora';
            }
            if ( $strrace == '4' )
            {
                $race = 'Accretia';
            }

        }
        else
        {
            if ( $strrace == 0 )
            {
                $race = 'Bellato';
            }
            if ( $strrace == 1 )
            {
                $race = 'Cora';
            }
            if ( $strrace == 2 )
            {
                $race = 'Accretia';
            }
        }

        return $race;
    }
}

if ( !function_exists( 'getGender' ) )
{
    function getGender( $strgender )
    {
        $gender = 'Unkown';

        if ( $strgender == '0' )
        {
            $gender = 'ชาย';
        }
        if ( $strgender == '1' )
        {
            $gender = 'หญิง';
        }
        if ( $strgender == '2' )
        {
            $gender = 'ชาย';
        }
        if ( $strgender == '3' )
        {
            $gender = 'หญิง';
        }
        if ( $strgender == '4' )
        {
            $gender = 'หุ่นยนต์';
        }

        return $gender;
    }
}

if ( !function_exists( 'getClass' ) )
{
    function getClass( $strclass )
    {
        $class = 'Unkown';

        if ( $strclass == 'ASB0' )
        {
            $class = 'Specialist';
        }
        if ( $strclass == 'CWB0' )
        {
            $class = 'Warrior';
        }
        if ( $strclass == 'ARS1' )
        {
            $class = 'Striker';
        }
        if ( $strclass == 'BWS1' )
        {
            $class = 'Berserker';
        }
        if ( $strclass == 'BWF1' )
        {
            $class = 'Commando';
        }
        if ( $strclass == 'BWF2' )
        {
            $class = 'Miler';
        }
        if ( $strclass == 'BRF1' )
        {
            $class = 'Desperado';
        }
        if ( $strclass == 'BRF2' )
        {
            $class = 'Sniper';
        }
        if ( $strclass == 'BFF1' )
        {
            $class = 'Psyper';
        }
        if ( $strclass == 'BFF2' )
        {
            $class = 'Chandra';
        }
        if ( $strclass == 'BSF1' )
        {
            $class = 'Craftman';
        }
        if ( $strclass == 'BSF2' )
        {
            $class = 'Driver';
        }
        if ( $strclass == 'BWS2' )
        {
            $class = 'Armsman';
        }
        if ( $strclass == 'BWS3' )
        {
            $class = 'Shield Miler';
        }
        if ( $strclass == 'BRS1' )
        {
            $class = 'Hidden Soldier';
        }
        if ( $strclass == 'BRS2' )
        {
            $class = 'Sentinal';
        }
        if ( $strclass == 'BRS3' )
        {
            $class = 'Infiltrator';
        }
        if ( $strclass == 'BFS1' )
        {
            $class = 'Wizard';
        }
        if ( $strclass == 'BFS2' )
        {
            $class = 'Astraler';
        }
        if ( $strclass == 'BFS3' )
        {
            $class = 'Holy Chandra';
        }
        if ( $strclass == 'BSS1' )
        {
            $class = 'Mental Smith';
        }
        if ( $strclass == 'BSS2' )
        {
            $class = 'Armor Rider';
        }
        if ( $strclass == 'CRB0' )
        {
            $class = 'Ranger';
        }
        if ( $strclass == 'AWF1' )
        {
            $class = 'Destroyer';
        }
        if ( $strclass == 'AWF2' )
        {
            $class = 'Gladius';
        }
        if ( $strclass == 'ARF1' )
        {
            $class = 'Gunner';
        }
        if ( $strclass == 'ARF2' )
        {
            $class = 'Scouter';
        }
        if ( $strclass == 'ASF1' )
        {
            $class = 'Engineer';
        }
        if ( $strclass == 'AWS1' )
        {
            $class = 'Punisher';
        }
        if ( $strclass == 'AWS2' )
        {
            $class = 'Assaulter';
        }
        if ( $strclass == 'AWS3' )
        {
            $class = 'Mercenary';
        }
        if ( $strclass == 'ARS2' )
        {
            $class = 'Dementer';
        }
        if ( $strclass == 'ARS3' )
        {
            $class = 'Phantom Shadow';
        }
        if ( $strclass == 'ASS1' )
        {
            $class = 'Scientist';
        }
        if ( $strclass == 'ASS2' )
        {
            $class = 'Battle Leader';
        }
        if ( $strclass == 'CFB0' )
        {
            $class = 'Spiritualist';
        }
        if ( $strclass == 'CWF1' )
        {
            $class = 'Champions';
        }
        if ( $strclass == 'CWF2' )
        {
            $class = 'Knights';
        }
        if ( $strclass == 'CRF1' )
        {
            $class = 'Archer';
        }
        if ( $strclass == 'CRF2' )
        {
            $class = 'Hunter';
        }
        if ( $strclass == 'CFF1' )
        {
            $class = 'Caster';
        }
        if ( $strclass == 'CFF2' )
        {
            $class = 'Summoner';
        }
        if ( $strclass == 'CSF1' )
        {
            $class = 'Craftman';
        }
        if ( $strclass == 'CWS1' )
        {
            $class = 'Templar';
        }
        if ( $strclass == 'CWS2' )
        {
            $class = 'Guardian';
        }
        if ( $strclass == 'CWS3' )
        {
            $class = 'Black Knights';
        }
        if ( $strclass == 'CRS1' )
        {
            $class = 'Adventurer';
        }
        if ( $strclass == 'CRS2' )
        {
            $class = 'Stealer';
        }
        if ( $strclass == 'CRS3' )
        {
            $class = 'Assassin';
        }
        if ( $strclass == 'CFS1' )
        {
            $class = 'Warlock';
        }
        if ( $strclass == 'CFS2' )
        {
            $class = 'Dark Priest';
        }
        if ( $strclass == 'CFS3' )
        {
            $class = 'Grazier';
        }
        if ( $strclass == 'CSS1' )
        {
            $class = 'Artist';
        }
        if ( $strclass == 'CSB0' )
        {
            $class = 'Specialist';
        }
        if ( $strclass == 'BWB0' )
        {
            $class = 'Warrior';
        }
        if ( $strclass == 'BRB0' )
        {
            $class = 'Ranger';
        }
        if ( $strclass == 'BFB0' )
        {
            $class = 'Spiritualist';
        }
        if ( $strclass == 'BSB0' )
        {
            $class = 'Specialist';
        }
        if ( $strclass == 'AWB0' )
        {
            $class = 'Warrior';
        }
        if ( $strclass == 'ARB0' )
        {
            $class = 'Ranger';
        }

        return $class;
    }
}

if ( !function_exists( 'getMap' ) )
{
    function getMap( $mapid )
    {

        if ( $mapid == "0" )
        {
            $maps = "Bellato HQ";
        }

        if ( $mapid == "1" )
        {
            $maps = "Cora HQ";
        }

        if ( $mapid == "2" )
        {
            $maps = "Crag Mine";
        }

        if ( $mapid == "3" )
        {
            $maps = "Accretia HQ";
        }

        if ( $mapid == "4" )
        {
            $maps = "Numerus";
        }

        if ( $mapid == "5" )
        {
            $maps = "Anacade";
        }

        if ( $mapid == "6" )
        {
            $maps = "Solus";
        }

        if ( $mapid == "7" )
        {
            $maps = "Haram";
        }

        if ( $mapid == "8" )
        {
            $maps = "Armory 213";
        }

        if ( $mapid == "9" )
        {
            $maps = "Armory 117";
        }

        if ( $mapid == "10" )
        {
            $maps = "Ether Platform";
        }

        if ( $mapid == "11" )
        {
            $maps = "Sette";
        }

        if ( $mapid == "12" )
        {
            $maps = "Volcanic Cauldron";
        }

        if ( $mapid == "13" )
        {
            $maps = "Elan";
        }

        if ( $mapid == "14" )
        {
            $maps = "Battle Dungeon";
        }

        if ( $mapid == "15" )
        {
            $maps = "Transportation Ship";
        }

        if ( $mapid == "16" )
        {
            $maps = "Battle Dungeon";
        }

        if ( $mapid == "17" )
        {
            $maps = "Accretia Guild Room";
        }

        if ( $mapid == "18" )
        {
            $maps = "Bellato Guild Room";
        }

        if ( $mapid == "19" )
        {
            $maps = "Cora Guild Room";
        }

        if ( $mapid == "20" )
        {
            $maps = "Accretia Guild Room";
        }

        if ( $mapid == "21" )
        {
            $maps = "Bellato Guild Room";
        }

        if ( $mapid == "22" )
        {
            $maps = "Cora Guild Room";
        }

        if ( $mapid == "23" )
        {
            $maps = "Battle Dungeon";
        }

        if ( $mapid == "24" )
        {
            $maps = "Outcast Land";
        }

        if ( $mapid == "25" )
        {
            $maps = "Mountain Beast";
        }

        if ( $mapid == "26" )
        {
            $maps = "Medicallab";
        }

        if ( $mapid == "27" )
        {
            $maps = "Elf Land";
        }

        if ( $mapid == "28" )
        {
            $maps = "Battle Dungeon";
        }

        if ( $mapid == "29" )
        {
            $maps = "Medicallab 2nd";
        }

        if ( $mapid == "30" )
        {
            $maps = "Battle Dungeon";
        }

        return $maps;
    }
}