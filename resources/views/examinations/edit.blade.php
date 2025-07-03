<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>{{ $examination->patient->national_id }}</div>
                    <div>{{ $examination->patient->full_name }}</div>
                    <form action="{{ route('examinations.update', $examination) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="symptoms">Triệu chứng</label>
                            <input type="text" name="symptoms" id="symptoms"
                                value="{{ old('symptoms', $examination->symptoms) }}">
                        </div>
                        <div>
                            <label for="diagnosis">Chẩn đoán</label>
                            <input type="text" name="diagnosis" id="diagnosis"
                                value="{{ old('diagnosis', $examination->diagnosis) }}">
                        </div>
                        <div>
                            <label for="treatment">Điều trị</label>
                            <input type="text" name="treatment" id="treatment"
                                value="{{ old('treatment', $examination->treatment) }}">
                        </div>
                        <div>
                            <label for="note">Lưu ý</label>
                            <input type="text" name="note" id="note"
                                value="{{ old('note', $examination->note) }}">
                        </div>
                        <button type="submit">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
