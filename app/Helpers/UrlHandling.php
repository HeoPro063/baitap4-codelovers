<?php 
namespace App\Helpers;
use URL;

class UrlHandling {

    public function get_url_current() {
        return URL::current();
    }

    public function get_url_previous() {
        return URL::previous();
    }

}
