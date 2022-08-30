<?php
    function redirecte($page) {
        return header("Location: " . URL_ROOT . "/" . $page);
    }