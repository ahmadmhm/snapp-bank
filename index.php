<?php

require 'vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use App\Database\Repositories\UserRepository;

$userRepository = new UserRepository;

$user = $userRepository->findById(1);
print_r($user);
echo '<br>';
if (! empty($user)) {
    $userRepository->increaseBalance($user['id'], time() % 10);
}
// $user = $userRepository->updateUser(1, ['balance' => time()]);
$user = $userRepository->findById(1);
print_r($user);
echo '<br>';
new \App\Src\BinarySearch();
// die(55);
