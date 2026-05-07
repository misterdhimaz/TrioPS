<?php

// 1. Aktifkan Error Reporting untuk Debugging (Bisa dimatikan jika sudah lancar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Masuk ke folder root aplikasi
chdir(__DIR__ . '/../');

// 3. Load Autoloader Vendor
require __DIR__ . '/../vendor/autoload.php';

// 4. Konfigurasi Storage Serverless (Workaround untuk Read-Only Filesystem)
$storagePath = '/tmp/storage';
$storageFolders = [
    $storagePath . '/app/public',
    $storagePath . '/framework/views',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/cache',
    $storagePath . '/bootstrap/cache',
    $storagePath . '/logs',
];

// Buat folder secara otomatis jika belum ada di /tmp
foreach ($storageFolders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }
}

// 5. Override Environment Variables untuk folder Cache & Logs
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");
putenv("APP_CONFIG_CACHE={$storagePath}/bootstrap/cache/config.php");
putenv("APP_ROUTES_CACHE={$storagePath}/bootstrap/cache/routes.php");
putenv("APP_SERVICES_CACHE={$storagePath}/bootstrap/cache/services.php");
putenv("APP_PACKAGES_CACHE={$storagePath}/bootstrap/cache/packages.php");

// 6. Inisialisasi Aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 7. Paksa Laravel menggunakan path storage di /tmp
$app->useStoragePath($storagePath);

// 8. Jalankan Kernel Laravel (Menangani Request & Response)
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);