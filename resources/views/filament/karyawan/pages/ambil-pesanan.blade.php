<x-filament-panels::page>
   <div class="space-y-4">

        @php
            $pesanans = \App\Models\Pesanan::where('status_produksi', 'menunggu')->get();
        @endphp

        @if($pesanans->count() > 0)

            @foreach($pesanans as $pesanan)

                <x-filament::card>
                    <div class="flex justify-between items-center">

                        <div>
                            <h2 class="font-bold text-lg">
                                {{ $pesanan->nama_pelanggan }}
                            </h2>

                            <p>
                                {{ $pesanan->jenis_bakso }} -
                                {{ $pesanan->jumlah }} pcs
                            </p>

                            <p class="text-sm text-gray-500">
                                Tanggal Ambil:
                                {{ \Carbon\Carbon::parse($pesanan->tanggal_ambil)->format('d M Y') }}
                            </p>
                        </div>

                        <x-filament::button
                            color="success"
                            wire:click="ambil({{ $pesanan->id }})"
                        >
                            Ambil Produksi
                        </x-filament::button>

                    </div>
                </x-filament::card>

            @endforeach

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
