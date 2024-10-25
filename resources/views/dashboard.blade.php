<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2 mb-2">
                <div class="p-6 text-gray-900 text-center">
                        <strong>Welcome {{Auth::user()->name}} !! Your Role is  {{Auth::user()->role}}</strong>
                </div>
            </div>
            <div class=" overflow-hidden shadow-sm sm:rounded-lg mt-2 mb-2">
                <div class="row">
                    <div class="col-sm-4  mt-2 mb-2">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title bold">Total Borrows</h5>
                          <p class="card-text">{{$borrows->count()}}</p>
                          <x-primary-button class="btn btn-primary mt-2" ><a href="{{route('borrow.index')}}">Go somewhere</a></x-primary-button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4  mt-2 mb-2">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title bold">Total Penalty</h5>
                          <p class="card-text">{{$totalPenalty}}</p>
                          <x-primary-button class="btn btn-primary mt-2">Go somewhere</x-primary-button>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4  mt-2 mb-2">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title bold">Borrows Waiting</h5>
                            <p class="card-text">{{$borrowsWaiting}}</p>
                            <x-primary-button class="btn btn-primary mt-2"><a href="{{route('borrow.index')}}">Go somewhere</x-primary-button>
                          </div>
                        </div>
                      </div>
                  </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2 mb-2">
                <div class="p-6 text-gray-900 text-center">
                    <div class=" bold mb-3">
                        <h2>Recent Borrows <a href="{{route('borrow.index')}}">View All</a></h2>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Time</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Borrow Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Penalty</th>
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
                            @else
                            @foreach ($borrows as $borrow)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $borrow->created_at->diffForHumans() }}</td>
                                    <td>{{ $borrow->unit->nama_unit }}</td>
                                    <td>{{ $borrow->qty }}</td>
                                    <td>{{ $borrow->borrow_date }}</td>
                                    <td>{{ $borrow->return_date }}</td>
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
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
