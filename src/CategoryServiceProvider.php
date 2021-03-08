<?php

namespace Viralsoft\Category;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->registerModule();
    }

    private function registerModule() {
        $modulePath = __DIR__ . '/';
        // Khai báo route
        if (File::exists($modulePath . "routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes/routes.php");
        }

        // Toàn bộ file migration của modules sẽ tự động được load
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        // Gọi view thì ta sử dụng: view('Demo::index'), @extends('Demo::index'), @include('Demo::index')
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", 'Category');
        }

//        // Khai báo helpers
        if (File::exists($modulePath . "helpers")) {
            // Tất cả files có tại thư mục helpers
            $helper_dir = File::allFiles($modulePath . "helpers");
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }

        // Khai báo languages
        if (File::exists($modulePath . "resources/lang")) {
            // Dùng đa ngôn ngữ tại file php resources/lang/en/general.php : @lang('Demo::general.hello')
            $this->loadTranslationsFrom($modulePath . "resources/lang", 'Category');
            // Đa ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }
    }
}
