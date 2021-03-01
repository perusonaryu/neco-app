<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>NECO APP</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            *{
                color:#333333;
            }


            a{
                text-decoration:none!important;
            }

            [v-cloak] {
                display: none;
            }


        </style>
    </head>
    <body>
        <div id="app">
            <v-app>
                <header-component> </header-component>
                <div class="content">
                    <router-view />
                </div>

            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
