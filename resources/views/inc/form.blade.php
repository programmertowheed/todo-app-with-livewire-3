<div>
    <form
        wire:submit.prevent="save"
        class="flex items-center bg-gray-100 px-4 py-4 rounded-md"
    >
        <img
            src="{{ asset('images/notes.png') }}"
            class="w-6 h-6"
            alt="Add todo"
        />
        <input
            wire:model="name"
            type="text"
            placeholder="Type your todo"
            class="w-full text-lg px-4 py-1 border-none outline-none bg-gray-100 text-gray-500"
        />

        <button
            style="background-image: url('{{asset('/images/plus.png')}}')"
            type="submit"
            class="appearance-none w-8 h-8 bg-no-repeat bg-contain"
        ></button>

    </form>
    @error('name')
        <p class="text-[#f11010] text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
