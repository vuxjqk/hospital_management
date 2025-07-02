<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 -mx-4 -mt-4 px-6 py-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm8 4a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ __('Bảng Điều Khiển Bệnh Viện') }}
                    </h2>
                    <p class="text-blue-100 text-sm mt-1">Quản lý bệnh nhân và lịch hẹn</p>
                </div>
                <div class="text-right">
                    <p class="text-blue-100 text-sm">{{ date('d/m/Y') }}</p>
                    <p class="text-blue-200 text-xs">{{ date('H:i') }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Patient List Panel -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Danh Sách Bệnh Nhân
                        </h3>
                        <a href="{{ route('patients.create') }}"
                            class="mt-3 bg-white text-indigo-700 no-underline px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center text-sm hover:no-underline">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Thêm Bệnh Nhân Mới
                        </a>

                        <form method="GET" action="{{ route('patients.index') }}" class="mt-6">
                            <div class="flex flex-col sm:flex-row">
                                <div class="flex-1">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <input type="search" name="search"
                                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-l-lg rounded-r-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 text-sm"
                                            placeholder="Tìm kiếm theo tên bệnh nhân..." value="{{ $search }}">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-r-lg rounded-l-none transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-sm">
                                    Tìm kiếm
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="max-h-96 overflow-y-auto">
                        @forelse ($patients as $patient)
                            <div class="border-b border-gray-100 last:border-b-0">
                                <button type="button"
                                    class="w-full text-left p-4 hover:bg-gray-50 transition-colors duration-200 focus:bg-blue-50 focus:outline-none"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-patient-id="{{ $patient->id }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <h5 class="font-semibold text-gray-900 text-base">{{ $patient->full_name }}</h5>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">3 ngày
                                            trước</span>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0" />
                                            </svg>
                                            CMND/CCCD: <span class="font-medium">{{ $patient->national_id }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            BH: {{ $patient->insurance_number }} - HH:
                                            {{ date('d/m/Y', strtotime($patient->insurance_expiry_date)) }}
                                        </p>
                                    </div>
                                </button>
                                <div class="px-4 pb-3">
                                    <a href="{{ route('patients.edit', $patient) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Chi tiết
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <p class="text-gray-500">Chưa có bệnh nhân nào</p>
                            </div>
                        @endforelse
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>

            <!-- Appointments Table -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Lịch Hẹn Khám Bệnh
                        </h3>
                        <p class="text-emerald-100 text-sm mt-1">Quản lý và theo dõi các cuộc hẹn</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        CMND/CCCD
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Họ và Tên
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Chuyên Khoa
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Trạng Thái
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Hành Động
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($appointments as $appointment)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $appointment->patient->national_id }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-white">
                                                            {{ substr($appointment->patient->full_name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $appointment->patient->full_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $appointment->specialty->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Chờ khám
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <button
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors duration-200">
                                                Xem
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 px-3 py-1 rounded-md transition-colors duration-200">
                                                Khám
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-gray-500">Chưa có lịch hẹn nào</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Appointment Modal -->
    <form action="{{ route('appointments.store') }}" method="POST">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow-2xl">
                    <div class="modal-header bg-gradient-to-r from-emerald-600 to-emerald-700 text-white border-0">
                        <h1 class="modal-title fs-5 font-semibold flex items-center" id="exampleModalLabel">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Đặt Lịch Khám Bệnh
                        </h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-6">
                        @csrf
                        <input type="hidden" name="patient_id" id="selectedId">

                        <div class="mb-4">
                            <label for="specialty_id" class="form-label font-medium text-gray-700">Chọn Chuyên Khoa
                                *</label>
                            <select class="form-select border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                name="specialty_id" required>
                                <option value="">Chọn chuyên khoa</option>
                                @foreach ($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input text-emerald-600 focus:ring-emerald-500"
                                    type="checkbox" value="1" id="checkDefault" name="has_insurance">
                                <label class="form-check-label font-medium text-gray-700" for="checkDefault">
                                    Sử dụng bảo hiểm y tế
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-50 border-0">
                        <button type="button" class="btn btn-light border border-gray-300 text-gray-700"
                            data-bs-dismiss="modal">
                            Hủy Bỏ
                        </button>
                        <button type="submit"
                            class="btn btn-success bg-emerald-600 border-emerald-600 hover:bg-emerald-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Đặt Lịch Hẹn
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var exampleModal = document.getElementById('exampleModal');
            exampleModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var patientId = button.getAttribute('data-patient-id');
                var input = exampleModal.querySelector('#selectedId');
                input.value = patientId;
            });
        });
    </script>

    <style>
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }

        .btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
        }

        .table th {
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .modal-content {
            border-radius: 0.75rem;
        }

        .modal-header {
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .modal-footer {
            border-radius: 0 0 0.75rem 0.75rem;
        }
    </style>
</x-app-layout>
