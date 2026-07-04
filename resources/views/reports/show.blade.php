<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Detail Laporan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm dark:shadow-2xl sm:rounded-2xl border border-gray-100 dark:border-slate-700/50 transition-all duration-300 mb-6">
                
                <div class="border-b border-gray-200 dark:border-slate-700/50 px-6 py-5 flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $report->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Dilaporkan pada {{ $report->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        @if($report->status == 'pending')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Menunggu</span>
                        @elseif(in_array($report->status, ['proses', 'selesai_dikerjakan']))
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">Sedang Diproses</span>
                        @elseif($report->status == 'selesai')
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">Selesai</span>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 mb-8">
                        {!! nl2br(e($report->description)) !!}
                    </div>

                    @if($report->image_proof)
                        <div class="mt-6 border-t dark:border-slate-700/50 pt-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Foto Bukti Terlampir</h4>
                            <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-slate-700/50 inline-block bg-gray-50 dark:bg-slate-900/50 p-2">
                                <img src="{{ Storage::url($report->image_proof) }}" alt="Bukti Laporan" class="max-w-full h-auto max-h-[500px] object-contain rounded">
                            </div>
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
