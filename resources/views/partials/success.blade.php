@if (session()->has('success'))
     <div class="alert alert-dismissable alert-success col-md-12 col-lg-12">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true"> &times; </span>
          </button>
       
    <strong>{!! session()->get('success') !!} </strong>

     </div>
@endif