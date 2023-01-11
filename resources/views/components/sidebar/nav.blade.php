<x-sidebar-layout>
    <x-sidebar.item menu="Dashboard" icon="house-user" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />
    <x-sidebar.item menu="Daftar Pegawai" icon="user" href="{{ route('users') }}" :active="request()->routeIs('users')" />
    <x-sidebar.item menu="Daftar Tim" icon="people-group" href="{{ route('teams.main') }}" :active="request()->routeIs('teams.*')" />
    <x-sidebar.item menu="Tugas Saya" icon="rectangle-list" href="{{ route('tasks') }}" :active="request()->routeIs('tasks')" />
    <x-sidebar.item menu="Help Desk" icon="hand-holding-medical" href="{{ route('helpdesk.main') }}" :active="request()->routeIs('helpdesk.*')" />
</x-sidebar-layout>
