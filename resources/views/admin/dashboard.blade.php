<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <!-- Stats -->
                <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border-l-4 border-yellow-400 dark:border-yellow-500 dark:shadow-2xl transition-all duration-300">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Menunggu Proses</div>
                        <div class="text-3xl font-bold text-gray-800 dark:text-white">{{ $pending }}</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border-l-4 border-blue-400 dark:border-blue-500 dark:shadow-2xl transition-all duration-300">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Sedang Diproses</div>
                        <div class="text-3xl font-bold text-gray-800 dark:text-white">{{ $proses }}</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border-l-4 border-purple-400 dark:border-purple-500 dark:shadow-2xl transition-all duration-300">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Selesai Dikerjakan</div>
                        <div class="text-3xl font-bold text-gray-800 dark:text-white">{{ $selesai_dikerjakan }}</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border-l-4 border-green-400 dark:border-green-500 dark:shadow-2xl transition-all duration-300">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Selesai</div>
                        <div class="text-3xl font-bold text-gray-800 dark:text-white">{{ $selesai }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-slate-700/50 dark:shadow-2xl transition-all duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">Laporan Terbaru</h3>
                        <a href="{{ route('admin.reports.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 transition-colors">Lihat Semua Laporan &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700/50">
                            <thead class="bg-gray-50 dark:bg-slate-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pelapor</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-transparent divide-y divide-gray-200 dark:divide-slate-700/50">
                                @forelse($recentReports as $report)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $report->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">{{ $report->user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($report->title, 40) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($report->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900/50 text-yellow-800 dark:text-yellow-300">Menunggu</span>
                                            @elseif($report->status == 'proses')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">Diproses</span>
                                            @elseif($report->status == 'selesai_dikerjakan')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">Selesai Dikerjakan</span>
                                            @elseif($report->status == 'selesai')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada laporan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
