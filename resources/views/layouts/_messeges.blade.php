@if(session('success'))
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong> Success! </strong> {{session('success')}}
        <button type='submit' class='close' data-dismise='alert' aria-label='close'>
            <span aria-hidden="true">&times</span>
        </button>
    </div>
@endif
