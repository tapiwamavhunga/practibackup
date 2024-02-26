@extends('layouts.app')

   

@section('content')


   <div class="content-body">
          <div class="container-fluid-max">
            <div class="row">
              <div class="col-xl-12">
                <div class="page-title-content  mt-5">
                  <p>
                    You are loggedin as, 
                    <strong class="text-primary"> {{$user->name}}</strong>
                  </p>
                </div>
              </div>
            </div>
            
          </div>



@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
<div class="container-fluid-max">    
  <div class="col-xxl-12">
                    <div class="cards">
                        <div class="card-header">
                            <h4 class="card-title">Users </h4>
                            <div class="pull-right">
                <a class="btn btn-success btn-sm" href="/"> Export Users</a>
            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                               <div class="col-xxl-12">
                    <div class="cards">
                        <div class="card-header">
                            <h4 class="card-title">Client Users </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Can Access API </th>
                                            <th>View Analytics</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      @foreach($users as $user)
                                          <tr>
                                            <td data-th="ID"><span class="bt-content">{{$user->id}}</span></td>
                                            <td class="coin-name" data-th="Type"><span class="bt-content">
                                                
                                                <span>{{$user->name}}</span>
                                            </span></td>
                                            <td data-th="Amount"><span class="bt-content">
                                                {{$user->email}}
                                            </span></td>
                                            <td data-th="Fee"><span class="bt-content">
                                                {{$usersettings->company}} 
                                            </span></td>
                                            <td data-th="Date"><span class="bt-content">
                                                Yes
                                            </span></td>
                                            <td data-th="Hash"><span class="bt-content">
                                                View Analytics
                                            </span></td>
                                            

                                            <td data-th="Status">
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
   
                    <!-- <a href="{{ route('users.show',$user->id) }}">Show</a> -->
    
                    <a  href="{{ route('users.edit',$user->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>


                                        </tr>
                                      @endforeach
                                      
                                        
                                    </tbody>
                                </table>


                            </div>
                                                                                    {{ $users->links() }}


                        </div>

                    </div>
                </div>


                            </div>

                        </div>
                    </div>
                </div>
        </div>

</div>


@endsection