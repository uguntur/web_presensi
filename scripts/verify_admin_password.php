<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@example.com';
$password = $argv[1] ?? 'Password123!';
$user = User::where('email', $email)->first();
if (!$user) {
    echo "NOT_FOUND\n";
    exit(0);
}

$check = Hash::check($password, $user->password) ? 'MATCH' : 'NO_MATCH';
echo "USER_FOUND\n";
echo "email: {$user->email}\n";
echo "role: {$user->role}\n";
echo "password_check: {$check}\n";
