<section class="register">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Зарегестрироваться</h2>
            </div>
            <div class="card-body">
                <form action="{{route('registerUser')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail4">Name</label>
                        <input type="text" name="name" class="form-control" id="inputEmail4" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail4" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword4">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">Password Confirm</label>
                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" id="inputPassword4">
                    </div>
                    <button type="submit" class="btn btn-primary">Присоединиться</button>
                </form>
            </div>
        </div>
    </div>
</section>
