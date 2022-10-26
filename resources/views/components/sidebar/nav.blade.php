<x-sidebar-layout>
    <x-sidebar.item menu="Dashboard" icon="house-user" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" />
    <x-sidebar.item menu="Help Desk" icon="hand-holding-medical" href="{{ route('helpdesk.main') }}" :active="request()->routeIs('helpdesk.main')" />
</x-sidebar-layout>
