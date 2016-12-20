@extends('layouts.dashboard')
@section('title', 'User List');

@section('content')
    <div class="w3-row">

        <div class="w3-container w3-col m6">
            <a href="{{ route('user.create') }}" class="w3-btn-floating w3-teal"
               style="position: relative;top: 19px;left: -20px;">+</a>
            <ul class="w3-ul w3-card-4">
                <li class="w3-orange"><h2>Administrator</h2></li>
                @if(isset($users[1]))
                    @foreach($users[1] as $user)
                        <li>
                            <span class="w3-badge w3-large w3-pale-red  w3-margin-right">{{ $user->id }}</span>
                            <span class="w3-xlarge  w3-margin-right w3-text-teal">{{ $user->name }}</span>
                            <span>{{ $user->email }}</span>
                            <div class="w3-btn-group w3-show-inline-block w3-right">
                                <a href="{{ route('user.show', $user) }}" class="w3-btn w3-round w3-blue">Info</a>
                                <a href="{{ route('user.edit', $user) }}" class="w3-btn w3-round w3-yellow">Edit</a>
                                <button class="w3-btn w3-round w3-red" onclick="openModal('{{ $user->id }}')">Delete
                                </button>
                            </div>
                        </li>
                        @include('user.destroy')
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="w3-container w3-col m6">
            <a href="{{ route('user.create') }}" class="w3-btn-floating w3-teal"
               style="position: relative;top: 19px;left: -20px;">+</a>
            <ul class="w3-ul w3-card-4">
                <li class="w3-blue"><h2>Account</h2></li>
                @if(isset($users[0]))
                    @foreach($users[0] as $user)
                        <li>
                            <span class="w3-badge w3-large w3-pale-green  w3-margin-right">{{ $user->id }}</span>
                            <span class="w3-xlarge  w3-margin-right w3-text-teal">{{ $user->name }}</span>
                            <span>{{ $user->email }}</span>
                            <div class="w3-btn-group w3-show-inline-block w3-right">
                                <a href="{{ route('user.show', $user) }}" class="w3-btn w3-round w3-blue">Info</a>
                                <a href="{{ route('user.edit', $user) }}" class="w3-btn w3-round w3-yellow">Edit</a>
                                <button class="w3-btn w3-round w3-red" onclick="openModal('{{ $user->id }}')">Delete
                                </button>
                            </div>
                        </li>
                        @include('user.destroy')
                    @endforeach
                @endif
            </ul>
        </div>

    </div>

    <script>
        function openModal(id) {
            var modal_id = 'delete_' + id;
            document.getElementById(modal_id).style.display = 'block'
        }
    </script>
@endsection