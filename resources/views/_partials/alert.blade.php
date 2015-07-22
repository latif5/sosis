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
@elseif (session()->has('infoMessage'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>
            <span class="glyphicon glyphicon-remove"></span> 
            {{ session()->get('infoMessage') }}
        </p>
    </div>
@elseif (session()->has('warningMessage'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>
            <span class="glyphicon glyphicon-remove"></span> 
            {{ session()->get('warningMessage') }}
        </p>
    </div>
@elseif (session()->has('dangerMessage'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>
            <span class="glyphicon glyphicon-remove"></span> 
            {{ session()->get('dangerMessage') }}
        </p>
    </div>
@endif