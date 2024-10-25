<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penalty') }}
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
                                <input type="keyword" value="{{ old('keyword', $keyword) }}" class="form-control" id="keyword" aria-describedby="keyword" placeholder="Search Penalty" name='keyword'>
                              </div>
                            <div class="input-group-append">
                                <x-primary-button class="d-flex justify-end mr-2" id="searchPenalty" type="submit" class="btn btn-default">
                                  search
                                </x-primary-button>
                            </div>
                        </form>
                        <div class="input-group-append">
                                <a href="{{ route('penalty.index') }}" class="btn btn-default">
                                    <x-secondary-button id="cancelSearch" type="submit" class="btn btn-default">
                                        Cancel
                                      </x-secondary-button>
                                </a>
                            </div>
                            
                    </div>
                    <div class="d-flex justify-end mb-2">
                        <a class="btn btn-success" href="{{ route('penalty.create') }}">Add Penalty</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Penalty Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($penalties->isEmpty())
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
                            @foreach ($penalties as $penalty)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $penalty->penalty_name }}</td>
                                    <td>{{ $penalty->amount }}</td>
                                    <td>
                                        <a title="Edit penalty" href="{{ route('penalty.edit', $penalty->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt">Edit</i></a>
                                        <a title="Delete penalty" onclick="return confirm('Are you sure you want to delete this record?');" href="{{ route('penalty.destroy', $penalty->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $penalties -> links() }}
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
