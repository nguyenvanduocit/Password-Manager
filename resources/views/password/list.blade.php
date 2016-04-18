@if($passwords->count() == 0)
<p class="bg-warning">Not result found</p>
@else
<table class="table table-hover">
	<thead>
	<tr>
		<th>URL</th>
		<th>Username</th>
		<th>Email</th>
		<th class="text-center">Password</th>
		<th class="text-center">Actions</th>
	</tr>
	</thead>
	<tbody>
	@foreach($passwords as $password)
	<tr>
		<td><a href="{{ $password->url }}" target="_blank">{{ $password->title }}</a></td>
		<td>{{ $password->username }}&nbsp;<a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->username }}"><i class="fa fa-clipboard"></i></a></td>
		<td>{{ $password->email }}&nbsp;<a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->email }}" data-toggle="popover"><i class="fa fa-clipboard"></i></a></td>
		<td class="text-center"><a href="#" class="btn btn-sm btn-default btn-clipboard" data-clipboard-text="{{ $password->password }}" data-toggle="popover"><i class="fa fa-clipboard"></i></a></td>
		<td class="text-center">
			<a href="{{ route('password.edit', ['id'=>$password->id]) }}" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-pencil"></i></a>
			<a href="{{ route('password.show', ['id'=>$password->id]) }}" class="btn btn-sm btn-info" title="View"><i class="fa fa-eye"></i></a>
			<a href="{{ route('password.destroy', ["id" => $password->id]) }}" class="btn btn-sm btn-danger"  data-method="DELETE" data-confirm="Are you sure ?" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
	@endforeach
	</tbody>
	<tfooter></tfooter>
</table>
@if(method_exists($passwords,'render'))
{!! $passwords->render() !!}
@endif
@endif
