<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <!-- <img src="img/logo.png"> -->
        <img src="{{ asset('assets/img/accura-logo.png') }}">
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span data-localize="dashboard">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('agents.index') }}" data-toggle="collapse" data-target="#collapseAgents" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users-cog"></i>
                <span data-localize="agents">Agents</span>
            </a>
            <div id="collapseAgents" class="collapse" aria-labelledby="collapseAgents" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header" data-localize="agents">Agents</h6>
                    <a class="collapse-item" href="{{ route('agents.index') }}" data-localize="list_agents">List Agents</a>
                    <a class="collapse-item" href="{{ route('agents.create') }}" data-localize="add_agent">Add New Agent</a>
                </div>
            </div>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('visitors.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span data-localize="visitors">Visitors</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('rooms.index') }}" data-toggle="collapse" data-target="#collapseRooms" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-video"></i>
            <span data-localize="rooms">Rooms</span>
        </a>
        <div id="collapseRooms" class="collapse" aria-labelledby="collapseRooms" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header" data-localize="rooms">Rooms</h6>
                <a class="collapse-item" href="{{ route('rooms.index') }}" data-localize="list_rooms">List Rooms</a>
                <a class="collapse-item" href="{{ route('rooms.create') }}" data-localize="room_management">Room Management</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('chats.index') }}">
            <i class="fas fa-fw fa-comment-dots"></i>
            <span data-localize="chat_history">Chat History</span></a>
    </li>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('users.index') }}" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span data-localize="users">Users</span>
            </a>
            <div id="collapseUsers" class="collapse" aria-labelledby="collapseUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header" data-localize="users">Users</h6>
                    <a class="collapse-item" href="{{ route('users.index') }}" data-localize="list_users">List Users</a>
                    <a class="collapse-item" href="{{ route('users.create') }}" data-localize="add_user">Add New User</a>
                </div>
            </div>
        </li>
    @endif
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('question-answers.index') }}">
                <i class="fas fa-fw fa-question"></i>
                <span data-localize="question-answers">Question Answers</span>
            </a>
        </li>
    @endif
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->tenant == 'lsv_mastertenant')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('recordings.index') }}">
                <i class="fas fa-fw fa-compact-disc"></i>
                <span data-localize="recordings">Recordings</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('configs.index') }}">
                <i class="fas fa-fw fa-cogs"></i>
                <span data-localize="configurations">Configurations</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('locale.index') }}">
                <i class="fas fa-fw fa-globe"></i>
                <span data-localize="locales">Locales</span></a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('videoLogs.index') }}">
            <i class="fas fa-fw fa-play-circle"></i>
            <span data-localize="videologs">Video session logs</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
