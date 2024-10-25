<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrows') }}
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
                                <input type="keyword" value="{{ old('keyword', $keyword) }}" class="form-control" id="keyword" aria-describedby="keyword" placeholder="Search.." name='keyword'>
                              </div>
                            <div class="input-group-append">
                                <x-primary-button class="d-flex justify-end mr-2" id="searchUnit" type="submit" class="btn btn-default">
                                  search
                                </x-primary-button>
                            </div>
                        </form>
                        <div class="input-group-append">
                                <a href="{{ route('category.index') }}" class="btn btn-default">
                                    <x-secondary-button id="cancelSearch" type="submit" class="btn btn-default">
                                        Cancel
                                      </x-secondary-button>
                                </a>
                            </div>
                            
                    </div>
                    <div class="d-flex justify-end mb-2">
                        <a class="btn btn-success" href="{{ route('unit.index') }}">Borrow Something ?</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Time</th>
                                <th scope="col">Unit Code</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Borrow Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Actual Return Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Penalty</th>
                                @if (Auth::user()->role == 'Admin')
                                <th scope="col">Borrower</th>
                                <th scope="col">Last Edit</th>
                                @endif
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($borrows->isEmpty())
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
                                @if (Auth::user()->role == 'Admin')
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                <td>
                                    <h2>No Data</h2>
                                </td>
                                @endif
                            @else
                            @foreach ($borrows as $borrow)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $borrow->created_at->diffForHumans() }}</td>
                                    <td>{{ $borrow->unit->kode_unit }}</td>
                                    <td>{{ $borrow->unit->nama_unit }}</td>
                                    <td>{{ $borrow->qty }}</td>
                                    <td>{{ $borrow->borrow_date }}</td>
                                    <td>{{ $borrow->return_date }}</td>
                                    @if ($borrow->actual_return_date == null)
                                    <td class="text-muted">No Data</td>
                                    @else
                                    <td>{{ $borrow->actual_return_date }}</td>
                                    @endif

                                    @if($borrow->status == 'Waiting')
                                    <td style="background-color: rgb(187, 119, 17); color: white">{{ $borrow->status}}</td>
                                    @elseif ($borrow->status == 'Returned')
                                    <td style="background-color: yellowgreen; color: white">{{ $borrow->status}}</td>
                                    @elseif($borrow->status == 'Approved')
                                    <td style="background-color: rgb(34, 190, 73); color: white">{{ $borrow->status}}</td>
                                    @elseif($borrow->status == 'Rejected')
                                    <td style="background-color: rgb(190, 26, 26); color: white">{{ $borrow->status}}</td>
                                    @elseif($borrow->status == 'On Going')
                                    <td style="background-color: rgb(28, 72, 192); color: white">{{ $borrow->status}}</td>
                                    @endif
                                   
                                        <td>
                                            <h2>{{ $borrow->penalty }}</h2>
                                        </td>
                                 
                                    @if (Auth::user()->role == 'Admin')
                                        
                                    <td>{{ $borrow->borrower->name }}</td>
                                    
                                    @if ($borrow->editor == null)
                                    <td class="text-muted">No Data</td>
                                    @else
                                    <td>{{ $borrow->editor->name}}</td>
                                    @endif
                                    @endif
                                    {{-- <td>{{ $borrow->description }}</td> --}}
                                    @if (Auth::user()->role == 'Admin')
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a title="Edit Borrow" href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-info"><i class="fa fa-pencil-alt">Edit</i></a>
                                            <a title="Delete Borrow" onclick="return confirm('Are you sure you want to delete this record?');" href="{{ route('borrow.destroy', $borrow->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Delete</i></a>
                                            @if ($borrow->status == 'On Going')
                                            <a title="Return Borrow"  href="{{ route('borrow.return', $borrow->id ) }}" class="btn btn-primary"><i class="fa fa-trash">Return</i></a>
                                            @endif
                                        </div>
                                    </td>
                                    @elseif ($borrow->status == 'Waiting')
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a title="Delete User" onclick="return confirm('Are you sure you want to delete this?');" href="{{ route('borrow.destroy', $borrow->id ) }}" class="btn btn-danger"><i class="fa fa-trash">Cancel</i></a>
                                        </div>
                                    @else
                                    <td>
                                        <h2 class="text-muted">Nothing</h2>
                                    </td>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex float left mt-2">
                        <a class="btn btn-secondary" href="{{ route('borrow.print') }}">Print to PDF</a>
                    </div>
                    <div class="float-right">
                        {{ $borrows -> links() }}
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
        @elseif(session('error'))
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session('error') }}',
            icon: 'fail',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
</x-app-layout>
