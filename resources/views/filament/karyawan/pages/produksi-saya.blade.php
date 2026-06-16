<x-filament::page>
    <div class="space-y-8">

        @php
            $produksis = \App\Models\Produksi::where('user_id', auth()->id())
                ->whereHas('pesanans', fn ($q) => $q->where('status_produksi', 'diproduksi'))
                ->with(['pesanans.pelanggan', 'produksiDetails.bahanBaku'])
                ->get();
        @endphp

        @forelse($produksis as $produksi)

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden">

                {{-- HEADER --}}
                <div class="px-8 py-6 flex justify-between items-start bg-gradient-to-r from-gray-50 to-white">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Batch Produksi #{{ $produksi->id }}
                        </h2>
                        <p class="text-gray-500 mt-1">
                            {{ $produksi->pesanans->count() }} pesanan
                            • {{ number_format($produksi->jumlah_produksi) }} pcs
                            • {{ number_format($produksi->total_berat) }} gr
                        </p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($produksi->pesanans as $pesanan)
                                <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">
                                    {{ $pesanan->pelanggan?->nama }} ({{ number_format($pesanan->jumlah) }} {{ $pesanan->satuan }})
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <span class="px-4 py-1 text-sm font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                        Diproduksi
                    </span>
                </div>

                {{-- BODY --}}
                <div class="px-8 py-6 space-y-6">

                    {{-- INPUT BAHAN --}}
                    <div>
                        <h3 class="text-base font-semibold text-gray-700 mb-4">
                            Input Penggunaan Bahan
                        </h3>

                        <div class="rounded-2xl border border-gray-100 overflow-hidden shadow-sm">

                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 text-gray-600">
                                    <tr>
                                        <th class="px-6 py-4 text-left font-semibold">Bahan</th>
                                        <th class="px-6 py-4 text-left font-semibold">Stok</th>
                                        <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    <tr class="border-t border-gray-100 hover:bg-gray-50 transition">

                                        <td class="px-6 py-4">
                                            <select wire:model.live="bahan_id"
                                                class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 shadow-sm">
                                                <option value="">Pilih Bahan</option>
                                                @foreach(\App\Models\BahanBaku::all() as $bahan)
                                                    <option value="{{ $bahan->id }}">
                                                        {{ $bahan->nama_bahan }} ({{ $bahan->jenis === 'bahan_utama' ? 'Utama' : 'Bumbu' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($this->stokBahan)
                                                <span class="font-semibold text-gray-800">
                                                    {{ number_format($this->stokBahan->stok) }}
                                                    {{ $this->stokBahan->satuan }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <input type="number"
                                                wire:model="jumlah"
                                                min="1"
                                                class="w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 shadow-sm"
                                                placeholder="Masukkan jumlah (gram)">
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <x-filament::button
                                                size="sm"
                                                color="warning"
                                                class="rounded-xl shadow-sm"
                                                wire:click="tambahBahan({{ $produksi->id }})">
                                                Ambil Bahan
                                            </x-filament::button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- HISTORI BAHAN --}}
                    @if($produksi->produksiDetails->count() > 0)

                        <div class="space-y-4">
                            <h3 class="text-base font-semibold text-gray-700">
                                Histori Bahan Digunakan
                            </h3>

                            <div class="rounded-2xl border border-gray-100 overflow-hidden shadow-sm">

                                <table class="w-full text-sm">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="px-6 py-4 text-left font-semibold">No</th>
                                            <th class="px-6 py-4 text-left font-semibold">Nama Bahan</th>
                                            <th class="px-6 py-4 text-left font-semibold">Jumlah</th>
                                            <th class="px-6 py-4 text-left font-semibold">Waktu Input</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white">
                                        @foreach($produksi->produksiDetails as $index => $detail)
                                            <tr class="border-t border-gray-100 hover:bg-gray-50 transition">
                                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 font-medium text-gray-800">
                                                    {{ $detail->bahanBaku->nama_bahan }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ number_format($detail->jumlah_digunakan) }}
                                                    {{ $detail->bahanBaku->satuan }}
                                                </td>
                                                <td class="px-6 py-4 text-gray-500 text-xs">
                                                    {{ $detail->created_at->format('d M Y H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex justify-end">
                                <div class="bg-gray-50 px-6 py-3 rounded-xl text-sm font-semibold text-gray-700 shadow-sm">
                                    Total Jenis Bahan: {{ $produksi->produksiDetails->count() }}
                                </div>
                            </div>
                        </div>

                    @endif

                    {{-- BUTTON SELESAI --}}
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <x-filament::button
                            color="success"
                            class="rounded-2xl px-6 py-3 text-base shadow-md"
                            wire:click="selesaikan({{ $produksi->id }})">
                            Selesaikan Produksi
                        </x-filament::button>
                    </div>

                </div>
            </div>

        @empty

            <div class="bg-white rounded-3xl shadow-md border border-gray-100 p-10 text-center">
                <h2 class="text-xl font-semibold text-gray-700">
                    Tidak ada produksi aktif
                </h2>
                <p class="text-gray-400 mt-2">
                    Silakan ambil pesanan terlebih dahulu.
                </p>
            </div>

        @endforelse

    </div>
</x-filament::page>
