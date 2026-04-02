<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Social Connector</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            /* Recreating the soft blue-to-white radial gradient from the screenshot */
            background: radial-gradient(circle at center,rgba(224, 231, 255, 0) 0%,rgba(248, 250, 251, 0) 100%);
        }
        .auth-card {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-6 relative">
    <img src="loginimage.avif" alt="" class="absolute inset-0 w-full h-full object-cover opacity-5 -z-10 pointer-events-none" style="transform: scaleY(-1);" />

    <div class="flex items-center space-x-3 mb-6">
        <div class="bg-[#1A4BFF] p-2 rounded-full text-white shadow-lg shadow-blue-200">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71z"/>
            </svg>
        </div>
        <span class="font-bold text-gray-800 text-2xl tracking-tight">Social Connector</span>
    </div>

    <div class="w-full max-w-[440px] bg-white rounded-[2.5rem] overflow-hidden auth-card border border-white">
        
        <div class="h-40 bg-[#141B2D] relative overflow-hidden flex items-start justify-center">
            <img src="loginimage.avif" class="absolute w-full h-full object-cover">
            <div class="absolute top-8 left-1/2 transform -translate-x-1/2 mt-6 text-center w-full z-10">
                <h2 class="text-2xl font-bold text-white mb-2">Sign in</h2>
                <p class="text-gray-400 text-sm">Enter your credentials to access your account</p>
            </div>
        </div>

        <div class="p-10 text-center">

            <form action="dashboard" method="POST" class="text-left space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">Email Address</label>
                    <input type="email" placeholder="name@company.com" 
                           class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all text-sm">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 px-1">
                        <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-[10px] font-bold text-blue-600 hover:underline">Forgot?</a>
                    </div>
                    <div class="relative">
                        <input id="password-input" type="password" placeholder="Enter your password" 
                               class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-100 focus:bg-white transition-all text-sm">
                        <button type="button" id="toggle-password" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 text-sm" tabindex="-1" aria-label="Show or Hide Password">👁️</button>
                    </div>
                    <script>
                        // Password hide/show toggle
                        const pwdInput = document.getElementById('password-input');
                        const pwdToggle = document.getElementById('toggle-password');
                        let showing = false;
                        pwdToggle.addEventListener('click', function() {
                            showing = !showing;
                            pwdInput.type = showing ? 'text' : 'password';
                            pwdToggle.textContent = showing ? '🙈' : '👁️';
                        });
                    </script>
                </div>

                <button type="submit" class="w-full bg-[#1A4BFF] hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-100 transition-all transform active:scale-[0.98]">
                    Sign In
                </button>

                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Or continue with</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="flex items-center justify-center space-x-2 py-3 border border-gray-100 rounded-2xl hover:bg-gray-50 transition text-sm font-semibold text-gray-600">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4">
                        <span>Google</span>
                    </button>
                    <button type="button" class="flex items-center justify-center space-x-2 py-3 border border-gray-100 rounded-2xl hover:bg-gray-50 transition text-sm font-semibold text-gray-600">
                        <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-4 h-4">
                        <span>Github</span>
                    </button>
                </div>
            </form>

            <p class="mt-10 text-sm text-gray-500">
                Don't have an account? <a href="signup.php" class="text-blue-600 font-bold hover:underline">Create a new account</a>
            </p>
        </div>
    </div>

    <div class="mt-10 flex space-x-6 text-[11px] font-medium text-gray-400">
        <a href="#" class="hover:text-gray-600">Privacy Policy</a>
        <a href="#" class="hover:text-gray-600">Terms of Service</a>
        <a href="#" class="hover:text-gray-600">Help Center</a>
    </div>

</body>
</html>