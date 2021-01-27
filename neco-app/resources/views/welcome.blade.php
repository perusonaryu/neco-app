<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NECO APP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <v-app>
                <div>
                    Navigation
                    <ul>
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
                    </ul>
                </div>
                <div>
                    Contents
                    <router-view />
                </div>

            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
