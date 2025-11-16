@php
    // Helper function لضمان HTTPS في assets دائماً
    $getAssetUrl = function($path) {
        // بناء رابط HTTPS يدوياً لضمان HTTPS دائماً
        $appUrl = config('app.url', '');
        $isProduction = app()->environment('production');
        
        // في production أو إذا كان APP_URL يبدأ بـ https://، استخدم HTTPS مباشرة
        if ($isProduction || str_starts_with($appUrl, 'https://')) {
            // بناء رابط HTTPS يدوياً
            if (str_starts_with($appUrl, 'https://')) {
                $baseUrl = rtrim($appUrl, '/');
            } elseif (!empty($appUrl)) {
                // إذا كان APP_URL لا يبدأ بـ https://، أضفه
                $host = parse_url($appUrl, PHP_URL_HOST) ?: str_replace(['http://', 'https://'], '', $appUrl);
                $baseUrl = 'https://' . rtrim($host, '/');
            } else {
                // إذا كان APP_URL فارغاً، استخدم secure_asset
                return secure_asset($path);
            }
            
            $assetPath = ltrim($path, '/');
            return $baseUrl . '/' . $assetPath;
        }
        
        // وإلا استخدم secure_asset() كـ fallback
        return secure_asset($path);
    };
    
    // التحقق من وجود manifest
    $manifestPath = public_path('build/.vite/manifest.json');
    $manifest = null;
    
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
    }
    
    // إذا كان manifest موجود، استخدمه
    if ($manifest) {
        foreach ($assets as $asset) {
            if (isset($manifest[$asset])) {
                $file = $manifest[$asset];
                
                // CSS - قد يكون في مصفوفة css أو في file مباشرة
                if (isset($file['css']) && is_array($file['css'])) {
                    foreach ($file['css'] as $css) {
                        echo '<link rel="stylesheet" href="' . $getAssetUrl('build/' . $css) . '">' . "\n    ";
                    }
                }
                
                // JS أو CSS في file مباشرة
                if (isset($file['file'])) {
                    $filePath = $file['file'];
                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    
                    if ($extension === 'css') {
                        echo '<link rel="stylesheet" href="' . $getAssetUrl('build/' . $filePath) . '">' . "\n    ";
                    } elseif ($extension === 'js') {
                        echo '<script type="module" src="' . $getAssetUrl('build/' . $filePath) . '"></script>' . "\n    ";
                    }
                }
            }
        }
    } else {
        // Fallback: تحميل مباشر من build/assets
        $buildDir = public_path('build/assets');
        if (is_dir($buildDir)) {
            foreach ($assets as $asset) {
                $basename = basename($asset, '.' . pathinfo($asset, PATHINFO_EXTENSION));
                $extension = pathinfo($asset, PATHINFO_EXTENSION);
                
                $files = glob($buildDir . '/' . $basename . '*.' . $extension);
                foreach ($files as $file) {
                    $relativePath = 'build/assets/' . basename($file);
                    if ($extension === 'css') {
                        echo '<link rel="stylesheet" href="' . $getAssetUrl($relativePath) . '">' . "\n    ";
                    } elseif ($extension === 'js') {
                        echo '<script type="module" src="' . $getAssetUrl($relativePath) . '"></script>' . "\n    ";
                    }
                }
            }
        }
    }
@endphp

