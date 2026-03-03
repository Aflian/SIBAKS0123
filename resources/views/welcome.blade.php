<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakso Maju Jaya • Produksi Bakso Berkualitas</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome 6 (Ikon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Efek bayangan lembut dan transisi */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- HERO SECTION --}}
    @include('component.hero')
    {{-- DESKRIPSI TOKO --}}
    @include('component.desc')
    {{-- PRODUK UNGGULAN --}}
    @include('component.product')
    {{-- OWNER --}}
    @include('component.owner')
    {{-- TESTIMONI --}}
    @include('component.testi')
    {{-- CONTACT & ALAMAT --}}
    @include('component.contact')
    {{-- FOOTER --}}
    @include('component.footer')
</body>

</html>
