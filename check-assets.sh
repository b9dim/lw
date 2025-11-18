#!/bin/bash

# Script للتحقق من وجود الأصول بعد البناء
# يُستخدم في Render Shell للتحقق من أن الأصول بُنيت بشكل صحيح

echo "🔍 التحقق من وجود الأصول..."
echo ""

# التحقق من وجود مجلد build
if [ -d "public/build" ]; then
    echo "✅ مجلد public/build موجود"
else
    echo "❌ مجلد public/build غير موجود!"
    exit 1
fi

# التحقق من وجود ملفات CSS
CSS_COUNT=$(find public/build/assets -name "*.css" 2>/dev/null | wc -l)
if [ "$CSS_COUNT" -gt 0 ]; then
    echo "✅ تم العثور على $CSS_COUNT ملف CSS"
    find public/build/assets -name "*.css" | head -3
else
    echo "❌ لم يتم العثور على أي ملفات CSS!"
fi

# التحقق من وجود ملفات JS
JS_COUNT=$(find public/build/assets -name "*.js" 2>/dev/null | wc -l)
if [ "$JS_COUNT" -gt 0 ]; then
    echo "✅ تم العثور على $JS_COUNT ملف JS"
    find public/build/assets -name "*.js" | head -3
else
    echo "❌ لم يتم العثور على أي ملفات JS!"
fi

# التحقق من وجود manifest
if [ -f "public/build/.vite/manifest.json" ]; then
    echo "✅ ملف manifest.json موجود"
    echo "📄 محتوى manifest (أول 20 سطر):"
    head -20 public/build/.vite/manifest.json
else
    echo "❌ ملف manifest.json غير موجود!"
    echo "🔍 البحث في public/build:"
    ls -la public/build/ 2>/dev/null || echo "مجلد build فارغ أو غير موجود"
fi

echo ""
echo "📊 ملخص:"
echo "  - مجلد build: $([ -d "public/build" ] && echo "✅" || echo "❌")"
echo "  - ملفات CSS: $CSS_COUNT"
echo "  - ملفات JS: $JS_COUNT"
echo "  - Manifest: $([ -f "public/build/.vite/manifest.json" ] && echo "✅" || echo "❌")"

