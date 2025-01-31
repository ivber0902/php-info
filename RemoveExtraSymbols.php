<?php
$text = filter_input(INPUT_GET, 'text') ?: 'логин не передан!';
$text = preg_replace('/\*+/', '*', $text);
echo $text;