@php
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
                        echo '<link rel="stylesheet" href="' . asset('build/' . $css) . '">' . "\n    ";
                    }
                }
                
                // JS أو CSS في file مباشرة
                if (isset($file['file'])) {
                    $filePath = $file['file'];
                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    
                    if ($extension === 'css') {
                        echo '<link rel="stylesheet" href="' . asset('build/' . $filePath) . '">' . "\n    ";
                    } elseif ($extension === 'js') {
                        echo '<script type="module" src="' . asset('build/' . $filePath) . '"></script>' . "\n    ";
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
                        echo '<link rel="stylesheet" href="' . asset($relativePath) . '">' . "\n    ";
                    } elseif ($extension === 'js') {
                        echo '<script type="module" src="' . asset($relativePath) . '"></script>' . "\n    ";
                    }
                }
            }
        }
    }
@endphp

