<head>
    <title>Get Github User's Repositories</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Get Github User's Repositories</h1>
            <!-- Way 1: Display All Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('repos') }}">

                {{ csrf_field() }}

                <div class="mb-3">
                    <label class="form-label" for="inputUsername">Username:</label>
                    <input
                        type="text"
                        name="username"
                        id="inputUsername"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Username">

                    <!-- Way 2: Display Error Message -->
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-3">
                    <button class="btn btn-success btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container">
    <h3>Repositories pulled</h3>
    <div class="row">
        @foreach($repos as $repo)
            <div class="col-md-6">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $repo['name'] }}</h5>
                        <p class="card-text">{{ $repo['description'] }}</p>
                        <p class="card-text">{{ $repo['owner'] }}</p>
                        <p class="card-text">{{ $repo['language'] }}</p>
                        <p class="card-text"><b>{{ $repo['updated'] }}</b></p>
                        <a href="{{ $repo['url'] }}" class="btn btn-primary">Go to Repo</a>
                    </div>
                </div>
            </div>
            @if ($loop->iteration % 2 == 0)
    </div>
    <div class="row">
        @endif
        @endforeach
    </div>

</div>

</body>
