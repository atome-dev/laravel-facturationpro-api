<div>
    <div>
        @if ($result ?? false)

            @if ($result['success'])
                <table class='table-auto border-separate border border-green-800'>
                    <tr class="bg-green-500">
                        <td>{{ __('Success!') }}</td>
                    </tr>
                </table>
            @endif

            @if (isSet($result['error']))
                <table class='table-auto border-separate border border-green-800'>
                    <tr class="bg-red-500">
                        <td>ERROR</td>
                        <td>{{ $result['error'] }}</td>
                    </tr>
                </table>
            @endif

            @if (isSet($result['response']))
                <table class='table-auto border-separate border border-green-800'>
                    @if (is_array($result['request']))
                        @foreach($result['response'] as $numRow => $row)
                            @if ($numRow == 0)
                                <tr class="bg-blue-200 font-bold">
                                    @if (is_array($row))
                                        @foreach($row as $column => $value)
                                            <td>{{ $column }}</td>
                                        @endforeach
                                    @else
                                        <td>{{ var_dump($row) }}</td>
                                    @endif
                                </tr>
                            @endif

                            @if (is_array($row))
                                <tr class="bg-blue-100">
                                    @foreach($row as $column => $value)
                                        <td>{{ var_dump($value) }}</td>
                                    @endforeach
                                </tr>
                            @else
                                {{ var_dump($row) }}
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td>{{ var_dump($result['request']) }}</td>
                        </tr>
                    @endif
                </table>
            @endif

            @if ($result['request'])
                <table class='table-auto border-separate border border-green-800'>
                    <tr class="bg-blue-200 font-bold">
                        <td>VERB</td>
                        <td>URL</td>
                        <td>PARAMETERS</td>
                    </tr>
                    <tr class="align-top bg-blue-100">
                        <td>{{ $result['request']['verb'] }}</td>
                        <td>{{ $result['request']['url'] }}</td>
                        <td><pre>{{ var_dump($result['request']['parameters']) }}</pre></td>
                    </tr>
                </table>
            @endif
        @endif
    </div>

    <form action="" wire:submit.prevent="callApi" class="bg-white shadow-lg rounded max-w-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">{{ __('Category:') }}</label>
            <select wire:model="category" name="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                <option value="">{{ __('Select a category') }}</option>
                @foreach($categories as $category => $className)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        @if (count($actions) > 0)
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="action">{{ __('Action:') }}</label>
            <select wire:model="action" name="action" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                <option value="">{{ __('Select an action') }}</option>
                @foreach($actions as $action => $data)
                    <option value="{{ $action }}">{{ $data['label'] }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <br>
        @if (is_array($parameters) && count($parameters) > 0)

            @foreach($parameters as $parameter => $value)
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="firm-id">{{ $parameter }}</label>
                <input type="text" wire:model="parameters.{{ $parameter }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="{{ $parameter }}">
            </div>
            @endforeach
        @endif

        @if ($orders && count($orders) > 0)
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="sort_by">{{ __('Order by:') }}</label>
                <div class="flex items-stretch">
                    <select wire:model="order" name="order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                        <option value="">{{ __('Select a field') }}</option>
                        @foreach($orders as $order)
                            <option value="{{ $order }}">{{ $order }}</option>
                        @endforeach
                    </select>
                    <select wire:model="sort" name="sort" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                        @foreach($sorts as $sort)
                            <option value="{{ $sort }}">{{ $sort }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        @if ($options && count($options) > 0)

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">{{ __('Options:') }}</label>
            </div>

            @foreach($options as $option => $value)
                {{ $option }} =
                @if (isSet($value['CHOICES']))
                    <select wire:model="options.{{ $option }}.VALUE" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                        <option value="">{{ __('Select an option') }}</option>
                        @foreach($value['CHOICES'] as $choice)
                            <option value="{{ $choice }}">{{ $choice }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" wire:model="options.{{ $option }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="">
                @endif

            @endforeach
        @endif

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">OK</button>
        </div>
    </form>

</div>
