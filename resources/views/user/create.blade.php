<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="firstname">First Name</label>
                              <input type="text" class="form-control" placeholder="John" name="firstname" required>
                            </div>
                            <div class="col">
                                <label for="lastname">Last Name</label>
                              <input type="text" class="form-control" placeholder="Doe" name="lastname" required>
                            </div>
                          </div>
                          <div class="form-group mt-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Email" name='email' required>
                          </div>
                          <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Anggota">Anggota</option>
                              </select>
                          </div>
                          <div class="form-row mt-2">
                            <div class="col">
                                <label for="password">Password</label>
                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="col">
                                <label for="confirm-password">Confirm Password</label>
                              <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password" required>
                            </div>
                          </div>
                        <div class="d-flex justify-end mt-2">
                            {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                            <x-primary-button>{{ __('Add User') }}</x-primary-button>
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
