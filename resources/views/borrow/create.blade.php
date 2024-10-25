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
                    <form action="{{ route('borrow.store') }}" method="post">
                        @csrf
                          <div class="form-group mt-2">

                            {{-- hidden parameter --}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" hidden>
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}" hidden>
                            
                            <label for="unit_name" class="mt-2">Unit Name</label>
                            <input type="unit_name" class="form-control" id="unit_name" aria-describedby="unit_name" placeholder="Unit Name" value="{{ $unit->nama_unit }}" disabled>

                            <div class="form-row">
                                <div class="col">
                                    <label for="borrow_date" class="mt-2">Borrow Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" aria-describedby="borrow_date" placeholder="Borrow Date" name='borrow_date' required>
                            <small class="form-text text-muted">max days : 5</small>
                                
                                </div>
                                <div class="col ml-2">
                                    <label for="return_date" class="mt-2">Return Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" aria-describedby="return_date" placeholder="Return Date" name='return_date' required>
                                </div>
                            </div>

                            <label for="qty" class="mt-2">Amount</label>
                            <input type="number" class="form-control" id="qty" aria-describedby="qty" placeholder="Amount" max="{{ $unit->qty }}" min="1" name='qty' required>
                            <small class="form-text text-muted">max amount: {{ $unit->qty }}</small>


                            {{-- <label for="category_name">Category Name</label>
                            <input type="category_name" class="form-control" id="category_name" aria-describedby="category_name" placeholder="Category Name" name='category_name' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" aria-describedby="description" placeholder="Description" name='description' required></textarea>
                          </div> --}}
                        <div class="d-flex justify-end mt-2">
                            {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                            <x-primary-button>{{ __('Borrow') }}</x-primary-button>
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
