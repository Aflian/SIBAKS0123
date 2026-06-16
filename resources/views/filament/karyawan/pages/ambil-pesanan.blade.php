<x-filament-panels::page>
    <div class="space-y-4">

        @php
            $pesanans = \App\Models\Pesanan::where('status_produksi', 'menunggu')->get();
        @endphp

        @if($pesanans->count() > 0)

            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">
                        {{ $pesanans->count() }} pesanan tersedia
                    </h2>
                    <p class="text-sm text-gray-500">
                        Centang pesanan yang ingin diproduksi bersama.
                    </p>
                </div>

                <x-filament::button
                    color="success"
                    wire:click="ambil"
                    class="rounded-2xl px-6 py-3 shadow-md text-base">
                    Produksi Terpilih
                </x-filament::button>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @foreach($pesanans as $pesanan)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5
                        {{ isset($this->selectedPesanan[$pesanan->id]) && $this->selectedPesanan[$pesanan->id] ? 'ring-2 ring-primary-500' : '' }}">

                        <div class="flex justify-between items-center">

                            <div class="flex items-center gap-4">
                                <input type="checkbox"
                                    wire:model.live="selectedPesanan.{{ $pesanan->id }}"
                                    value="true"
                                    class="w-5 h-5 rounded border-gray-300 text-primary-600 focus:ring-primary-500">

                                <div>
                                    <h2 class="font-bold text-lg">
                                        {{ $pesanan->pelanggan?->nama ?? 'Pelanggan' }}
                                    </h2>

                                    <p class="text-sm text-gray-600">
                                        {{ number_format($pesanan->jumlah) }} {{ $pesanan->satuan }}
                                        ({{ number_format($pesanan->berat_total_gram) }} gram)
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Tanggal Ambil:
                                        {{ \Carbon\Carbon::parse($pesanan->tanggal_ambil)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                                {{ $pesanan->status_pembayaran === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                            </span>

                        </div>
                    </div>
                @endforeach
            </div>

        @else

            <x-filament::card>
                <div class="text-center py-6">
                    <h2 class="text-lg font-semibold text-gray-600">
                        Tidak ada pesanan yang bisa diambil
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Semua pesanan sudah diproduksi atau belum ada pesanan masuk.
                    </p>
                </div>
            </x-filament::card>

        @endif

    </div>
</x-filament-panels::page>
