<?php

return [
    //测试
    'mode'=>env('LVDE_API_MODE', 'DEV'),//PROD,LOCAL

    'debug'=>env('LVDE_DEBUG', false),

    'app_id'=>env("LVDE_APP_ID", null),

    'app_secret'=>env("LVDE_APP_ID", null),
];