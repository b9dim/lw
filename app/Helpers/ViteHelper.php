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
                            // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                            $appUrl = config('app.url', '');
                            $isProduction = app()->environment('production');
                            
                            if ($isProduction || str_starts_with($appUrl, 'https://')) {
                                $baseUrl = str_starts_with($appUrl, 'https://') ? rtrim($appUrl, '/') : 'https://' . parse_url($appUrl, PHP_URL_HOST);
                                $assetPath = ltrim('build/' . $css, '/');
                                $assetUrl = $baseUrl . '/' . $assetPath;
                            } else {
                                $assetUrl = secure_asset('build/' . $css);
                            }
                            
                            $html .= '<link rel="stylesheet" href="' . $assetUrl . '">' . "\n    ";
                        }
                    }
                    
                    // JS
                    if (isset($file['file'])) {
                        // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                        $appUrl = config('app.url', '');
                        $isProduction = app()->environment('production');
                        
                        if ($isProduction || str_starts_with($appUrl, 'https://')) {
                            $baseUrl = str_starts_with($appUrl, 'https://') ? rtrim($appUrl, '/') : 'https://' . parse_url($appUrl, PHP_URL_HOST);
                            $assetPath = ltrim('build/' . $file['file'], '/');
                            $assetUrl = $baseUrl . '/' . $assetPath;
                        } else {
                            $assetUrl = secure_asset('build/' . $file['file']);
                        }
                        
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
                            // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                            $appUrl = config('app.url', '');
                            $isProduction = app()->environment('production');
                            
                            if ($isProduction || str_starts_with($appUrl, 'https://')) {
                                $baseUrl = str_starts_with($appUrl, 'https://') ? rtrim($appUrl, '/') : 'https://' . parse_url($appUrl, PHP_URL_HOST);
                                $assetPath = ltrim($relativePath, '/');
                                $assetUrl = $baseUrl . '/' . $assetPath;
                            } else {
                                $assetUrl = secure_asset($relativePath);
                            }
                            
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
                        // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
                        $appUrl = config('app.url', '');
                        $isProduction = app()->environment('production');
                        
                        if ($isProduction || str_starts_with($appUrl, 'https://')) {
                            $baseUrl = str_starts_with($appUrl, 'https://') ? rtrim($appUrl, '/') : 'https://' . parse_url($appUrl, PHP_URL_HOST);
                            $assetPath = ltrim($relativePath, '/');
                            $assetUrl = $baseUrl . '/' . $assetPath;
                        } else {
                            $assetUrl = secure_asset($relativePath);
                        }
                        
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

