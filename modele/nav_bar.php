<?php

function GetFullLink ($page) {
    if (isset($page) && $page != "") {
        echo '<a class="navbar-brand" style="float:right" href="'.$page.'">Full</a>';
    }
}



