<div
    class="grid place-items-center bg-blue-100 h-screen px-6 font-sans"
>
    <!-- navbar -->
    <div
        class="fixed top-0 left-0 text-center w-full header bg-violet-600 py-4 text-white font-bold text-lg shadow-lg"
    >
        Simple Todo Application with Livewire
    </div>

    <div class="w-full max-w-3xl shadow-lg rounded-lg p-6 bg-white">
        <!-- header -->
        <div>
            @include('inc.form')

            <ul class="flex justify-between my-4 text-xs text-gray-500">
                @if($count == 0 )
                    <li wire:click="inCompleteAll" class="flex space-x-1 cursor-pointer">
                        <span>Incomplete All Tasks</span>
                    </li>
                @else
                    <li wire:click="completeAll" class="flex space-x-1 cursor-pointer">
                        <img
                            class="w-4 h-4"
                            src="./images/double-tick.png"
                            alt="Complete"
                        />
                        <span>Complete All Tasks</span>
                    </li>
                @endif
                <li wire:click="clearAllCompleted" class="cursor-pointer">Clear completed</li>
            </ul>
        </div>
        <hr class="mt-4" />

        <!-- todo list -->
        @include('inc.todo-list')

        <hr class="mt-4" />

        <!-- footer -->
        <div class="mt-4 flex justify-between text-xs text-gray-500">
            <p>{{ $count }} tasks left</p>
            <ul class="flex space-x-1 items-center text-xs">
                <li wire:click="$set('filterType', 'all')" class="cursor-pointer {{ $filterType == 'all' ? 'font-bold' : '' }}">All</li>
                <li>|</li>
                <li wire:click="$set('filterType', 0)" class="cursor-pointer {{ $filterType == 0 ? 'font-bold' : '' }}">Incomplete</li>
                <li>|</li>
                <li wire:click="$set('filterType', 1)" class="cursor-pointer {{ $filterType == 1 ? 'font-bold' : '' }}">Complete</li>
                <li></li>
                <li></li>
                <li
                    wire:click="toggleColorFilter('green')"
                    class="h-3 w-3 border-2 border-green-500 md:hover:bg-green-500 rounded-full cursor-pointer {{$filterColor == 'green' ? 'bg-green-500' : ''}}"
                ></li>
                <li
                    wire:click="toggleColorFilter('red')"
                    class="h-3 w-3 border-2 border-red-500 md:hover:bg-red-500 rounded-full cursor-pointer {{$filterColor == 'red' ? 'bg-red-500' : ''}}"
                ></li>
                <li
                    wire:click="toggleColorFilter('yellow')"
                    class="h-3 w-3 border-2 border-yellow-500 md:hover:bg-yellow-500 rounded-full cursor-pointer {{$filterColor == 'yellow' ? 'bg-yellow-500' : ''}}"
                ></li>
            </ul>
        </div>
    </div>
</div>
