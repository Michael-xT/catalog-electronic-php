<?php
unset($_SESSION['user']);
session_destroy();
Redirect::to('/');
