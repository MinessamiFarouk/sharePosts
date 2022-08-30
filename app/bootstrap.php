<?php
    //APP ROOT
    require_once "config/config.php";

    //load helpers
    require_once "helpers/url_helper.php";
    require_once "helpers/session_helper.php";

    //AutoLoad The Core Libraries";
    spl_autoload_register(function ($className) {
        require "libraries/" . $className . ".php";
    });