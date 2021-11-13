<li class="side-menus {{ Request::is('dashboard*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class="fas fa-building"></i><span>Dashboard</span>
    </a>
</li>
<li class="dropdown">
    <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown">
        <i class="fas fa-users"></i>
        <span>Agents</span>
    </a>
    <ul class="dropdown-menu">
        <li class=" {{ Request::is('agents*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('agents.index') }}">
                <i class="fas fa-sitemap"></i><span>List Agents</span>
            </a>
        </li>
        <li class=" {{ Request::is('agents/create*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('agents.create') }}">
                <i class="fas fa-sitemap"></i><span>Add New Agent</span>
            </a>
        </li>
    </ul>
</li>
<li class="side-menus {{ Request::is('visitors*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('visitors.index') }}">
        <i class="fas fa-building"></i><span>Visitors</span>
    </a>
</li>
<li class="side-menus {{ Request::is('rooms*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('rooms.index') }}">
        <i class="fas fa-building"></i><span>Rooms</span>
    </a>
</li>

