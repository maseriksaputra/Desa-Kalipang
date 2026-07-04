<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Proses Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800/80 shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">Update Status Pekerjaan</h3>
                    <form action="{{ route('pegawai.reports.update-status', $report->id) }}" method="POST" class="flex gap-4 items-center">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="block w-full border-gray-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 rounded-md shadow-sm transition-colors">
                            <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Sedang Diproses (Dikerjakan)</option>
                            <option value="selesai_dikerjakan" {{ $report->status == 'selesai_dikerjakan' ? 'selected' : '' }}>Selesai Dikerjakan (Menunggu Validasi Admin)</option>
                            @if($report->status == 'selesai')
                            <option value="selesai" selected disabled>Selesai (Sudah Divalidasi Admin)</option>
                            @endif
                        </select>
                        <x-primary-button>Update</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800/80 shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold">{{ $report->title }}</h3>
                    <div class="mt-2 text-sm text-gray-500">
                        Kategori: <span class="font-bold">{{ $report->category }}</span> | 
                        Pelapor: {{ $report->user->name }} | 
                        Tanggal: {{ $report->created_at->format('d M Y, H:i') }}
                    </div>

                    <div class="mt-6">
                        <p class="whitespace-pre-wrap">{{ $report->description }}</p>
                    </div>

                    @if($report->image_proof)
                        <div class="mt-6">
                            <h4 class="font-bold mb-2">Foto Bukti</h4>
                            <img src="{{ Storage::url($report->image_proof) }}" class="max-w-full h-auto rounded shadow-sm">
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
