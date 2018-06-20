<?php

class MainCtrl extends Controller{

    public static function init(){
        render('parts/header');
        render('main');
        render('parts/footer');
    }

}