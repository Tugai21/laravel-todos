<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 My Todo List
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('todos.store') }}" class="flex mb-4">
                    @csrf
                    <input name="title" placeholder="New task..."
                           class="flex-grow border rounded-l px-3 py-2 focus:outline-none" />
                    <button class="bg-blue-500 text-white px-4 rounded-r">Add</button>
                </form>

                <ul>
                    @foreach($todos as $todo)
                        <li class="flex justify-between items-center mb-2 {{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                            <form method="POST" action="{{ route('todos.update', $todo) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-left" title="Toggle complete">
                                    {{ $todo->title }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">✖</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>