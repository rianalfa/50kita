<div class="bg-white shadow-sm flex-1 border border-gray-100 rounded-sm text-gray-700">
    <div class="p-3 flex">
        <div class="w-full mx-0 mr-2 md:mx-2 md:mr-0">
            <div class="flex justify-between items-center">
                <time class="ml-2 mt-1 text-base font-bold text-gray-600">
                    {{ $consultation->date->format('d M Y, H:i') }}
                </time>

                @empty(!$consultation->product)
                    @if ($consultation->status == ConsultationsConstant::STATUS_ACCEPTED)
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex p-1 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <x-icons.more-vertical width="20" height="20" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-jet-dropdown-link class="cursor-pointer"
                                    href="{{ route('payments.checkout', $consultation->product_id) }}">
                                    {{ __('Bayar') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    @endif
                @endempty
            </div>
            <div class="whitespace-nowrap select-none my-2">
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
            <div class="mt-4 ml-2 pb-2 text-sm font-normal text-gray-500">
                {{ $consultation->message }} -
                <span class="italic">last update {{ $consultation->updated_at }}</span>
            </div>

        </div>
    </div>
</div>
