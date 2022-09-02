<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0:
        }

        body {
            overflow: hidden;
        }

        #main {
            width: 595px;
            height: 369px;
            background-repeat: no-repeat;
            background-image: url({{ Storage::url('images/patch-bg.webp') }} );
        }

        #main ul {
            list-style-type: none;
            margin: 0;
            padding: 0 10px;
        }

        #main ul li {
            border-bottom: 1px dashed orange;
        }

        #main ul li a {
            color: #FFF;
            text-decoration: none;
            transition: all 500ms;
            font-size: 14px;
            display: block;
            padding: 3px 0;
        }

        #main ul li a:hover {
            color: orange;
            padding-left: 10px;
        }

        .float-end {
            float: right;
        }
    </style>
</head>

<body>
    <div id="main">
        <ul class="list-unstyled f-12 tahoma">
            @foreach ($news as $item)
                <li class="border-bottom border-secondary mb-1">
                    <a target="_blank" href="{{ route('view-news', $item->id) }}">> {{ Str::limit($item->title, 100, '...') }} <span class="float-end">{{ thai_date_short(strtotime($item->created_at)) }}</span></a>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
