<?php

if(!function_exists('get_prisons')) {
    function get_prisons()
    {
        return \App\Models\Prison::all();
    }
}

if(!function_exists('get_programs')) {
    function get_programs()
    {
        return \App\Models\Program::all();
    }
}
