<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('borrow.update', $borrow->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-2">

                            {{-- hidden parameter --}}
                            <input type="hidden" name="user_id" value="old({{$borrow->user_id}})" hidden>
                            <input type="hidden" name="unit_id" value="old({{$borrow->unit_id}})" hidden>
                            
                            <label for="unit_name" class="mt-2">Unit Name</label>
                            <input type="unit_name" class="form-control" id="unit_name" aria-describedby="unit_name" placeholder="Unit Name" value="{{ $borrow->unit->nama_unit }}" disabled>

                            <div class="form-row">
                                <div class="col">
                                    <label for="borrow_date" class="mt-2">Borrow Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" value="{{ $borrow->borrow_date }}" aria-describedby="borrow_date" placeholder="Borrow Date" name='borrow_date' disabled>
                                </div>
                                <div class="col ml-2">
                                    <label for="return_date" class="mt-2">Return Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" value="{{ $borrow->return_date }}" aria-describedby="return_date" placeholder="Return Date" name='return_date' disabled>
                                </div>
                            </div>

                            <label for="qty" class="mt-2">Amount</label>
                            <input type="number" class="form-control" id="qty" value="{{ $borrow->qty }}" aria-describedby="qty" placeholder="Amount" max="{{ $borrow->qty }}" min="1" name='qty' disabled>

                            <label for="status" class="mt-2">Status</label>
                            <select class="mt-2 form-control" name="status" id="status">
                                <option style="background-color: rgb(187, 119, 17)" value="Waiting" {{ $borrow->status == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                <option style="background-color:rgb(34, 190, 73);" value="Approved" {{ $borrow->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option  style="background-color:rgb(190, 26, 26);" value="Rejected" {{ $borrow->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                <option style="background-color:rgb(28, 72, 192);" value="On Going" {{ $borrow->status == 'On Going' ? 'selected' : '' }}>On Going</option>
                                
                            </select>

                            {{-- <label for="category_name">Category Name</label>
                            <input type="category_name" class="form-control" id="category_name" aria-describedby="category_name" placeholder="Category Name" name='category_name' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" aria-describedby="description" placeholder="Description" name='description' required></textarea>
                          </div> --}}
                        <div class="d-flex justify-end mt-2">
                            {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
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
