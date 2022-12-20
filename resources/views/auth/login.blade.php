<x-layouts.base title="Login page">
    <div class="login-form-container">

    <div class="form-signin w-100 m-auto">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-floating">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control  @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control  @error('email') is-invalid @enderror" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" value="1"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

        </form>
    </div>





    </div>
</x-layouts.base>
