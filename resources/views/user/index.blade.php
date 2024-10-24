<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div d-flex justify-start mb-2>
                        <form action="" class="form-inline" method="GET">
                            {{-- <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value="{{ old('keyword', $keyword) }}"> --}}
                            <div class="form-group d-flex justify-end mr-2">
                                <input type="keyword" value="{{ old('keyword', $keyword) }}" class="form-control" id="keyword" aria-describedby="keyword" placeholder="Search User" name='keyword'>
                              </div>
                            <div class="input-group-append">
                                <x-primary-button class="d-flex justify-end mr-2" id="searchUnit" type="submit" class="btn btn-default">
                                  search
                                </x-primary-button>
                            </div>
                        </form>
                        <div class="input-group-append">
                                <a href="{{ route('users.index') }}" class="btn btn-default">
                                    <x-secondary-button id="cancelSearch" type="submit" class="btn btn-default">
                                        Cancel
                                      </x-secondary-button>
                                </a>
                            </div>
                    </div>
                    <div class="d-flex justify-end mb-2">
                        <a class="btn btn-success" href="{{ route('user.create') }}">Add User</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                            <div class="btn-group btn-group-sm">
                                                <a title="Edit User" href="{{ route('user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt">Edit</i></a>
                                                <a title="Delete User"  href="{{ route('user.destroy', $user->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                                            </div>
                                        </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $users -> links() }}
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
