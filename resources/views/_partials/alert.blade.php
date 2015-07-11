@if (session()->has('successMessage'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>
            <span class="glyphicon glyphicon-ok"></span> 
            {{ session()->get('successMessage') }}
        </p>
    </div>
@elseif (session()->has('errorMessage'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>
            <span class="glyphicon glyphicon-remove"></span> 
            {{ session()->get('errorMessage') }}
        </p>
    </div>
@endif