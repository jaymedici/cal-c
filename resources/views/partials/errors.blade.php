@if (isset($errors) && count($errors) > 0)
     <div class="alert alert-dismissable alert-danger col-md-12 col-lg-12">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true"> &times; </span>
          </button>
     @foreach ($errors->all() as $error)
     <li><strong>{!! $error !!} </strong></li>
     @endforeach
     </div>
@endif

@if(Session::has('error_message'))
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('error_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
 @endif