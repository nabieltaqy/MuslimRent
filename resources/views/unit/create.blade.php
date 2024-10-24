<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Unit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('unit.store') }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="kode_unit">Unit Code</label>
                            <input type="kode_unit" class="form-control" id="kode_unit" aria-describedby="kode_unit" placeholder="Unit Code" name='kode_unit' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="nama_unit">Unit Name</label>
                            <input type="nama_unit" class="form-control" id="nama_unit" aria-describedby="nama_unit" placeholder="Unit Name" name='nama_unit' required>
                          </div>
                          <div class="form-group mt-2">
                            {{-- <label for="description">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select> --}}
                                <label for="categories">Category</label>
                                <div>
                                    @foreach($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}">
                                            <label class="form-check-label" for="category_{{ $category->id }}">
                                                {{ $category->category_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" name="qty" min="1" required>
                            </div>
                            <div class="d-flex justify-end mt-2">
                                {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                                <x-primary-button>{{ __('Add Unit') }}</x-primary-button>
                            </div>
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
</x-app-layout>
