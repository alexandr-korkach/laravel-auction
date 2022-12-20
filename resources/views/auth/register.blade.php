<x-layouts.base title="Register page">
    <div class="login-form-container">

        <div class="form-signup w-100 m-auto">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <h1 class="h3 mb-3 fw-normal">Please sign-up</h1>
                <div class="form-floating">
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control first-input @error('name') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Your name</label>
                </div>

                <div class="form-floating">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control last-input @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Confirm password</label>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button class="w-100 btn btn-lg btn-primary " type="submit">Sign in</button>

            </form>
        </div>





    </div>
</x-layouts.base>
