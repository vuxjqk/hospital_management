<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('examinations.update', $examination) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="symptoms">Triệu chứng</label>
                            <input type="text" name="symptoms" id="symptoms">
                        </div>
                        <div>
                            <label for="diagnosis">Chẩn đoán</label>
                            <input type="text" name="diagnosis" id="diagnosis">
                        </div>
                        <div>
                            <label for="note">Lưu ý</label>
                            <input type="text" name="note" id="note">
                        </div>
                        <button type="submit">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
