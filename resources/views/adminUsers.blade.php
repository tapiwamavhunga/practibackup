@extends('layouts.app')


<style>
    .bt-content {
  font-size: 14px !important;
}
.btn.btn-info {
  padding: 9px !important;
}

.table tr td {
  font-weight: 400 !important;
}

.table tr td, .table tr th {
  border-bottom: 1px solid #eff2f7;
  vertical-align: middle;
  padding: 18px;
  font-size: 13px;
}


</style>
@section('content')


   <div class="content-bodyf43rfg">
          <div class="container-fluid-max">

          <div class="col-xxl-12">
                    <div class="cards">
                        

             


            <div class="card-header mb-5">
              <h4 class="card-title">Manage Users</h4>
              
                            <a class="btn btn-success btn-sm" href="/users/export/">Export Users</a>

            </div>


                       <div class="card-header">

                 <form action="{{ route('admin.users', []) }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control me-2" name="search" placeholder="Search Users..." value="{{ request()->search }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>



                        <div class="card-body">
                            <div class="table-responsivex">
                         <div class="col-xxl-12">
                    <div class="cards">
                      
                            <div class="table-responsive">
                                <table class="table table-striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                       
                                            <th>Is Verified </th>
                                            <th>Is Admin </th>
                                            <th>Date Created </th>
                                            <th>Last Loggedin </th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                      @foreach($users as $user)
                                          <tr>
                                            <td data-th="ID">
                                                <span class="bt-content">{{$user->id}}</span>

                                            </td>




                                            </td>
                                            <td class="coin-name" data-th="Type"><span class="bt-content">
                                                
                                                <span>{{$user->name}}</span>

                                            </span>

                                        </td>
                                            <td data-th="Amount"><span class="bt-content">
                                                {{$user->email}}
                                            </span></td>
                                            <td data-th="Fee"><span class="bt-content">
                                                
                                                <?php if (!empty($user->company)) {
                                                   echo $user->company;
                                                }else{
                                                    echo "Medinformer";
                                                }?>

                                            </span></td>
                                            



                                            <td data-th="Hash"><span class="bt-content">
                                                <?php if ($user->is_verified == 1) {
                                                   echo "Yes";
                                                }else{
                                                    echo "No";
                                                }?>
                                            </span></td>

                                          <td data-th="Hash"><span class="bt-content">
                                                <?php if ($user->is_admin == 1) {
                                                   echo "Yes";
                                                }else{
                                                    echo "No";
                                                }?>
                                            </span></td>



                                            <td data-th="Date"><span class="bt-content">
                                                {{$user->created_at}}
                                            </span></td>

                                                  <td data-th="Hash"><span class="bt-content">
                                                {{$user->last_login_at}}
                                            </span></td>
                                            
                                            <td>
                                          <span class="bt-content">  <a href="{{ route('user.brochures', $user->id) }}" class="btn btn btn-primary btn-sm">Brochures</a></span>
</td>


                                            <td data-th="Status" class="nyt-t">
                                                <br>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
   
                    <!-- <a  href="{{ route('users.show',$user->id) }}">Show</a> -->
    
                    <a class="btn btn-primary btn btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
                    
                    <button class="btn btn-danger btn btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
    {{ __('Delete') }}
</button>


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

@endsection


