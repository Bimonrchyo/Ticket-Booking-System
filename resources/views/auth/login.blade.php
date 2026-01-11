<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HubTrans System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 overflow-x-hidden">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="bg-white p-8 pb-4 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 text-blue-700 rounded-2xl mb-4">
                <i class="fas fa-route text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500 text-sm">Silakan masuk ke akun HubTrans Anda</p>
        </div>

        <div class="p-8 pt-4">
            <form action="proses_signin.php" method="POST" class="space-y-5">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email atau Username</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="text" name="identity" required
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all"
                            placeholder="Masukkan email anda...">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="text-sm font-semibold text-gray-700">Password</label>
                        <a href="/forgetpassword" class="text-xs font-bold text-blue-600 hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-3.5 text-gray-400"></i>
                        <input type="password" name="password" required
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-blue-200 transform active:scale-[0.98] transition-all">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-400 italic">Belum punya akun?</span>
                </div>
            </div>

            <div class="text-center">
                <a href="/register" class="inline-block w-full border-2 border-gray-100 text-blue-600 font-bold py-3 rounded-xl hover:bg-gray-50 transition-all">
                    DAFTAR AKUN BARU
                </a>
            </div>
        </div>

        <div class="p-6 bg-gray-50 text-center border-t border-gray-100">
            <a href="/home" class="text-sm text-blue-600 font-semibold hover:text-blue-800">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>