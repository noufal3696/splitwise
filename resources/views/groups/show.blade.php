<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{--            Welcome,  <b>{{ \Illuminate\Support\Facades\Auth::user()->name }}</b>--}}
            <br>
            Group Name: <b>{{ $groupDTO->name }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Add a friend to group
                    </h2>
                    <br>
                    <form method="POST" action="{{ route('group.add-user', $groupDTO->id) }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="user">{{ __('Select User') }}</label>
                            <select class="input-group" id="user" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add User') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Your Friends in the group. They owe you ${{ $theyOweYou }}. You owe them ${{ max($youOweThem, 0) }}
                    </h2>
                    <br>
                    <table cellpadding="10" class="table table-bordered mb-5 full-width">
                        <thead>
                            <tr class="table-success">
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
{{--                                <th scope="col">Owes you</th>--}}
                                <th scope="col">Date</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groupUsers as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>{{ $data->user->name }}</td>
{{--                                <td>{{ $data->user->getExpenseDetails($groupDTO->id)['youOweThem'] }}</td>--}}
                                <td>{{ $data->created_at->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('group.destroy-user', [$data->group_id, $data->user_id]) }}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Pay
                    </h2>
                    <br>
                    <form method="POST" action="{{ route('group.add-expense', $groupDTO->id) }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-input-label for="amount" :value="__('Amount in $')" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required autofocus />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Pay') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Your Payments
                    </h2>
                    <br>
                    <table cellpadding="10" class="table table-bordered mb-5 full-width">
                        <thead>
                        <tr class="table-success">
                            <th scope="col">#</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupExpenses as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <td>${{ $data->amount }}</td>
                                <td>{{ $data->created_at->format('Y-m-d H:i') }}</td>
                                <td><a href="{{ route('group.destroy-expense', [$data->group_id, $data->id]) }}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
