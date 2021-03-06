@if($passwords->count() == 0)
<p class="bg-warning">Not result found</p>
@else
<table class="table table-hover">
	<thead>
	<tr>
		<th>Title</th>
		<th>Username</th>
		<th class="text-center">Password</th>
		<th>URL</th>
		<th class="text-center">Actions</th>
	</tr>
	</thead>
	<tbody>
	@foreach($passwords as $password)
		<tr>
			<td><a href="{{ $password->url }}" target="_blank">{{ $password->title }}</a></td>
			<td>{{ $password->username }}&nbsp;<a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->username }}"><i class="fa fa-clipboard"></i></a></td>
			<td class="text-center"><a href="#" class="btn btn-xs btn-default btn-clipboard" data-clipboard-text="{{ $password->password }}" data-toggle="popover"><i class="fa fa-clipboard"></i></a></td>
			<td><a href="{{ $password->url }}" target="_blank">{{ $password->url }}</a></td>
			<td class="text-center">
				@can("update", $password)
					<a href="{{ route('password.edit', ['id'=>$password->id]) }}" class="btn btn-xs btn-default" title="Edit"><i class="fa fa-pencil"></i></a>
				@endcan
				<a href="{{ route('password.show', ['id'=>$password->id]) }}" class="btn btn-xs btn-info" title="View"><i class="fa fa-eye"></i></a>
				@can("destroy", $password)
					<a href="{{ route('password.destroy', ["id" => $password->id]) }}" class="btn btn-xs btn-danger"  data-method="DELETE" data-confirm="Are you sure ?" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
				@endcan
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
