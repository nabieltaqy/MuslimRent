<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- <div>
                        <form action="" class="form-inline" method="GET">

                            <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value="">

                            <div class="input-group-append">
                                <button id="searchUser" type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            {{-- <input type="reset" name= "Reset" value="Reset" href="/pengaturanadmin"> --}}
                        {{-- </form>
                    </div> --}}
                    <div class="d-flex justify-end mb-2">
                        <a class="btn btn-success" href="{{ route('category.create') }}">Add Category</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isEmpty())
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                <td>
                                    <h2>No Data</h2>
                                </td>
                            @else
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                            <div class="btn-group btn-group-sm">
                                                <a title="Edit User" href="{{ route('category.edit', $category->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt">Edit</i></a>
                                                <a title="Delete User"  href="{{ route('category.destroy', $category->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                                            </div>
                                        </td>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $categories -> links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk menampilkan SweetAlert setelah berhasil menambah question
        @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
</x-app-layout>
