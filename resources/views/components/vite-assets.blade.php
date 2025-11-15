@php
    // محاولة استخدام Vite أولاً
    $viteLoaded = false;
    
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
                
                // CSS
                if (isset($file['css'])) {
                    foreach ($file['css'] as $css) {
                        echo '<link rel="stylesheet" href="' . asset('build/' . $css) . '">' . "\n    ";
                    }
                }
                
                // JS
                if (isset($file['file'])) {
                    echo '<script type="module" src="' . asset('build/' . $file['file']) . '"></script>' . "\n    ";
                }
                $viteLoaded = true;
            }
        }
    }
    
    // إذا لم يتم تحميل الأصول من manifest، حاول تحميلها مباشرة
    if (!$viteLoaded) {
        $buildDir = public_path('build/assets');
        if (is_dir($buildDir)) {
            foreach ($assets as $asset) {
                $basename = basename($asset, '.' . pathinfo($asset, PATHINFO_EXTENSION));
                $extension = pathinfo($asset, PATHINFO_EXTENSION);
                
                $files = glob($buildDir . '/' . $basename . '*.' . $extension);
                foreach ($files as $file) {
                    $relativePath = 'build/assets/' . basename($file);
                    if ($extension === 'css') {
                        echo '<link rel="stylesheet" href="' . asset($relativePath) . '">' . "\n    ";
                    } elseif ($extension === 'js') {
                        echo '<script type="module" src="' . asset($relativePath) . '"></script>' . "\n    ";
                    }
                }
            }
        }
    }
@endphp

