<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <x-card.base class="flex flex-col space-y-6 max-h-96 lg:max-h-[36rem] overflow-y-auto p-2 lg:p-4">
            <p class="text-2xl font-semibold text-left">Keterangan Variabel</p>
            <x-card.base title="Surat Tugas">
                <div class="flex flex-col space-y-4 text-sm">
                    @foreach (TemplatesConstant::mailStVariables() as $key => $value)
                        <div class="flex flex-col justify-start">
                            <p class="font-semibold">{{ '${'.$key.'}' }}</p>
                            <p>{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </x-card.base>
            <x-card.base title="Surat Perjalanan Dinas">
                <div class="flex flex-col space-y-4 text-sm">
                    @foreach (TemplatesConstant::mailSpdVariables() as $key => $value)
                        <div class="flex flex-col justify-start">
                            <p class="font-semibold">{{ '${'.$key.'}' }}</p>
                            <p>{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </x-card.base>
            <x-card.base title="Kwitansi">
                <div class="flex flex-col space-y-4 text-sm">
                    @foreach (TemplatesConstant::receiptVariables() as $key => $value)
                        <div class="flex flex-col justify-start">
                            <p class="font-semibold">{{ '${'.$key.'}' }}</p>
                            <p>{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </x-card.base>
        </x-card.base>
        <x-card.base>
            <p class="text-2xl font-semibold text-left">File Template</p>
            <div class="flex flex-col space-y-4 mt-8">
                @foreach ($templates as $key => $name)
                    <div class="flex items-center space-x-3">
                        <x-button.white class="flex-grow text-gray-800">{{ $name }}</x-button.white>

                        <!-- To download template file -->
                        <p class="text-3xl text-green-500 cursor-pointer hover:scale-110 transition-all duration-150 delay-100"
                            wire:click="downloadTemplate('{{ $key }}')">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </p>

                        <!-- To upload template file -->
                        <label for="{{ $key }}" x-on:livewire-upload-finish="$wire.uploadTemplate('{{ $key }}')">
                            <p class="text-3xl text-red-500 cursor-pointer hover:scale-110 transition-all duration-150 delay-100">
                                <i class="fa-solid fa-file-arrow-up"></i>
                            </p>
                            <input type="file" id="{{ $key }}" style="display:none"
                                wire:model="templateFiles.{{ $key }}">
                        </label>
                    </div>
                @endforeach
            </div>
        </x-card.base>
    </div>
</div>
