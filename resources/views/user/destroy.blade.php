<div id="delete_{{ $user->id }}" class="w3-modal" style="z-index: 900;">
    <div class="w3-modal-content w3-animate-zoom w3-card-8">
        <header class="w3-container w3-pale-red">
            <span onclick="document.getElementById('delete_{{ $user->id }}').style.display='none'"  class="w3-closebtn"><i class="fa fa-close"></i></span>
            <h2><i class="fa fa-warning"></i>Warning</h2>
        </header>
        <div class="w3-container">
            <h3 class="w3-text-black">Are you sure to delete {{ $user->name }} ?</h3>
            <div class="w3-right">
                <form action="{{ route('user.destroy', $user) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button class="w3-btn w3-round-large w3-red"><i class='fa
                           fa-check'></i></button>
                    <a class="w3-btn w3-round-large w3-teal" onclick="document.getElementById('delete_{{ $user->id }}').style.display='none'"><i class="fa
                    fa-close"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>