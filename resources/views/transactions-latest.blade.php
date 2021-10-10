<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white pb-1 shadow-sm sm:rounded-lg">
                <div class="m-2 pl-3 bg-white">
                    select users.*, recipient.name as recipient, transactions.transact_at, transactions.amount<br>
                    from `users`<br>
                    inner join `transactions` on `users`.`id` = `transactions`.`sender_id` and `transactions`.`status_id` = 2<br>
                    inner join `users` as `recipient` on `recipient`.`id` = `transactions`.`recipient_id`<br>
                    group by `users`.`id`<br>
                    having MAX(transactions.transact_at)
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white pb-1 shadow-sm sm:rounded-lg">
                <div class="m-2 pl-3 bg-white">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="text-left">Отправитель</th>
                            <th class="text-left">Получатель</th>
                            <th class="text-left">Сумма</th>
                            <th class="text-left">Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="w-4/12 p-2">
                                    {{$user->name}}
                                </td>
                                <td class="w-4/12 p-2">
                                    {{$user->recipient}}
                                </td>
                                <td class="w-2/12 p-2">
                                    {{$user->amount}}&nbsp;руб.
                                </td>
                                <td class="w-2/12 p-2">
                                    {{$user->transact_at}}
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
