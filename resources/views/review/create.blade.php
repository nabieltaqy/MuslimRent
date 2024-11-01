<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Menampilkan reviews unit --}}
<h2>Reviews:</h2>
@if($unit->reviews->isEmpty())
    <p>Belum ada review untuk unit ini.</p>
@else
    @foreach($unit->reviews as $review)
        <div>
            <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
            <p>{{ $review->content }}</p>
            <p><em>Ditulis pada: {{ $review->created_at->format('d M Y') }}</em></p>
            <hr>
        </div>
    @endforeach
@endif

                    <form action="{{ route('reviews.store', ['type' => 'unit', 'id' => $unit->id]) }}" method="POST">
    @csrf
    <div>
        <label for="content">Konten:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <div>
        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
            <option value="">Pilih Rating</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <button type="submit">Tambahkan Review</button>
</form>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        @if(session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('error') }}',
            icon: 'fail',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
</x-app-layout>
