<x-app-layout>
    <x-slot name="header">
        {{ __('KYC Verification') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <x-auth-validation-errors :errors="$errors" />

        <form action="{{ route('KYC.store') }}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <p>Photo:</p>
                <input name="photo" type="file" accept="image/png, image/jpeg, image/jpg">
            </div>
            <div class="mt-3">
                <p>Front ID:</p>
                <input name="front" type="file" accept="image/png, image/jpeg, image/jpg">
            </div>
            <div class="mt-3 ">
                <p>Back ID:</p>
                <input name="back" type="file" accept="image/png, image/jpeg, image/jpg">
            </div>
            <div style="margin-top: 10px;">
                <button class="bg-green-500 text-white px-4 py-2">Submit</button>

            </div>
        </form>
    </div>
</x-app-layout>