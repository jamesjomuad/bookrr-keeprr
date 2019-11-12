<?php

Route::get('user/login', function () {
    dump(
        session()
        ->get('customer_id')
    );
});