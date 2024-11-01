<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit') }}
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
                                <input type="keyword" value="{{ old('keyword', $keyword) }}" class="form-control" id="keyword" aria-describedby="keyword" placeholder="Search Unit" name='keyword'>
                              </div>
                            <div class="input-group-append">
                                <x-primary-button class="d-flex justify-end mr-2" id="searchUnit" type="submit" class="btn btn-default">
                                  search
                                </x-primary-button>
                            </div>
                        </form>
                        <div class="input-group-append">
                                <a href="{{ route('unit.index') }}" class="btn btn-default">
                                    <x-secondary-button id="cancelSearch" type="submit" class="btn btn-default">
                                        Cancel
                                      </x-secondary-button>
                                </a>
                            </div>
                            
                    </div>
                    @if (Auth::user()->role == 'Admin')
                    <div class="d-flex justify-end mb-2">
                        <a class="btn btn-success" href="{{ route('unit.create') }}">Add Unit</a>
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Unit</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">Category</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($units->isEmpty())
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
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                <td>
                                    <h2>No Data</h2>
                                </td>
                            @else
                            @foreach ($units as $unit)
                                <tr>
                                    <th scope="row">{{ $unit->id }}</th>
                                    <td>{{ $unit->kode_unit }}</td>
                                    <td>{{ $unit->nama_unit }}</td>
                                    <td>
                                        {{-- {{ $unit->category_id }} --}}
                                        @foreach ($unit->categories as $category )
                                        <div>
                                            <small>
                                                {{ $category->category_name }}
                                            </small>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $unit->qty }}</td>
                                    <td>
                                            <div class="btn-group btn-group-sm">
                                                @if (Auth::user()->role == 'Admin')
                                                <a title="Edit Unit" href="{{ route('unit.edit', $unit->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt">Edit</i></a>
                                                <a title="Delete Unit" onclick="return confirm('Are you sure you want to delete this?');" href="{{ route('unit.destroy', $unit->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                                                @endif
                                                <a title="Delete Unit"  href="{{ route('borrow.create', $unit->id ) }}" class="btn btn-primary"><i class="fa fa-trash">Borrow</i></a>
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <a title="Review" href="{{ route('reviews.create', ['type' => 'unit', 'id' => $unit->id]) }}" class="btn btn-warning">
                                                    <x-primary-button type="submit">Review</x-primary-button>
                                                </a>
                                            </div>
                                        </td>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $units -> links() }}
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
