@extends('layouts.dashboard')
@section('title', 'User Manage')

@section('content')
    @if(count($errors))
    <ul class="w3-ul">
        @foreach($errors->all() as $error)
            <li class="w3-text-red">{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="w3-container w3-teal">
        <h2>Create User<a href="{{ route('user.index') }}" class="w3-btn w3-round w3-indigo w3-large w3-margin-left"><i
                        class="fa fa-reply"></i></a></h2>
    </div>
    <form action="{{ route('user.store') }}"
          method="post"
          name="myForm"
          onsubmit="return validator()"
          class="w3-container w3-card-4 w3-padding-24">
        {{ csrf_field() }}

        <div class="w3-row-padding">
            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Name</label>
                <input name="name" class="w3-input w3-border" type="text" placeholder="Your name" value="{{ old('name') }}" required>
            </div>

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">E-mail<i id="checking" class="fa fa-spinner fa-pulse w3-text-teal w3-hide"></i></label>
                <input onblur="checkEmail()" name="email" class="w3-input w3-border" type="email" placeholder="Your email" value="{{ old('email') }}"required>
                <p id="emailHint" class="w3-text-red"></p>
                <p id="emailOK" class="w3-text-green"></p>
            </div>

            <div class="w3-margin-top w3-col m4">
                <span class="w3-text-gray">Role</span>
                <br>
                <input id="administrator" class="w3-radio" type="radio" name="role" value="1" required>
                <label class="w3-validate" for="administrator">Administrator</label>
                <input id="account" class="w3-radio" type="radio" name="role" value="0">
                <label class="w3-validate" for="account">Account</label>
            </div>
        </div>
        <div class="w3-row-padding">

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Password</label>
                <input name="password" class="w3-input w3-border" type="password" placeholder="password 6 chars" required>
                <p id="passwordHint" class="w3-text-red"></p>
            </div>

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Confirm</label>
                <input name="confirm" class="w3-input w3-border" type="password" placeholder="comfirm your password" required>
            </div>

            <div class="w3-margin-top w3-col m4">
                <p></p>
                <button class="w3-btn w3-padding w3-margin-top w3-teal w3-round" style="width:120px">Create &nbsp; ❯</button>
            </div>

        </div>
    </form>

    <script>
        function validator() {
            var password = document.myForm.password.value;
            var confirm = document.myForm.confirm.value;

            if (password != confirm) {
                document.getElementById('passwordHint').innerHTML = 'Password and Confirm must be the same';
            } else {
                return true;
            }

            return false;
        }

        function checkEmail() {
            var email = document.myForm.email.value;
            document.getElementById('checking').className = checking.className.replace("w3-hide", "w3-hide1");

            $.ajax({
                url: '{{ route('user.check') }}',
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': email
                },
                dataType: 'json',
                success: function (res) {
                    document.getElementById('emailHint').innerHTML = '';
                    document.getElementById('emailOK').innerHTML = '';
                    if (res.result != 'true') {
                        document.getElementById('emailHint').innerHTML = res.msg.email[0];
                    } else {
                        document.getElementById('emailOK').innerHTML = 'Email OK!';
                    }
                },
                complete: function () {
                    document.getElementById('checking').className = checking.className.replace("w3-hide1", "w3-hide");
                }
            });
        }
    </script>
@endsection