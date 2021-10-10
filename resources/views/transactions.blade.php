<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors class="mb-8"/>
            <div class="bg-white pb-1 shadow-sm sm:rounded-lg">
                <fieldset class="m-2 pl-3 bg-white border border-gray-200 rounded">
                    <legend class="pl-3 pr-3 text-2xl text-gray-700">Новый перевод</legend>
                    <form method="POST" class="m-2 pl-1 pr-1">
                        @csrf
                        <div class="flex flex-row w-full justify-between">
                            <div class="w-1/4">
                                <x-label for="recipient_id" value="{{__('Recipient User')}}" />
                                <select name="recipient_id" id="recipient_id" class="mt-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'">
                                    <option value="">Выберите пользователя</option>
                                    @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/8 ml-2">
                                <x-label for="amount" value="{{__('Transaction Amount')}}" />
                                <x-input class="mt-2 w-full" name="amount" id="amount" type="number" min="0" step="1"/>
                            </div>
                            <x-datepicker name="transaction_date" class="w-1/8 ml-2"/>
                            <x-timepicker name="transaction_time" class="w-1/8 ml-2" />
                            <x-button class="h-1/2">
                                {{ __('Create Transaction') }}
                            </x-button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white pb-1 shadow-sm sm:rounded-lg">
                <div class="m-2 pl-3 bg-white">
                    <table>
                        <thead>
                        <tr>
                            <th class="text-left">Получатель</th>
                            <th class="text-left">Сумма</th>
                            <th class="text-left">Дата</th>
                            <th class="text-left">Статус</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="w-3/12 p-2">
                                    {{$transaction->recipient->name}}
                                </td>
                                <td class="w-2/12 p-2">
                                    {{$transaction->amount}}&nbsp;руб.
                                </td>
                                <td class="w-3/12 p-2">
                                    {{$transaction->transact_at}}
                                </td>
                                <td class="w-1/12 p-2">
                                    {{__('transactions.statuses.'.$transaction->status->alias)}}
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
