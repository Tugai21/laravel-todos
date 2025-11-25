<x-app-layout>
    <x-slot name="header">
        🐾 Animals
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        <a href="{{ route('admin.animals.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
           ➕ Add Animal
        </a>

        <form method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search..."
                   value="{{ request('search') }}"
                   class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Search
            </button>
        </form>

        @php
            $direction = request('direction') === 'asc' ? 'desc' : 'asc';
        @endphp

        <table class="w-full border mb-4">
            <tr class="bg-gray-200">
                <th class="p-2 border">Photo</th>
                <th class="p-2 border">
                    <a href="?sort=name&direction={{ $direction }}">
                        Name
                        @if(request('sort')==='name')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">
                    <a href="?sort=species&direction={{ $direction }}">
                        Species
                        @if(request('sort')==='species')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">
                    <a href="?sort=age&direction={{ $direction }}">
                        Age
                        @if(request('sort')==='age')
                            {{ request('direction')==='asc'?'▲':'▼' }}
                        @endif
                    </a>
                </th>
                <th class="p-2 border">Actions</th>
            </tr>

            @forelse($animals as $animal)
                <tr>
                    <td class="p-2 border">
                        @if($animal->photo)
                            <img src="{{ asset('storage/' . $animal->photo->path) }}" class="w-12 h-12 rounded object-cover">
                        @else
                            —
                        @endif
                    </td>
                    <td class="p-2 border">{{ $animal->name }}</td>
                    <td class="p-2 border">{{ $animal->species }}</td>
                    <td class="p-2 border">{{ $animal->age }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('admin.animals.edit', $animal) }}" class="text-blue-600">Edit</a>

                        <form method="POST" action="{{ route('admin.animals.destroy', $animal) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">
                        No animals found.
                    </td>
                </tr>
            @endforelse
        </table>

        {{ $animals->links() }}

    </div>
</x-app-layout>