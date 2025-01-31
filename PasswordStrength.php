<?php
$password = filter_input(INPUT_GET, 'password') ?: '';
$len = strlen($password);
$lowercase = preg_match_all('/[a-z]/', $password);
$digits = preg_match_all('/\d/', $password);
$uppercase = preg_match_all('/[A-Z]/', $password);
$repeated = 0;
$charCounts = count_chars($password, 1);
foreach ($charCounts as $char => $count) {
    if ($count > 1) {
        $repeated += $count - 1;
    }
}
if ($digits + $uppercase + $lowercase !== $len) {
    echo 'wrong password: incorrecrt symbols';
} else {
    $strength = 0;
    $strength += 4 * $len;
    $strength += 4 * $digits;
    if ($uppercase > 0) {
        $strength += ($len - $uppercase) * 2;
    }
    if ($lowercase > 0) {
        $strength += ($len - $lowercase) * 2;
    }
    if ($len === $uppercase + $lowercase) {
        $strength -= $len;
    }
    if ($len === $digits) {
        $strength -= $len;
    }
    $strength -= $repeated;
    echo $strength;
}