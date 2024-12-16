<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Configuration Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Current App Indicator -->
                <div class="mb-6 p-4 rounded-md text-white"
                    style="background-color: {{ $configurations['theme_color'] ?? 'gray' }};">
                    <h3 class="text-lg font-semibold">Current Application: {{ $app_name }}</h3>
                </div>

                <!-- Display All Configurations -->
                <h3 class="text-lg font-semibold mb-4 text-white">Current Configurations</h3>
                <table
                    class="table-auto border-collapse border border-gray-300 w-full text-gray-700 dark:text-gray-300 mb-6">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Key</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($configurations as $key => $value)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $key }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Form to Update Configuration -->
                <form action="{{ route('config.update') }}" method="POST" class="space-y-6 mt-6">
                    @csrf
                    <div>
                        <label for="key" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Select Configuration Key
                        </label>
                        <select id="key" name="key"
                            class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($configurations as $key => $value)
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="value" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            New Value
                        </label>
                        <input type="text" id="value" name="value" required
                            class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 dark:hover:bg-indigo-400 focus:outline-none focus:border-indigo-700 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-500 active:bg-indigo-700 dark:active:bg-indigo-600 disabled:opacity-25 transition ease-in-out duration-150">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
