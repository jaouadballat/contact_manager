 @extends('layouts.main')

 @section('content')
 <div class="panel panel-default">
    <table class="table">
    @foreach($contacts as $contact)
      <tr>
        <td class="middle">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="{{!is_null($contact->photo) ? '/uploads/'.$contact->photo : 'http://placehold.it/100x100'}}" style="height: 100px; width: 100px;">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading">{{$contact->name}}</h4>
              <address>
                <strong>{{$contact->company}}</strong><br>
                {{$contact->email}}
              </address>
            </div>
          </div>
        </td>
        <td width="100" class="middle">
          <form method="POST" action="{{route('contact.destroy', ['id' => $contact->id])}}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href="{{route('contact.edit', ['id' => $contact->id])}}" class="btn btn-circle btn-default btn-xs" title="Edit">
              <i class="glyphicon glyphicon-edit"></i>
            </a>
            <button type="submit" class="btn btn-circle btn-danger btn-xs" title="Remove">
              <i class="glyphicon glyphicon-remove"></i>
            </button>
          </form>
        </td>
      </tr>

    @endforeach
    </table>            
  </div>
<div class="text-center"> {{ Request::get('group_id') ? $contacts->appends(['group_id' => $contact->group_id])->links() : $contacts->links() }}</div>
 
@endsection