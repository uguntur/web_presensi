<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$exists = \App\Models\User::where('email', 'admin@example.com')->exists();
echo $exists ? 'FOUND' : 'NOT_FOUND';
