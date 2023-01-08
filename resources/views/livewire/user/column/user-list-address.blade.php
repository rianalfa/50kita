<div class="flex flex-col justify-start items-center">
    @if (!empty($value))
        <p>Kecamatan {{ $value->district ?? "" }}</p>
        <p>Nagari {{ $value->village ?? "" }}</p>
        <p>Jorong {{ $value->subvillage ?? "" }}</p>
    @endif
</div>
