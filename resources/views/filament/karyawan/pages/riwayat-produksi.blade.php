<x-filament::page>

    @php
        $riwayat = \App\Models\Produksi::where('user_id', auth()->id())
            ->whereHas('pesanan', fn ($q) => $q->where('status_produksi', 'selesai'))
            ->with(['pesanan', 'produksiDetails'])
            ->latest()
            ->get();
    @endphp

    <div class="space-y-8">

        @forelse($riwayat as $produksi)

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden">

                <div class="px-8 py-6 bg-gray-50 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ $produksi->pesanan->nama_pelanggan }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $produksi->pesanan->jenis_bakso }}
                            • {{ $produksi->jumlah_produksi }} pcs
                        </p>
                    </div>

                    <span class="px-4 py-1 text-sm font-semibold bg-green-100 text-green-700 rounded-full">
                        Selesai
                    </span>
                </div>

                <div class="px-8 py-6 space-y-4">

                    <div class="grid grid-cols-3 gap-6 text-sm">

                        <div>
                            <p class="text-gray-400">Tanggal Produksi</p>
                            <p class="font-semibold text-gray-800">
                                {{ $produksi->tanggal_produksi->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-400">Total Jenis Bahan</p>
                            <p class="font-semibold text-gray-800">
                                {{ $produksi->produksiDetails->count() }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-400">Total Item Diproduksi</p>
                            <p class="font-semibold text-gray-800">
                                {{ $produksi->jumlah_produksi }} pcs
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-10 text-center">
                <h2 class="text-lg font-semibold text-gray-700">
                    Belum ada riwayat produksi
                </h2>
                <p class="text-gray-400 mt-2">
                    Produksi yang selesai akan tampil di sini.
                </p>
            </div>

        @endforelse

    </div>

</x-filament::page>
