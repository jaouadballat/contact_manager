    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>Edit Contact</strong>
      </div>
      <div class="panel-body">
        <div class="form-horizontal">
          <div class="row">
            <div class="col-md-8">
            @if(count($errors))
              <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                </ul>
              </div>
            @endif
              <div class="form-group">
                <label for="name" class="control-label col-md-3">Name</label>
                <div class="col-md-8">
                  <input type="text" name="name" class="form-control" value="{{!empty($contact) ? $contact->name : ''}}">
                </div>
              </div>

              <div class="form-group">
                <label for="company" class="control-label col-md-3">Company</label>
                <div class="col-md-8">
                <input type="text" name="company" class="form-control" value="{{!empty($contact) ? $contact->company : ''}}">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="control-label col-md-3">Email</label>
                <div class="col-md-8">
                <input type="email" name="email" class="form-control" value="{{!empty($contact) ? $contact->email : ''}}">
                </div>
              </div>

              <div class="form-group">
                <label for="phone" class="control-label col-md-3">Mobile</label>
                <div class="col-md-8">
                <input type="text" name="phone" class="form-control" value="{{!empty($contact) ? $contact->phone : ''}}">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="control-label col-md-3">Address</label>
                <div class="col-md-8">
                  <textarea name="address" id="address" rows="3" class="form-control">{{!empty($contact) ? $contact->address : ''}}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="group" class="control-label col-md-3">Group</label>
                <div class="col-md-5">
                  <select name="group_id" id="group_id" class="form-control">
                    <option value="">Select Group</option>
                    @foreach(\App\Group::all() as $group)
                      <option value="{{$group->id}}" selected="{{(!empty($contact) && $contact->group_id == $group->id) ?'selected' : ''}}">{{$group->name}}</option>
                    @endforeach
                  </select>

                </div>
                <div class="col-md-3">
                  <a href="#" id="add-group-btn" class="btn btn-default btn-block">Add Group</a>
                </div>
              </div>
              <div class="form-group" id="add-new-group" style="display: none">
                <div class="col-md-offset-3 col-md-8">
                  <div class="input-group">
                  <input type="text"  class="form-control" id="new-group">
                    <span class="input-group-btn">
                      <a href="#" class="btn btn-default" id="add-new-btn">
                        <i class="glyphicon glyphicon-ok"></i>
                      </a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                  <img src="{{(!empty($contact->photo)) ? '/uploads/'.$contact->photo : 'http://placehold.it/150x140'}}" style="width: 150px; height: 140px;">
                </div>
                <!-- <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div> -->
                <div class="text-center">
                  <input type="file" name="photo" class="form-control"><!-- <span class="fileinput-exists">Change</span> -->
                <!--   <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-offset-3 col-md-6">
                <button type="submit" class="btn btn-primary">{{!empty($contact) ? 'Update' : 'Save'}}</button>
                <a href="{{route('contact.index')}}" class="btn btn-default">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @section('script-form')
    <script>
        $(function(){
        $('#add-new-group').hide();
        $("#add-group-btn").click(function(){
          $('#add-new-group').fadeToggle('slow');
          $('#new-group').focus();
        });

        $('#add-new-btn').click(function(){
           var inputGroup = $('.input-group');
           var newGroup = $('#new-group');
          $.ajax({
            url : "{{route('groups.store')}}",
            method: "post",
            data: {
              name: $('#new-group').val(),
              _token: "{{ csrf_token() }}",
            },
            success: function(group){
              inputGroup.removeClass('has-error');
              inputGroup.next().remove('.text-danger');

              $('select[name=group_id]')
  .append("<option value='"+group.id+"' selected=true>"+group.name+"</option>");

                console.log(group);


            },
            error : function(xhr){
              console.log(xhr);
              //console.log(xhr.responseJSON.name[0]);
              var error = xhr.responseJSON.name[0];
            
              if(error){
                
                inputGroup.next().remove('.text-danger');
                inputGroup
                .addClass('has-error')
                .after('<p class="text-danger">'+error+'</p>');

              }
            }
          });
        });


      });


    </script>
  @endsection