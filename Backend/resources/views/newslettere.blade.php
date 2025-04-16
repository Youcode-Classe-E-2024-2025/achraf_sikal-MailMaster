<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Latest News</h1>

    <!-- @if($news->isEmpty())
        <p class="text-gray-500">No news available at the moment.</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $item)
                <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-xl transition">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                            class="rounded-xl w-full h-48 object-cover mb-4">
                    @endif

                    <h2 class="text-xl font-semibold mb-2">{{ $item->title }}</h2>
                    <p class="text-gray-600 mb-3">{{ Str::limit($item->summary, 100) }}</p>
                    <p class="text-sm text-gray-400">{{ $item->published_at->format('F j, Y') }}</p>

                    <a href="{{ route('news.show', $item->id) }}" class="inline-block mt-4 text-indigo-600 hover:underline">
                        Read more →
                    </a>
                </div>
            @endforeach
        </div>
    @endif -->
</div>
