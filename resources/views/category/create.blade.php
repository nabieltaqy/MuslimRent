<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                          <div class="form-group mt-2">
                            <label for="category_name">Category Name</label>
                            <input type="category_name" class="form-control" id="category_name" aria-describedby="category_name" placeholder="Category Name" name='category_name' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" aria-describedby="description" placeholder="Description" name='description' required></textarea>
                          </div>
                        <div class="d-flex justify-end mt-2">
                            {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                            <x-primary-button>{{ __('Add Category') }}</x-primary-button>
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
