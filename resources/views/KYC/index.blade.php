<x-app-layout>
    <x-slot name="header">
        {{ __('KYC requests') }}
        <a href="{{ route('KYC.create') }}" class="bg-blue-500 text-white px-2">new request</a>

    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <x-auth-validation-errors :errors="$errors" />


        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">photo</th>
                            <th class="px-4 py-3">front</th>
                            <th class="px-4 py-3">back</th>
                            <th class="px-4 py-3">status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($data as $kyc)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                <img src="{{ asset($kyc->photo) }}" alt="">
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <img src="{{ asset($kyc->front) }}" alt="">
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <img src="{{ asset($kyc->back) }}" alt="">
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ \App\Constants\Status::status[$kyc->status] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{-- {{ $users->links() }} --}}
            </div>
        </div>

    </div>
</x-app-layout>