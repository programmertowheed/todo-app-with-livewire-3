<div
    class="mt-2 text-gray-700 text-sm max-h-[300px] overflow-y-auto"
>
    @forelse ($todos as $todo)
    <!-- todo -->
    <div
        class="flex justify-start items-center p-2 hover:bg-gray-100 hover:transition-all space-x-4 border-b border-gray-400/20 last:border-0"
    >
        <div
            wire:click="toggoleComplete({{$todo->id}})"
            class="rounded-full bg-white border-2 border-gray-400 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2 border-green-500 focus-within:border-green-500"
        >
            <input
                type="checkbox"
                class="opacity-0 absolute rounded-full"
            />

            <svg
                class="{{ $todo->completed == 0 ? 'hidden':'' }} fill-current w-3 h-3 text-green-500 pointer-events-none"
                viewBox="0 0 20 20"
            >
                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
            </svg>
        </div>

        @if($isEdit == $todo->id)
            <form
                wire:submit.prevent="updateTodo"
                class="select-none flex-1"
            >
                <input
                    type="text"
                    placeholder="Type your todo"
                    autofocus
                    class="w-full px-0 py-0 border-none outline-none bg-gray-200 text-black"
                    wire:model="editTodo"
                />
                @error('editTodo')
                    <p class="text-[#f11010] text-xs mt-1">{{ $message }}</p>
                @enderror
            </form>
        @else
            <div class="select-none flex-1 {{ $todo->completed == 1 ? 'line-through':'' }}">
                {{ $todo->name }}
            </div>
        @endif

        <div
            wire:click="updateColor({{$todo->id}}, 'green')"
            class="flex-shrink-0 h-4 w-4 rounded-full border-2 ml-auto cursor-pointer border-green-500 hover:bg-green-500 {{ $todo->color == 'green' ? 'bg-green-500':'' }}"
        ></div>

        <div
            wire:click="updateColor({{$todo->id}}, 'yellow')"
            class="flex-shrink-0 h-4 w-4 rounded-full border-2 ml-auto cursor-pointer border-yellow-500 hover:bg-yellow-500 {{ $todo->color == 'yellow' ? 'bg-yellow-500':'' }}"
        ></div>

        <div
            wire:click="updateColor({{$todo->id}}, 'red')"
            class="flex-shrink-0 h-4 w-4 rounded-full border-2 ml-auto cursor-pointer border-red-500 hover:bg-red-500 {{ $todo->color == 'red' ? 'bg-red-500':'' }}"
        ></div>

        <img
            wire:click="setEditng({{ $todo->id }}, '{{ $todo->name }}')"
            src="{{ asset('/images/edit.png') }}"
            class="flex-shrink-0 w-4 h-4 ml-2 cursor-pointer"
            alt="Edit"
        />
        <img
            wire:click="delete({{ $todo->id }})"
            src="{{ asset('/images/cancel.png') }}"
            class="flex-shrink-0 w-4 h-4 ml-2 cursor-pointer"
            alt="Cancel"
        />
    </div>
    @empty
        <div
            class="w-full flex justify-center items-center p-2 hover:bg-gray-100 hover:transition-all space-x-4 border-b border-gray-400/20 last:border-0"
        >
            <span>No task found!</span>
        </div>
    @endforelse
</div>
