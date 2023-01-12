<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a class="header" href="{{ route('group.create') }}">{{ __('Create') }}</a>

                    <table cellpadding="10" class="table table-bordered mb-5 full-width">
                        <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Identifier</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->identifier }}</td>
                                <td>{{ $data->created_at->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('group.edit', $data->id) }}">Edit</a>
                                    | <a href="{{ route('group.show', $data->id) }}">View</a>
                                    | <a href="{{ route('group.destroy', $data->id) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
