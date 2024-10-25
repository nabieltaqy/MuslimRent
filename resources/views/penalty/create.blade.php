<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Penalty') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('penalty.store') }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="penalty_name">Penalty Name</label>
                            <input type="text" class="form-control" id="penalty_name" aria-describedby="penalty_name" placeholder="Penalty Name" name='penalty_name' required>
                          </div>
                          <div class="form-group mt-2">
                            <label for="amount">Amount</label>
                            <input type="number" min="1" class="amount" id="amount" aria-describedby="amount" placeholder="Amount" name='amount' required>
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
