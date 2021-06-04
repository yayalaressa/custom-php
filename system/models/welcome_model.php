<?php
if (!defined('BASEPATH')) die('Access Denied!');

class Welcome_model extends Model {

    function hello() {
        return "Welcome Model!";
    }
}