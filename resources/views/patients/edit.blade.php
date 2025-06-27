<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.658 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Chỉnh sửa thông tin bệnh nhân
        </h2>
        <div class="text-gray-500 mt-1">
            Quản lý hồ sơ bệnh nhân
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg p-8">
                <form method="POST" action="{{ route('patients.update', $patient) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Số CCCD</label>
                            <input type="text" name="national_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->national_id }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Tên</label>
                            <input type="text" name="name"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->name }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Ngày sinh</label>
                            <input type="date" name="date_of_birth"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->date_of_birth }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Giới tính</label>
                            <select name="gender"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Chọn</option>
                                <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Nam</option>
                                <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                                <option value="other" {{ $patient->gender == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-1">Địa chỉ</label>
                            <input type="text" name="address"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->address }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Số BHYT</label>
                            <input type="text" name="insurance_number"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->insurance_number }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Ngày hết hạn BHYT</label>
                            <input type="date" name="insurance_expiry_date"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                value="{{ $patient->insurance_expiry_date }}">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t mt-8">
                        <a href="{{ route('appointments.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-md transition">Hủy</a>
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
