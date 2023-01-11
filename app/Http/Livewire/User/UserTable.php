<?php

namespace App\Http\Livewire\User;

use App\Constants\Address;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Nomor HP", "phone_number")
                ->searchable(),
            Column::make("Alamat", "address")->format(
                fn($value, $row, Column $column) => view('livewire.user.column.user-list-address')->withValue($value)
            ),
            Column::make("Jabatan")->label(
                fn($row, Column $column) => view('livewire.user.column.user-list-role')->withRow($row)
            ),
            Column::make("Tim")->label(
                fn($row, Column $column) => view('livewire.user.column.user-list-team')->withRow($row)
            ),
            Column::make("Aksi")->label(
                fn($row, Column $column) => view('livewire.user.column.user-list-action')->withRow($row)
            )->hideIf(!auth()->user()->hasRole('admin')),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Jenis')
                ->options([
                    '' => 'Semua',
                    '1' => 'Pegawai',
                    '2' => 'Mitra',
                ])->filter(function(Builder $builder, string $value) {
                    if (!empty($value)) {
                        $builder->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->where('model_has_roles.role_id', $value);
                    }
                }),
            SelectFilter::make('Kecamatan')
                ->options(array_merge(['' => 'Semua'], Address::districts()))
                ->filter(function(Builder $builder, string $value) {
                    if (!empty($value)) {
                        $builder->where('address->district', $value);
                    }
                }),
            SelectFilter::make('Nagari')
                ->options(array_merge(['' => 'Semua'], Address::villages()))
                ->filter(function(Builder $builder, string $value) {
                    if (!empty($value)) {
                        $builder->where('address->village', $value);
                    }
                }),
            SelectFilter::make('Desa')
                ->options(array_merge(['' => 'Semua'], Address::subvillages()))
                ->filter(function(Builder $builder, string $value) {
                    if (!empty($value)) {
                        $builder->where('address->village', $value);
                    }
                }),
        ];
    }
}
