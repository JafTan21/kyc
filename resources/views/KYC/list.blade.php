<x-app-layout>
    <x-slot name="header">
        {{ __('KYC requests') }}

    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">photo</th>
                            <th class="px-4 py-3">front</th>
                            <th class="px-4 py-3">back</th>
                            <th class="px-4 py-3">user email</th>
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
                                {{ $kyc->user->email }}
                            </td>
                            <td class="px-4 py-3 text-sm" x-data="{ show: true}">
                                {{ \App\Constants\Status::status[$kyc->status] }}

                                @if ($kyc->status==\App\Constants\Status::PENDING)
                                <form x-show="show" action="{{ route('KYC.update', $kyc->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="id" value="{{ $kyc->id }}">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" x-on:click="show=false"
                                        class="bg-green-500 text-white px-2 py-2">approve</button>
                                </form>

                                <form x-show="show" action="{{ route('KYC.update', $kyc->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $kyc->id }}">
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" x-on:click="show=false"
                                        class="bg-red-500 text-white px-2 py-2 mt-2 ">reject</button>
                                </form>
                                @endif


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