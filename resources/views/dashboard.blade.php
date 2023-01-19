<x-app-layout title="Dashboard">
    <x-card.base>
        <div class="text-2xl">
            Selamat Datang di 50Kita
        </div>

        <div class="mt-6 text-gray-500">
            50Kita adalah aplikasi berbasis web yang diharapkan dapat membantu pegawai BPS Kabupaten Lima Puluh Kota dalam urusan manajemen atau administrasi perkantoran yang ada di BPS Kabupaten Lima Puluh Kota.
        </div>
    </x-card.base>

    <x-card.base class="mt-4 lg:mt-8">
        <div class="text-2xl">
            Kalender Tugas
        </div>

        <div class="mt-6">
            <livewire:team.team-tasks-calendar teamId="" userId=""
                before-calendar-view="livewire/task/calendar-month-buttons" />
        </div>
    </x-card.base>
</x-app-layout>
