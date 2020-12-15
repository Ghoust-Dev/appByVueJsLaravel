<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
        <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

        <link rel="stylesheet" href="{{asset('css/main.css')}}">

        <title>MultiForm</title>

   </head>
    <body>
        <div class="container-fluid" id="app">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2 id="heading">Add your Information</h2>
                        <p>Fill all form field to go to next step</p>
                        <form id="msform">
                            <Progressbar></Progressbar>
                            <router-view></router-view>
                            <Company></Company>
                            <Validate></Validate>
                            <Success></Success>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
