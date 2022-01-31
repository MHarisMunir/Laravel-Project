<x-admin-master>

@section('content')

@if(!auth()->user()->userHasRole('Admin'))
<h1 class="h3 mb-4 text-gray-800">DashBoard</h1>
@endif


<!-- @foreach(auth()->user()->roles as $role)
{{$role->name}}
@endforeach -->
<!-- echo $role_name;
echo auth()->user()->roles()->name; -->

@endsection


</x-admin-master>