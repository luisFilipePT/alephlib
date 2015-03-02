<html>
    <head>
        <title>Laravel</title>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
        </head>
        <body>
            <div class="container">
                <div class="content">
                    <div class="title">Laravel 5</div>
                    <div class="searchform">
                        <form method="POST" action="/result" id="teste">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input name="search" placeholder="Title, author, ISBN">
                            <input type="submit" value="Search">
                        </form>
                    </div>
                    <div class="quote">{{ Inspiring::quote() }}</div>
                </div>
            </div>
        </body>
    </html>