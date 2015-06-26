@if (Session::has('successMessage') and ! Session::has('printMessage'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><span class="glyphicon glyphicon-ok"></span> {{ Session::get('successMessage') }}</p>
    </div>
@elseif (Session::has('successMessage') and Session::has('printMessage'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><span class="glyphicon glyphicon-ok"></span> {{ Session::get('successMessage') }}</p>
        <p>
            <a href="" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
        </p>
    </div>
@elseif (Session::has('errorMessage'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><span class="glyphicon glyphicon-remove"></span> {{ Session::get('errorMessage') }}</p>
    </div>
@elseif (Session::has('warningMessage'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><span class="glyphicon glyphicon-remove"></span> {{ Session::get('warningMessage') }}</p>
    </div>
@endif