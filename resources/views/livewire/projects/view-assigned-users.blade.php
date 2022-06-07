<div>
    <div class="mb-3">
        @foreach ($assignedUsers as $user)
        <li class="list-inline-item text-center">
            <img src="{{ asset('img/user-avatar.png') }}" alt="Avatar" height="50">
            <br> {{ strtok($user->name, " ") }}
        </li>
        @endforeach
    </div>

    <div class="float-right"> {{ $assignedUsers->links() }} </div>
    
</div>
