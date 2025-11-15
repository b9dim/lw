@if ($paginator->hasPages())
    <nav class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded">السابق</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-50 text-moj-green-600">
                    السابق
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-moj-green-600 text-white rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-50 text-moj-green-600">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-white border border-gray-300 rounded hover:bg-gray-50 text-moj-green-600">
                    التالي
                </a>
            @else
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed rounded">التالي</span>
            @endif
        </div>
    </nav>
@endif

