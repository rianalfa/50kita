<div class="flex flex-row">
    <div class="pr-4 text-xl font-bold text-gray-700 select-none">
        {{ $question->number }}
    </div>
    <div class="w-full">
        <div class="flex justify-between">
            <div>
                @switch($question->type)
                    @case(TestQuestionConstant::TYPE_KEPRIBADIAN)
                        <x-badge.success text="{{ TestQuestionConstant::TYPE_KEPRIBADIAN }}" />
                        <span class="text-xs">{{ $question->sub_type }}</span>
                    @break
                    @case(TestQuestionConstant::TYPE_MINAT)
                        <x-badge.primary text="{{ TestQuestionConstant::TYPE_MINAT }}" />
                        <span class="text-xs">{{ $question->sub_type }}</span>
                    @break
                    @default
                        <x-badge.error text="{{ $question->type }}" />
                @endswitch

            </div>
            <div class="flex items-start">
                <x-button.error
                    onclick="Livewire.emit('openModal', 'tests.questions.modal-delete', {{ json_encode(['test_question_id' => $question->id]) }})">
                    <x-icons.trash class="w-4 h-4" />
                </x-button.error>
                <x-button.white class="ml-2"
                    onclick="Livewire.emit('openModal', 'tests.questions.modal-update', {{ json_encode(['test_id' => $question->test_id, 'question_id' => $question->id]) }})">
                    <x-icons.settings class="w-4 h-4" />
                </x-button.white>
                <x-button.success class="ml-2"
                    onclick="Livewire.emit('openModal', 'tests.options.modal-update', {{ json_encode(['question_id' => $question->id]) }})">
                    <x-icons.plus class="w-4 h-4" />
                </x-button.success>
            </div>
        </div>
        <div class="mt-2">
            <div class="prose">
                <div class="whitespace-pre-line">{{ $question->question_text }}</div>
                @if ($question->question_image)
                    <div class="mb-4">
                        <img src="{{ Storage::disk('public')->url($question->question_image) }}"
                            alt="{{ $question->question_image }}">
                    </div>
                @endif
            </div>
        </div>
        <ol class="list-disc ml-4">
            @foreach ($question->options as $option)
                <li class="mb-4">
                    <div class="mt-2 max-w-xl flex justify-between">
                        <div>
                            @if ($option->point >= 1)
                                <x-badge.error text="Poin : {{ $option->point }}" />
                            @else
                                <x-badge.secondary text="Poin : {{ $option->point }}" />
                            @endif
                        </div>
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex p-1 text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <x-icons.more-vertical width="20" height="20" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-jet-dropdown-link class="cursor-pointer"
                                    onclick="Livewire.emit('openModal', 'tests.options.modal-update', {{ json_encode(['question_id' => $question->id, 'option_id' => $option->id]) }})">
                                    {{ __('Edit') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link class="cursor-pointer"
                                    onclick="Livewire.emit('openModal', 'tests.options.modal-delete', {{ json_encode(['option_id' => $option->id]) }})">
                                    {{ __('Delete') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    <div class="whitespace-pre-line text-sm">{{ $option->option_text }}</div>
                    @if ($option->option_image)
                        <div class="max-w-xl mb-4">
                            <img class="object-cover"
                                src="{{ Storage::disk('public')->url($option->option_image) }}"
                                alt="{{ $option->option_image }}">
                        </div>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</div>
