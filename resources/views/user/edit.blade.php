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
        <h2>Edit {{ $user->name }}<a href="{{ route('user.index') }}" class="w3-btn w3-round w3-indigo w3-large w3-margin-left"><i
                        class="fa fa-reply"></i></a></h2>
    </div>
    <form action="{{ route('user.update', $user) }}"
          method="post"
          name="myForm"
          onsubmit="return validator()"
          class="w3-container w3-card-4 w3-padding-24">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="w3-row-padding">
            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Name</label>
                <p>{{ $user->name }}</p>
            </div>

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">E-mail<i id="checking" class="fa fa-spinner fa-pulse w3-text-teal w3-hide"></i></label>
                <p>{{ $user->email }}</p>
            </div>

            <div class="w3-margin-top w3-col m4">
                <span class="w3-text-gray">Role</span>
                <br>
                <select name="role" class="w3-select" value="{{ $user->group }}">
                    <option value="1" {{ $user->group == '1' ? 'selected' : '' }}>Administrator</option>
                    <option value="0" {{ $user->group == '0' ? 'selected' : '' }}>Account</option>
                </select>
            </div>
        </div>
        <div class="w3-row-padding">

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Password</label>
                <input name="password" class="w3-input w3-border" type="password" placeholder="password 6 chars">
                <p id="passwordHint" class="w3-text-red"></p>
            </div>

            <div class="w3-margin-top w3-col m4">
                <label class="w3-text-grey">Confirm</label>
                <input name="confirm" class="w3-input w3-border" type="password" placeholder="comfirm your password">
            </div>

            <div class="w3-margin-top w3-col m4">
                <p></p>
                <button class="w3-btn w3-padding w3-margin-top w3-teal w3-round" style="width:120px">Save &nbsp; ❯</button>
            </div>

        </div>
    </form>

    <script>
        function validator() {
            var password = document.myForm.password.value;
            var confirm = document.myForm.confirm.value;

            if(password == '' && confirm == '') {
                return true;
            }

            if (password != confirm) {
                document.getElementById('passwordHint').innerHTML = 'Password and Confirm must be the same';
            } else {
                return true;
            }

            return false;
        }
    </script>
@endsection