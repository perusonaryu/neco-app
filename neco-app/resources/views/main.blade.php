<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NECO APP</title>
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
                            <router-link 
                            exact
                            :to="{name:'userRegister'}"
                            >
                                Register
                            </router-link>
                        </li>
                        <li>
                            <router-link 
                            :to="{name:'userLogin'}"
                            >
                                Login
                            </router-link>
                        </li>
                        <li>
                            <router-link 
                            :to="{name:'userPage'}"
                            >
                                マイページ
                            </router-link>
                        </li>
                        <li>
                            <router-link 
                            :to="{name:'catRegister'}"
                            >
                                猫登録
                            </router-link>
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
