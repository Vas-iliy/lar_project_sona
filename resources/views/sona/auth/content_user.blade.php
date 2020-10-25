<section class="user">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <img style="width: 100%" src="{{asset(env('THEME'))}}/img/room/avatar/{{$user->image}}" alt="" class="user">
            </div>
            <div class="col-9">
                    <form action="{{route('users.update', ['user' => $user->name])}}" method="post" class="ra-form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="review-add">
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="name" value="{{$user->name}}">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="name_f" value="{{$user->fact->name}}">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="surname_f" value="{{$user->fact->surname}}">
                                </div>
                                <div class="col-12">
                                    <input type="text" name="email_f" value="{{$user->fact->email}}">
                                </div>
                                <div class="col-12">
                                    <input type="text" name="phone_f" value="{{$user->fact->phone}}">
                                    <input type="file" name="image">
                                    <button type="submit">Изменить</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="col-12">
                <h2>Comments</h2>
                @foreach($user->comments as $comment)
                    <div class="review-item">
                        <div class="ri-text">
                            <span>{{$comment->created_at->format('d M, Y')}}</span>
                            <p>{!! $comment->text !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
