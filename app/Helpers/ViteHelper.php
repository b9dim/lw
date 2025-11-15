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
                            $html .= '<link rel="stylesheet" href="' . asset('build/' . $css) . '">' . "\n    ";
                        }
                    }
                    
                    // JS
                    if (isset($file['file'])) {
                        $html .= '<script type="module" src="' . asset('build/' . $file['file']) . '"></script>' . "\n    ";
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
                            if (str_ends_with($file, '.css')) {
                                $html .= '<link rel="stylesheet" href="' . asset($relativePath) . '">' . "\n    ";
                            } elseif (str_ends_with($file, '.js')) {
                                $html .= '<script type="module" src="' . asset($relativePath) . '"></script>' . "\n    ";
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
                        if ($extension === 'css') {
                            $html .= '<link rel="stylesheet" href="' . asset($relativePath) . '">' . "\n    ";
                        } elseif ($extension === 'js') {
                            $html .= '<script type="module" src="' . asset($relativePath) . '"></script>' . "\n    ";
                        }
                    }
                }
            }
        }
        
        return $html;
    }
}

if (!function_exists('secure_url')) {
    /**
     * إنشاء URL آمن (HTTPS) من route أو URL
     * 
     * @param string|null $path URL path أو route name
     * @param array $parameters معاملات إضافية
     * @param bool $secure فرض HTTPS
     * @return string
     */
    function secure_url($path = null, $parameters = [], $secure = true)
    {
        // إذا كان $path هو URL كامل (من route() أو url())
        if (is_string($path) && (str_starts_with($path, 'http://') || str_starts_with($path, 'https://'))) {
            // حوله إلى HTTPS دائماً
            return str_replace('http://', 'https://', $path);
        }
        
        // إذا كان $path null، استخدم URL الحالي
        if ($path === null) {
            $url = url()->current();
        } else {
            // استخدام url() مع فرض HTTPS
            $url = url($path, $parameters, $secure);
        }
        
        // تأكد من أن URL يبدأ بـ https:// دائماً
        return str_replace('http://', 'https://', $url);
    }
}

