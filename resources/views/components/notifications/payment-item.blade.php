<div class="p-4 px-4 text-sm text-gray-500 ">
    <div class="flex items-center">
        <div class="w-full">
            @switch($payment->status)
                @case(PaymentConstant::STATUS_PENDING)
                    <x-badge.primary text="Pending" />
                @break
                @case(PaymentConstant::STATUS_ACCEPTED)
                    <x-badge.success text="Selesai" />
                @break
                @case(PaymentConstant::STATUS_FAILED)
                    <x-badge.error text="Ditolak" />
                @break
            @endswitch
            <span class="italic text-xs text-gray-500 my-1">
                {{ $payment->created_at->format('d M Y H:i') }} WIB
            </span>
        </div>
        <div class="flex-1">
            <x-anchor.black download href="{{ Storage::disk('public')->url($payment->link) }}">
                Bukti
            </x-anchor.black>
        </div>
    </div>
    <div class="mt-2">
        <div class="my-2 font-bold">
            {{ $payment->name }}
        </div>
        <div>
            {{ $payment->sender }} - {{ $payment->method }}
        </div>
    </div>
</div>
