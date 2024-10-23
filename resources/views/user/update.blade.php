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
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="form-group mt-2">
                                <label for="name">Full Name</label>
                              <input type="text" value="{{$user->name}}" class="form-control" placeholder="John" name="name" required>
                            </div>
                          <div class="form-group mt-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" id="email" aria-describedby="email" placeholder="Email" name='email' disabled>
                          </div>
                          <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Anggota" {{ $user->role == 'Anggota' ? 'selected' : '' }}>Anggota</option>
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
                          <div class="row justify-end">

                              <div class="d-flex justify-end mt-2 ml-2">
                                  {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                                  <x-primary-button>{{ __('Update User') }}</x-primary-button>
                                </div>
                                <div class="d-flex justify-end mt-2 ml-2">
                                    {{-- <button type="submit" class="btn btn-primary mb-2">Add User</button> --}}
                                    <x-secondary-button>
                                        <a href="{{ route('users.index') }}">CANCEL</a>
                                    </x-secondary-button>
                                    </div>
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
