# SIBAKSO — Bakso Management App

Laravel 12 + Filament 3 monolith. Manages orders, production, raw materials, and stock for a bakso business.

## Quick start

```bash
composer setup          # full first-time setup (composer install, .env, key, migrate, npm install & build)
composer dev            # dev server: php artisan serve + queue:listen + pail logs + Vite, all in parallel
composer test           # runs config:clear then artisan test (Pest)
npm run build           # Vite production build
```

## Testing (Pest 4)

- Tests are in `tests/Unit` and `tests/Feature`
- Uses SQLite `:memory:` — no external DB needed.
- `composer test` runs both suites (clears config first).
- Run a single file: `php artisan test tests/Feature/ExampleTest.php`

## Linting

Laravel Pint (`vendor/bin/pint`). No dedicated script in composer.json.

## Two Filament panels

| Panel    | Path       | Role required | Auth middleware                        |
|----------|------------|---------------|----------------------------------------|
| Admin    | `/admin`   | `admin`       | `Authenticate` + `adminCheck`          |
| Karyawan | `/karyawan`| `karyawan`    | `Authenticate` only                    |

- Admin discovers resources from `app/Filament/Resources/`
- Karyawan panel has its own dedicated pages under `app/Filament/Karyawan/`
- Vite theme for karyawan: `resources/css/filament/karyawan/theme.css`
- `adminCheck` middleware (`app/Http/Middleware/adminCheck.php`) logs out non-admin users.

## Key models & relationships

```
User (role: admin|karyawan)  — hasMany Produksi
Pesanan (order)              — hasOne Produksi; belongsTo Pelanggan
BahanBaku (raw material)     — hasMany ProduksiDetail, Pembelian
Produksi (batch)             — belongsTo Pesanan, User; hasMany ProduksiDetail
ProduksiDetail               — belongsTo Produksi, BahanBaku
StokLog (stock mutation)     — belongsTo BahanBaku, User (tracks stock changes)
Pemasok (supplier)           — hasMany Pembelian
Pembelian (purchase)         — belongsTo Pemasok, BahanBaku
Pelanggan (customer)         — hasMany Pesanan
```

- `Produksi::created` auto-updates `Pesanan.status_produksi` to `'diproduksi'`
- `ProduksiDetail::created` auto-decrements `BahanBaku.stok` (via `keluar` StokLog)
- `Pembelian::created` auto-increments `BahanBaku.stok` (via `masuk` StokLog)
- `BahanBaku::tambahStok()` creates a `masuk` StokLog entry
- `BahanBaku::isLowStock()` checks `stok <= minimum_stok`

## Architecture notes

- Config is standard Laravel. No unusual env loading.
- `DB_CONNECTION=mysql` in `.env` (production); `sqlite/:memory:` for tests.
- `QUEUE_CONNECTION=database`, `CACHE_STORE=database`, `SESSION_DRIVER=database`
- Vite entry: `resources/css/app.css`, `resources/js/app.js`
- `tool/evillimiter/` is a bundled third-party Python tool (network bandwidth limiter), unrelated to the Laravel app.
- No CI workflows, no pre-commit hooks, no codegen, no Docker config.
