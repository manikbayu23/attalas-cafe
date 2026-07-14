<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Attalas Cafe</title>
    <link href="{{ asset('admin_assets/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        :root {
            --attalas-brown-900: #2b160d;
            --attalas-brown-500: #8b5a2b;
            --attalas-cream-50: #f9f5f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: radial-gradient(circle at top left, rgba(139, 90, 43, 0.28), transparent 55%), var(--attalas-cream-50);
            color: #1f2933;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-wrapper {
            max-width: 900px;
            width: 100%;
            padding: 2.5rem 1.5rem;
        }

        .error-card {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 2rem;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
            overflow: hidden;
        }

        .error-main {
            padding: 2rem 2.25rem;
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            background: rgba(43, 22, 13, 0.06);
            color: var(--attalas-brown-900);
            margin-bottom: 0.75rem;
        }

        .error-code {
            font-size: clamp(2.4rem, 4vw, 3rem);
            font-weight: 800;
            color: var(--attalas-brown-900);
            margin-bottom: 0.5rem;
        }

        .error-title {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .error-text {
            font-size: 0.95rem;
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.55rem 1.15rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.15s ease, color 0.15s ease, box-shadow 0.15s ease, transform 0.08s ease;
        }

        .btn-primary {
            background-color: var(--attalas-brown-500);
            color: #fff;
            border-color: var(--attalas-brown-500);
            box-shadow: 0 10px 20px rgba(139, 90, 43, 0.35);
        }

        .btn-primary:hover {
            background-color: #6f431f;
            border-color: #6f431f;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background-color: transparent;
            color: #4b5563;
            border-color: rgba(148, 163, 184, 0.7);
        }

        .btn-ghost:hover {
            background-color: rgba(148, 163, 184, 0.08);
        }

        .error-aside {
            background: radial-gradient(circle at top, rgba(249, 245, 240, 0.7), transparent 55%),
                linear-gradient(145deg, var(--attalas-brown-900), var(--attalas-brown-500));
            padding: 2rem 1.75rem;
            color: #fdfaf5;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-mark {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .brand-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.9);
        }

        .error-quote {
            font-size: 0.95rem;
            line-height: 1.6;
            color: rgba(249, 245, 240, 0.9);
        }

        .error-quote span {
            display: block;
            margin-top: 0.75rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: rgba(249, 245, 240, 0.7);
        }

        @media (max-width: 768px) {
            .error-card {
                grid-template-columns: minmax(0, 1fr);
            }

            .error-aside {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="error-wrapper">
        <div class="error-card">
            <div class="error-main">
                <div class="badge-soft">
                    <i class="ph-warning"></i>
                    <span>404 Not Found</span>
                </div>

                <div class="error-code">Ups, halaman tidak ditemukan.</div>
                <div class="error-title">Sepertinya kamu nyasar ke sudut lain Attalas Cafe.</div>
                <p class="error-text">
                    Halaman yang kamu cari tidak tersedia, mungkin sudah dipindahkan, diganti, atau salah alamat.
                    Coba kembali ke halaman utama atau dashboard admin.
                </p>

                <div class="actions">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                            <i class="ph-gauge"></i>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="ph-house"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    @endauth

                    <a href="{{ url()->previous() }}" class="btn btn-ghost">
                        <i class="ph-arrow-left"></i>
                        <span>Halaman Sebelumnya</span>
                    </a>
                </div>
            </div>

            <aside class="error-aside">
                <div class="brand-mark">
                    <span class="brand-dot"></span>
                    <span>Attalas Cafe Management</span>
                </div>
                <p class="error-quote">
                    "Setiap sudut Attalas punya cerita. Kadang, kita hanya belum di meja yang tepat."
                    <span>Attalas Cafe</span>
                </p>
            </aside>
        </div>
    </div>
</body>

</html>
