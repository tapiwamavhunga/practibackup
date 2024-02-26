@extends('layouts.app')

   

@section('content')

 <div class="content-bodyccc" >
          <div class="container-fluid" >


          <div class="col-xxl-12">
                    <div class="cards">
                        <div class="card-header">
                            <h4 class="card-title mt-5">Companies </h4>
                        </div>
                        <div class="card-body mb-5">
                            <div class="table-responsive">
                                <table class="table table-striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Identity</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Private</th>
                                            <th>Redirect</th>
                                            <th>View Analytics</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      @foreach($companies as $company)
                                          <tr>
                                            <td data-th="ID"><span class="bt-content">{{$company->id}}</span></td>

                                            <td class="coin-name" data-th="Type"><span class="bt-content">
                                                
                                                <span><img src="{{$company->gallery}}" style="width: 100px;"></span>
                                            </span></td>


                                            <td class="coin-name" data-th="Type"><span class="bt-content">
                                                
                                                <span>{{$company->name}}</span>
                                            </span></td>
                                            <td data-th="Amount"><span class="bt-content">
                                               {{$company->email}}
                                            </span></td>
                                            <td data-th="Fee"><span class="bt-content">
                                                {{$company->contact}}
                                            </span></td>
                                            <td data-th="Date"><span class="bt-content">
                                                {{$company->private}}
                                            </span></td>
                                            <td data-th="Date"><span class="bt-content">
                                                {{$company->redirect}}
                                            </span></td>
                                            <td data-th="Hash"><span class="bt-content">
                                                <a href="/admin/client-analytics">View Analytics</a>
                                            </span></td>
                                            

                                            <td data-th="Status">
                <form action="{{ route('users.destroy',$company->id) }}" method="POST">
   
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
                                                                                    


                        </div>

                    </div>
                </div>
        </div>




@endsection