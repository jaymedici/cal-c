@if (session()->has('errors2'))
     <div class="alert alert-dismissable alert-danger col-md-9 col-lg-9">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true"> &times; </span>
          </button>
       
    <strong>{!! session()->get('errors2') !!} </strong>

     </div>
@endif