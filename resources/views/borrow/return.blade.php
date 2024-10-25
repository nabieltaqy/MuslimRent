<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Return Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('borrow.saveReturn', $borrow->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-2">

                            {{-- hidden parameter --}}
                            {{-- <input type="hidden" name="user_id" value="old({{$borrow->user_id}})" hidden>
                            <input type="hidden" name="unit_id" value="old({{$borrow->unit_id}})" hidden> --}}
                            <div class="form-row">
                                <div class="col">
                                    <label for="unit_code" class="mt-2">Unit Code</label>
                                    <input type="unit_code" class="form-control" id="unit_code" aria-describedby="unit_code" placeholder="Unit Code" value="{{ $borrow->unit->kode_unit }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="unit_name" class="mt-2">Unit Name</label>
                                    <input type="unit_name" class="form-control" id="unit_name" aria-describedby="unit_name" placeholder="Unit Name" value="{{ $borrow->unit->nama_unit }}" disabled>
                                </div>
                            </div>
                            
                            <label for="borrower" class="mt-2">Borrower Name</label>
                            <input type="borrower" class="form-control" id="borrower" aria-describedby="borrower" placeholder="Borrower Name" value="{{ $borrow->borrower->name }}" disabled>
                            

                            <div class="form-row">
                                <div class="col">
                                    <label for="borrow_date" class="mt-2">Borrow Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" value="{{ $borrow->borrow_date }}" aria-describedby="borrow_date" placeholder="Borrow Date" name='borrow_date' disabled>
                                </div>
                                <div class="col ml-2">
                                    <label for="return_date" class="mt-2">Return Date</label>
                                    <input type="date" id="return_date" min="{{ date('Y-m-d') }}" class="form-control" id="borrow_date" value="{{ $borrow->return_date }}" aria-describedby="return_date" placeholder="Return Date" name='return_date' disabled>
                                </div>
                                <div class="col ml-2">
                                    <label for="actual_return_date" class="mt-2">Actual Return Date</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" id="actual_return_date" class="form-control" id="actual_return_date" value="{{ date('Y-m-d') }}" aria-describedby="actual_return_date" placeholder="Actual Return Date" name='actual_return_date' required>
                                </div>
                            </div>
                            <div>
                                <label for="penalty" class="mt-2">Penalty</label>
                                <input type="number" id="penalty" class="form-control" id="penalty" aria-describedby="penalty" placeholder="0" value="" readonly>
                                <small class=" text-wrap text-muted">Late Return : {{$penalty->amount}} / day</small>
                            </div>

                            {{-- <label for="category_name">Category Name</label>
                            <input type="category_name" class="form-control" id="category_name" aria-describedby="category_name" placeholder="Category Name" name='category_name' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" aria-describedby="description" placeholder="Description" name='description' required></textarea>
                          </div> --}}
                        <div class="d-flex justify-end mt-2">
                            {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                            <x-primary-button>{{ __('Return Item') }}</x-primary-button>
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
        document.getElementById("actual_return_date").addEventListener("change", function() {
            var actual_return_date = document.getElementById("actual_return_date").value;
            var return_date = document.getElementById("return_date").value;

            //hitung selisih hari
            var date1 = new Date(actual_return_date);
            var date2 = new Date(return_date);
            var diffTime = Math.abs(date2 - date1);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            document.getElementById("penalty").value =diffDays * {{$penalty->amount}};

            //tampilkan penalty
            var penalty = document.getElementById("penalty").value;
            document.getElementById("penalty").value = penalty;

        })
    </script>
</x-app-layout>
