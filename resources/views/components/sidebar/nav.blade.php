<x-sidebar-layout>
    <x-sidebar.item menu="Help Desk" href="{{ route('helpdesk.main') }}" :active="request()->routeIs('helpdesk.main')" />
</x-sidebar-layout>
