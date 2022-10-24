<x-card.base class="px-0 py-0 sm:p-0">
    <div class="p-3 flex">
        <div class="hidden md:flex">
            <div class="h-12 w-12 flex items-center justify-center bg-gray-200 text-gray-400 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
        </div>
        <div class="w-full mx-0 mr-2 md:mx-2 md:mr-0">
            <div class="flex justify-between items-center">
                <div class="block sm:flex items-center">
                    <time class="ml-2 mt-1 text-base font-bold text-gray-600">
                        {{ $consultation->date->format('d M Y, H:i') }}
                    </time>
                    <div class="sm:ml-2 whitespace-nowrap select-none">
                        @switch($consultation->status)
                            @case(ConsultationsConstant::STATUS_ACCEPTED)
                                <x-badge.success text="Diterima" />
                            @break
                            @case(ConsultationsConstant::STATUS_REJECTED)
                                <x-badge.error text="Ditolak" />
                            @break
                            @case(ConsultationsConstant::STATUS_FINISHED)
                                <x-badge.primary text="Selesai" />
                            @break
                            @case(ConsultationsConstant::STATUS_PAYMENT_ACCEPTED)
                                <x-badge.secondary text="Pembayaran Diterima" />
                            @break
                            @case(ConsultationsConstant::STATUS_WAITING_CONFIRMATION)
                                <x-badge.warning text="Menunggu Konfimasi" />
                            @break
                            @default
                                <x-badge.error text="No Status Found" />
                        @endswitch
                    </div>
                </div>
                @empty(!$consultation->product)
                    @if ($consultation->status == ConsultationsConstant::STATUS_ACCEPTED)
                        <div>
                            <x-anchor.black href="{{ route('payments.checkout', $consultation->product_id) }}">
                                bayar
                            </x-anchor.black>
                        </div>
                    @endif
                @endempty
            </div>
            <div class="my-2 ml-2 pb-2 text-sm font-normal text-gray-500 border-b border-gray-200">
                {{ $consultation->message }} -
                <span class="italic">last update {{ $consultation->updated_at }}</span>
            </div>

            <div class="ml-2">
                <div class="text-sm font-normal text-gray-500">
                    {{ $consultation->notes }}
                </div>
            </div>
        </div>
    </div>
</x-card.base>
