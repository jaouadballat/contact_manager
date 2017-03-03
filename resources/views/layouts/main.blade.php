<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Contact</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
    <link href="/assets/js/jquery-ui/jquery-ui.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- navbar -->
    
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand text-uppercase" href="#">            
            My contact
          </a>
        </div>
        <!-- /.navbar-header -->
         @if(Request::segment(2) == null)
      
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="nav navbar-right navbar-btn">
              <a href="{{route('contact.create')}}" class="btn btn-default">
                <i class="glyphicon glyphicon-plus"></i> 
                Add Contact
              </a>

            </div>
            <form class="navbar-form navbar-right" action="{{route('contact.index')}}">
            <div class="input-group">
              <input type="text"  class="form-control" placeholder="Search..."
               name="q" value="">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
            </div>
          </form>
          </div>


        @endif
      </div>
    </nav>

    <!-- content -->
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
         
            <a href="{{route('contact.index')}}" class="list-group-item {{Request::get('group_id') == null?'active': ''}}" >All Contact <span class="badge">{{\App\Contact::all()->count()}}</span></a>
            @foreach(\App\Group::all() as $group)
              <a href="{{route('contact.index',  ['group_id' => $group->id])}}" class="list-group-item {{Request::get('group_id') == $group->id ?'active':''}}">{{$group->name}}<span class="badge">{{$group->contacts->count()}}</span></a>

            @endforeach
          </div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-9">
        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
         @yield('content')
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script>
      $(function()
      {
         $( "input[name=q]" ).autocomplete({

          source: "{{route('contact.autocomplete')}}",
          minLength: 3,
          select: function(event, ui) {
            //event.preventDefault();
            $(this).val(ui.item.value);

            
          }
        });
      });
      
    
    
    </script>
    @yield('script-form')
  </body>
</html>