<?php

if (!function_exists('vite_assets')) {
    /**
     * تحميل أصول Vite مع fallback للأصول المُجمعة
     */
    function vite_assets(array $assets): string
    {
        $html = '';
        
        // محاولة استخدام @vite() أولاً
        try {
            ob_start();
            vite($assets);
            $viteOutput = ob_get_clean();
            
            if (!empty($viteOutput)) {
                return $viteOutput;
            }
        } catch (\Exception $e) {
            // إذا فشل Vite، استخدم fallback
        }
        
        // Fallback: تحميل الأصول المُجمعة مباشرة
        $manifestPath = public_path('build/.vite/manifest.json');
        
        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            
            foreach ($assets as $asset) {
                if (isset($manifest[$asset])) {
                    $file = $manifest[$asset];
                    
                    // CSS
                    if (isset($file['css'])) {
                        foreach ($file['css'] as $css) {
                            // استخدام secure_asset في production أو إذا كان APP_URL يبدأ بـ https://
                            $appUrl = config('app.url', '');
                            $isProduction = app()->environment('production');
                            $assetUrl = ($isProduction || str_starts_with($appUrl, 'https://')) 
                                ? secure_asset('build/' . $css) 
                                : asset('build/' . $css);
                            $html .= '<link rel="stylesheet" href="' . $assetUrl . '">' . "\n    ";
                        }
                    }
                    
                    // JS
                    if (isset($file['file'])) {
                        // استخدام secure_asset في production أو إذا كان APP_URL يبدأ بـ https://
                        $appUrl = config('app.url', '');
                        $isProduction = app()->environment('production');
                        $assetUrl = ($isProduction || str_starts_with($appUrl, 'https://')) 
                            ? secure_asset('build/' . $file['file']) 
                            : asset('build/' . $file['file']);
                        $html .= '<script type="module" src="' . $assetUrl . '"></script>' . "\n    ";
                    }
                } else {
                    // إذا لم يُوجد في manifest، حاول تحميل مباشرة
                    $assetPath = str_replace('resources/', 'build/assets/', $asset);
                    $assetPath = str_replace(['.css', '.js'], '', $assetPath);
                    
                    // البحث عن الملفات في build/assets
                    $buildDir = public_path('build/assets');
                    if (is_dir($buildDir)) {
                        $files = glob($buildDir . '/' . basename($assetPath) . '*');
                        foreach ($files as $file) {
                            $relativePath = 'build/assets/' . basename($file);
                            // استخدام secure_asset في production أو إذا كان APP_URL يبدأ بـ https://
                            $appUrl = config('app.url', '');
                            $isProduction = app()->environment('production');
                            $assetUrl = ($isProduction || str_starts_with($appUrl, 'https://')) 
                                ? secure_asset($relativePath) 
                                : asset($relativePath);
                            
                            if (str_ends_with($file, '.css')) {
                                $html .= '<link rel="stylesheet" href="' . $assetUrl . '">' . "\n    ";
                            } elseif (str_ends_with($file, '.js')) {
                                $html .= '<script type="module" src="' . $assetUrl . '"></script>' . "\n    ";
                            }
                        }
                    }
                }
            }
        } else {
            // إذا لم يُوجد manifest، حاول تحميل الأصول مباشرة من build/assets
            $buildDir = public_path('build/assets');
            if (is_dir($buildDir)) {
                foreach ($assets as $asset) {
                    $basename = basename($asset, strrchr($asset, '.'));
                    $extension = pathinfo($asset, PATHINFO_EXTENSION);
                    
                    $files = glob($buildDir . '/' . $basename . '*.' . $extension);
                    foreach ($files as $file) {
                        $relativePath = 'build/assets/' . basename($file);
                        // استخدام secure_asset في production أو إذا كان APP_URL يبدأ بـ https://
                        $appUrl = config('app.url', '');
                        $isProduction = app()->environment('production');
                        $assetUrl = ($isProduction || str_starts_with($appUrl, 'https://')) 
                            ? secure_asset($relativePath) 
                            : asset($relativePath);
                        
                        if ($extension === 'css') {
                            $html .= '<link rel="stylesheet" href="' . $assetUrl . '">' . "\n    ";
                        } elseif ($extension === 'js') {
                            $html .= '<script type="module" src="' . $assetUrl . '"></script>' . "\n    ";
                        }
                    }
                }
            }
        }
        
        return $html;
    }
}

