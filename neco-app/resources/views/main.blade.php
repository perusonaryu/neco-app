<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NECO APP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            ul li{
                margin:0 10px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <v-app>
                <div>
                    Navigation
                    <ul style="display:flex; list-style:none;">
                        <li>
                            <router-link to="/userRegister">
                                Register
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/userLogin">
                                Login
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/userPage">マイページ</router-link>
                        </li>
                        <li>
                            <router-link to="/catRegister">猫登録</router-link>
                        </li>
                    </ul>
                </div>
                <div>
                    <router-view />
                </div>

            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
