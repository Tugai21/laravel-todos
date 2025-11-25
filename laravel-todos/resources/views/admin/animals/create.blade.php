<x-app-layout>
    <x-slot name="header">
        ➕ Create Animal
    </x-slot>

    <div class="max-w-xl mx-auto p-6">

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.animals.store') }}">
            @csrf

            <label class="block font-semibold">Name</label>
            <input name="name" class="border p-2 w-full mb-3" value="{{ old('name') }}">

            <label class="block font-semibold">Species</label>
            <select name="species" class="border p-2 w-full mb-3">
                @foreach(['dog','cat','bird','horse','fish','other'] as $s)
                    <option value="{{ $s }}" @selected(old('species')===$s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>

            <label class="block font-semibold">Age</label>
            <input type="number" name="age" class="border p-2 w-full mb-3" value="{{ old('age') }}">

            <label class="block font-semibold">Description</label>
            <textarea name="description" class="border p-2 w-full mb-3">{{ old('description') }}</textarea>

            <label class="block font-semibold">Main Photo</label>
            <select name="photo_id" class="border p-2 w-full mb-4">
                <option value="">None</option>
                @foreach(App\Models\Photo::all() as $photo)
                    <option value="{{ $photo->id }}" @selected(old('photo_id')==$photo->id)>
                        {{ $photo->title ?? "Photo #{$photo->id}" }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">
                Create Animal
            </button>
        </form>
    </div>
</x-app-layout>