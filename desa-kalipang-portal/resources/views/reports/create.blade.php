<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Buat Laporan Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800/80 dark:backdrop-blur-xl overflow-hidden shadow-sm dark:shadow-2xl sm:rounded-2xl border border-gray-100 dark:border-slate-700/50 transition-all duration-300">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Judul Laporan')" />
                            <x-text-input id="title" class="block mt-1 w-full dark:bg-slate-900/50 dark:border-slate-700/50 dark:text-gray-200 dark:focus:ring-indigo-500/50 dark:focus:border-indigo-500/50 transition-colors" type="text" name="title" :value="old('title')" required autofocus placeholder="Contoh: Jalan berlubang di Dusun Krajan" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Buat judul yang singkat dan jelas mengenai masalah yang dilaporkan.</p>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Detail Pengaduan')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-slate-700/50 dark:bg-slate-900/50 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-500/50 dark:focus:border-indigo-500/50 rounded-md shadow-sm transition-colors" required placeholder="Jelaskan detail lokasi dan masalahnya secara rinci...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image Proof -->
                        <div class="mb-6">
                            <x-input-label for="image_proof" :value="__('Foto Bukti (Opsional)')" />
                            <div class="mt-1 flex items-center">
                                <input type="file" id="image_proof" name="image_proof" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 transition-colors" accept="image/*" />
                            </div>
                            <x-input-error :messages="$errors->get('image_proof')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload foto maksimal 2MB (JPG, PNG).</p>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t dark:border-slate-700/50 pt-6">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800 disabled:opacity-25 transition-all duration-300 mr-3">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Kirim Laporan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
