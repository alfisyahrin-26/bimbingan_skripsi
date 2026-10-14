<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkripsiBimbingan - Platform Bimbingan Skripsi Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'ui-yellow': '#FFD700',
                        'ui-gold': '#FFA500',
                        'ui-amber': '#FFBF00'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            box-sizing: border-box;
        }
        
        /* Premium UI Yellow Color Palette */
        .gradient-primary {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f3460 50%, #533483 75%, #1a1a2e 100%);
            position: relative;
        }
        
        .gradient-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(255, 215, 0, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 165, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 191, 0, 0.08) 0%, transparent 50%);
        }
        
        /* Modern Card Design */
        .modern-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 
                0 20px 40px -12px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 215, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .modern-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 32px 64px -12px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 215, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .dark .modern-card {
            background: rgba(30, 41, 59, 0.9);
            border: 1px solid rgba(255, 215, 0, 0.3);
            box-shadow: 
                0 20px 40px -12px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 215, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        
        /* Premium Yellow Icons */
        .icon-premium {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
            position: relative;
            overflow: hidden;
        }
        
        .icon-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
        }
        
        .icon-premium::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            right: 2px;
            bottom: 2px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 100%);
            border-radius: inherit;
        }
        
        /* Sophisticated Glass Effect */
        .glass-premium {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(30px) saturate(180%);
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-premium {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 215, 0, 0.3);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        
        /* Advanced Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 10px 30px -5px rgba(255, 165, 0, 0.4),
                0 0 0 1px rgba(255, 215, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 15px 40px -5px rgba(255, 165, 0, 0.5),
                0 0 0 1px rgba(255, 215, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
        
        /* Elegant Animations */
        .float-elegant {
            animation: floatElegant 6s ease-in-out infinite;
        }
        
        @keyframes floatElegant {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            33% { 
                transform: translateY(-20px) rotate(1deg); 
            }
            66% { 
                transform: translateY(-10px) rotate(-1deg); 
            }
        }
        
        /* Modern Grid Layout */
        .grid-modern {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2rem;
        }
        
        /* Premium Border Effect */
        .border-premium {
            position: relative;
            background: linear-gradient(135deg, #FFD700, #FFA500, #FF8C00);
            padding: 2px;
            border-radius: 24px;
        }
        
        .border-premium-content {
            background: white;
            border-radius: 22px;
            position: relative;
        }
        
        .dark .border-premium-content {
            background: #1e293b;
        }
        
        /* Hexagonal Background Pattern */
        .hex-bg {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(255, 215, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 165, 0, 0.03) 0%, transparent 50%);
            background-size: 80px 80px;
            background-position: 0 0, 40px 40px;
        }
        
        /* Text Gradient Effects */
        .text-gradient-primary {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FF8C00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Smooth Transitions */
        .transition-premium {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Advanced Shadow System */
        .shadow-premium {
            box-shadow: 
                0 20px 40px -8px rgba(255, 165, 0, 0.15),
                0 8px 16px -4px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 215, 0, 0.05);
        }
        
        .dark .shadow-premium {
            box-shadow: 
                0 20px 40px -8px rgba(0, 0, 0, 0.4),
                0 8px 16px -4px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 215, 0, 0.1);
        }
        
        /* Morphing Shapes */
        .morph-premium {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morphPremium 10s ease-in-out infinite;
        }
        
        @keyframes morphPremium {
            0%, 100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }
            25% {
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            }
            50% {
                border-radius: 50% 60% 30% 60% / 60% 40% 30% 70%;
            }
            75% {
                border-radius: 60% 30% 70% 40% / 30% 60% 70% 40%;
            }
        }
        
        /* Professional Typography */
        .text-premium {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-weight: 600;
            letter-spacing: -0.025em;
        }
    </style>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 font-sans transition-premium">
    <!-- Navigation -->
    <nav class="glass-premium sticky top-0 z-50 transition-premium border-b border-yellow-500/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-16 h-16 icon-premium rounded-3xl flex items-center justify-center shadow-premium morph-premium">
                            <span class="text-white font-bold text-3xl relative z-10">🎓</span>
                        </div>
                        <div class="ml-4">
                            <span class="text-2xl font-bold text-gradient-primary text-premium">SkripsiBimbingan</span>
                            <div class="text-xs text-slate-500 dark:text-slate-400 font-medium">Platform Akademik UI</div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <div class="flex items-center space-x-2 glass-premium rounded-2xl p-2">
                        <a href="#beranda" class="text-slate-700 dark:text-slate-300 hover:text-yellow-600 dark:hover:text-yellow-400 px-6 py-3 rounded-xl text-sm font-semibold transition-premium hover:bg-yellow-500/10 relative group">
                            <span class="relative z-10">Beranda</span>
                        </a>
                        <a href="#fitur" class="text-slate-700 dark:text-slate-300 hover:text-yellow-600 dark:hover:text-yellow-400 px-6 py-3 rounded-xl text-sm font-semibold transition-premium hover:bg-yellow-500/10 relative group">
                            <span class="relative z-10">Fitur</span>
                        </a>
                        <a href="#tentang" class="text-slate-700 dark:text-slate-300 hover:text-yellow-600 dark:hover:text-yellow-400 px-6 py-3 rounded-xl text-sm font-semibold transition-premium hover:bg-yellow-500/10 relative group">
                            <span class="relative z-10">Tentang</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button id="theme-toggle" class="p-3 rounded-2xl glass-premium text-slate-600 dark:text-slate-300 hover:bg-yellow-500/10 transition-premium border border-yellow-500/20">
                            <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </button>
                        <button class="btn-primary text-white px-8 py-3 rounded-2xl text-sm font-bold transition-premium">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Masuk
                            </span>
                        </button>
                    </div>
                </div>
                <div class="md:hidden flex items-center space-x-2">
                    <button id="theme-toggle-mobile" class="p-2 rounded-lg glass-premium text-slate-600 dark:text-slate-300">
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    <button class="text-gray-700 dark:text-gray-300 hover:text-yellow-600 dark:hover:text-yellow-400 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative overflow-hidden hex-bg">
        <div class="gradient-primary min-h-screen flex items-center justify-center transition-premium">
            <!-- Floating Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-yellow-400/10 morph-premium blur-3xl float-elegant"></div>
                <div class="absolute top-3/4 right-1/4 w-80 h-80 bg-orange-400/8 morph-premium blur-3xl float-elegant" style="animation-delay: -3s;"></div>
                <div class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-amber-400/6 morph-premium blur-3xl float-elegant" style="animation-delay: -6s;"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <!-- Left Content -->
                    <div class="text-left">
                        <div class="mb-10">
                            <div class="inline-flex items-center px-8 py-4 glass-premium rounded-full text-sm font-semibold text-white/90 mb-10 border border-yellow-500/30">
                                <div class="w-3 h-3 bg-yellow-400 rounded-full mr-4 animate-pulse shadow-lg"></div>
                                <span class="text-gradient-primary">Platform Akademik Universitas Indonesia</span>
                            </div>
                        </div>
                        
                        <h1 class="text-6xl md:text-8xl font-bold mb-10 leading-tight text-premium">
                            <span class="block text-white mb-4">Revolusi</span>
                            <span class="block text-gradient-primary">
                                Bimbingan
                            </span>
                            <span class="block text-white/90 text-4xl md:text-5xl font-light mt-6">
                                Skripsi Digital
                            </span>
                        </h1>
                        
                        <p class="text-2xl md:text-3xl mb-14 text-white/80 max-w-2xl leading-relaxed">
                            Ekosistem terintegrasi untuk mahasiswa dan dosen UI dalam mencapai excellence akademik
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-8 mb-16">
                            <button class="group btn-primary text-slate-800 px-14 py-5 rounded-3xl font-bold text-xl transition-premium shadow-premium">
                                <span class="flex items-center justify-center relative z-10">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Mulai Sekarang
                                    <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-premium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </button>
                            <button class="group glass-premium text-white px-14 py-5 rounded-3xl font-bold text-xl transition-premium border border-yellow-500/40 hover:border-yellow-500/60">
                                <span class="flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                    Demo Interaktif
                                </span>
                            </button>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="grid grid-cols-3 gap-10">
                            <div class="glass-premium rounded-3xl p-8 border border-yellow-500/20 text-center">
                                <div class="text-4xl font-bold text-gradient-primary mb-3">2,500+</div>
                                <div class="text-white/70 text-sm font-medium">Mahasiswa UI</div>
                            </div>
                            <div class="glass-premium rounded-3xl p-8 border border-yellow-500/20 text-center">
                                <div class="text-4xl font-bold text-gradient-primary mb-3">150+</div>
                                <div class="text-white/70 text-sm font-medium">Dosen Pembimbing</div>
                            </div>
                            <div class="glass-premium rounded-3xl p-8 border border-yellow-500/20 text-center">
                                <div class="text-4xl font-bold text-gradient-primary mb-3">98.5%</div>
                                <div class="text-white/70 text-sm font-medium">Tingkat Keberhasilan</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="relative">
                        <div class="modern-card rounded-3xl p-10 shadow-premium">
                            <!-- Mock Dashboard Preview -->
                            <div class="bg-white/98 dark:bg-slate-800/98 rounded-3xl p-8">
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 icon-premium rounded-2xl flex items-center justify-center">
                                            <span class="text-white text-xl relative z-10">👨‍🎓</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 dark:text-slate-200 text-lg">Budi Santoso</div>
                                            <div class="text-sm text-slate-500 dark:text-slate-400">Fakultas Teknik - 2020</div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <div class="w-4 h-4 bg-red-400 rounded-full shadow-sm"></div>
                                        <div class="w-4 h-4 bg-yellow-400 rounded-full shadow-sm"></div>
                                        <div class="w-4 h-4 bg-green-400 rounded-full shadow-sm"></div>
                                    </div>
                                </div>
                                
                                <div class="space-y-6">
                                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-6 rounded-2xl shadow-lg">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-sm opacity-90 mb-1">Progress Skripsi</div>
                                                <div class="text-3xl font-bold">82%</div>
                                                <div class="text-sm opacity-80 mt-1">Bab 5 - Kesimpulan</div>
                                            </div>
                                            <div class="text-4xl">📈</div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="bg-slate-50 dark:bg-slate-700 p-6 rounded-2xl border border-yellow-500/10">
                                            <div class="text-slate-600 dark:text-slate-300 text-sm mb-2">Total Bimbingan</div>
                                            <div class="text-2xl font-bold text-slate-800 dark:text-slate-200">18 Sesi</div>
                                            <div class="text-xs text-yellow-600 mt-1">+2 minggu ini</div>
                                        </div>
                                        <div class="bg-slate-50 dark:bg-slate-700 p-6 rounded-2xl border border-yellow-500/10">
                                            <div class="text-slate-600 dark:text-slate-300 text-sm mb-2">Status Terkini</div>
                                            <div class="text-2xl font-bold text-yellow-600">Review</div>
                                            <div class="text-xs text-slate-500 mt-1">Menunggu feedback</div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-slate-50 dark:bg-slate-700 p-6 rounded-2xl border border-yellow-500/10">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center">
                                                <span class="text-green-600 text-lg">✓</span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-semibold text-slate-800 dark:text-slate-200">Bab 4 Disetujui</div>
                                                <div class="text-sm text-slate-500 dark:text-slate-400">Dr. Ahmad Wijaya - 3 jam yang lalu</div>
                                            </div>
                                            <div class="text-2xl">🎉</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements Around Dashboard -->
                        <div class="absolute -top-6 -right-6 w-20 h-20 glass-premium rounded-3xl flex items-center justify-center float-elegant border border-yellow-500/30">
                            <span class="text-3xl">📝</span>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-20 h-20 glass-premium rounded-3xl flex items-center justify-center float-elegant border border-yellow-500/30" style="animation-delay: -2s;">
                            <span class="text-3xl">💬</span>
                        </div>
                        <div class="absolute top-1/2 -right-10 w-16 h-16 glass-premium rounded-2xl flex items-center justify-center float-elegant border border-yellow-500/30" style="animation-delay: -4s;">
                            <span class="text-2xl">📊</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-32 bg-white dark:bg-slate-900 transition-premium relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 hex-bg opacity-40"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-24">
                <div class="inline-flex items-center px-10 py-5 glass-premium rounded-full text-sm font-bold mb-10 border border-yellow-500/30">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-4 animate-pulse"></div>
                    <span class="text-gradient-primary">Fitur Unggulan Platform</span>
                </div>
                <h2 class="text-6xl md:text-8xl font-bold mb-10 leading-tight text-premium">
                    <span class="text-slate-800 dark:text-slate-200">Ekosistem</span>
                    <span class="block text-gradient-primary">Terintegrasi</span>
                </h2>
                <p class="text-2xl md:text-3xl text-slate-600 dark:text-slate-300 max-w-4xl mx-auto leading-relaxed">
                    Setiap fitur dirancang khusus untuk mendukung excellence akademik mahasiswa UI
                </p>
            </div>
            
            <div class="grid-modern">
                <!-- Feature 1 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-yellow-500/5 to-orange-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">📋</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                Smart Proposal System
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Sistem cerdas untuk pengajuan, review, dan persetujuan proposal dengan AI-powered recommendations dan workflow otomatis
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-orange-500/5 to-red-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">🎥</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                Virtual Meeting Hub
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Platform komunikasi terintegrasi dengan HD video conferencing, screen sharing, dan recording otomatis untuk dokumentasi
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">📊</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                Advanced Analytics
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Dashboard analitik komprehensif dengan machine learning insights, progress prediction, dan performance benchmarking
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-green-500/5 to-emerald-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">☁️</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                Cloud Document Suite
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Repositori dokumen enterprise-grade dengan version control, collaborative editing, dan backup otomatis yang aman
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-purple-500/5 to-pink-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">🤖</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                AI Assistant
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Asisten AI cerdas untuk optimasi jadwal, rekomendasi penelitian, dan automated task management dengan natural language processing
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="border-premium modern-card group">
                    <div class="border-premium-content p-12 h-full relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-teal-500/5 to-cyan-500/5 rounded-full -translate-y-20 translate-x-20"></div>
                        <div class="relative z-10">
                            <div class="icon-premium w-28 h-28 rounded-3xl flex items-center justify-center mb-10 shadow-premium group-hover:scale-110 transition-premium">
                                <span class="text-5xl relative z-10">🏆</span>
                            </div>
                            <h3 class="text-3xl font-bold text-slate-800 dark:text-slate-200 mb-8 group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-premium text-premium">
                                Achievement Tracker
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-xl leading-relaxed mb-10">
                                Sistem gamifikasi dengan milestone tracking, achievement badges, dan leaderboard untuk memotivasi pencapaian akademik
                            </p>
                            <div class="flex items-center text-yellow-600 dark:text-yellow-400 font-bold text-lg group-hover:translate-x-2 transition-premium">
                                <span>Pelajari Lebih Lanjut</span>
                                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Preview -->
    <section class="py-32 bg-slate-50 dark:bg-gray-800 transition-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <div class="inline-block px-8 py-3 glass-premium rounded-full text-sm font-bold mb-8 border border-yellow-500/30">
                    <span class="text-gradient-primary">🎯 Interface Premium</span>
                </div>
                <h2 class="text-5xl md:text-7xl font-bold text-gray-900 dark:text-white mb-8 leading-tight text-premium">
                    Dashboard <span class="text-gradient-primary">Profesional</span>
                </h2>
                <p class="text-2xl md:text-3xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto">
                    Interface yang elegan dan intuitif untuk pengalaman pengguna yang optimal
                </p>
            </div>
            
            <div class="modern-card rounded-3xl p-12 md:p-16 max-w-6xl mx-auto shadow-premium">
                <div class="flex items-center justify-between mb-10 pb-8 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 text-premium">Dashboard Mahasiswa</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">Selamat datang kembali, Sari Wijayanti</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-5 h-5 bg-red-500 rounded-full shadow-lg"></div>
                        <div class="w-5 h-5 bg-yellow-500 rounded-full shadow-lg"></div>
                        <div class="w-5 h-5 bg-green-500 rounded-full shadow-lg"></div>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-3 gap-10 mb-16">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-10 rounded-3xl shadow-premium hover:shadow-2xl transition-premium transform hover:scale-105">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-2xl font-bold">Status Proposal</h4>
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="text-3xl">✅</span>
                            </div>
                        </div>
                        <p class="text-5xl font-bold mb-3">Approved</p>
                        <p class="text-blue-100 text-lg">Proposal telah disetujui pembimbing</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-yellow-500 to-orange-500 text-white p-10 rounded-3xl shadow-premium hover:shadow-2xl transition-premium transform hover:scale-105">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-2xl font-bold">Progress</h4>
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="text-3xl">📊</span>
                            </div>
                        </div>
                        <p class="text-5xl font-bold mb-3">85%</p>
                        <p class="text-orange-100 text-lg">Bab 5 sedang dalam finalisasi</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-10 rounded-3xl shadow-premium hover:shadow-2xl transition-premium transform hover:scale-105">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-2xl font-bold">Bimbingan</h4>
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                                <span class="text-3xl">💬</span>
                            </div>
                        </div>
                        <p class="text-5xl font-bold mb-3">22</p>
                        <p class="text-purple-100 text-lg">Total sesi bimbingan completed</p>
                    </div>
                </div>
                
                <div class="glass-premium p-10 rounded-3xl border border-yellow-500/20">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-3xl font-bold text-gray-900 dark:text-white text-premium">Timeline Aktivitas</h4>
                        <button class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300 font-bold text-lg">
                            Lihat Semua
                        </button>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6 p-6 bg-white dark:bg-gray-900 rounded-2xl border border-yellow-500/10 hover:shadow-lg transition-premium">
                            <div class="w-4 h-4 bg-green-500 rounded-full shadow-lg"></div>
                            <div class="flex-1">
                                <span class="text-gray-900 dark:text-white font-bold text-lg">Bab 5 telah disubmit untuk review</span>
                                <p class="text-gray-500 dark:text-gray-400">File: "BAB_V_Kesimpulan_dan_Saran.pdf"</p>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400 font-medium">1 jam lalu</span>
                        </div>
                        <div class="flex items-center space-x-6 p-6 bg-white dark:bg-gray-900 rounded-2xl border border-yellow-500/10 hover:shadow-lg transition-premium">
                            <div class="w-4 h-4 bg-blue-500 rounded-full shadow-lg"></div>
                            <div class="flex-1">
                                <span class="text-gray-900 dark:text-white font-bold text-lg">Feedback dari Prof. Dr. Indra Budi</span>
                                <p class="text-gray-500 dark:text-gray-400">"Excellent work! Minor revisions needed on conclusion"</p>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400 font-medium">2 hari lalu</span>
                        </div>
                        <div class="flex items-center space-x-6 p-6 bg-white dark:bg-gray-900 rounded-2xl border border-yellow-500/10 hover:shadow-lg transition-premium">
                            <div class="w-4 h-4 bg-yellow-500 rounded-full shadow-lg"></div>
                            <div class="flex-1">
                                <span class="text-gray-900 dark:text-white font-bold text-lg">Jadwal sidang telah ditentukan</span>
                                <p class="text-gray-500 dark:text-gray-400">Senin, 25 Maret 2024 - 09:00 WIB - Ruang Sidang A</p>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400 font-medium">3 hari lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative overflow-hidden">
        <div class="gradient-primary py-32 transition-premium">
            <!-- Floating Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute top-1/4 right-1/4 w-80 h-80 bg-yellow-400/10 rounded-full blur-3xl float-elegant"></div>
                <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-orange-400/8 rounded-full blur-3xl float-elegant" style="animation-delay: -3s;"></div>
            </div>
            
            <div class="relative z-10 max-w-6xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <div class="glass-premium rounded-3xl p-16 md:p-20 shadow-premium border border-yellow-500/30">
                    <div class="mb-10">
                        <span class="inline-block px-8 py-3 glass-premium rounded-full text-sm font-bold text-white/90 mb-8 border border-yellow-500/40">
                            🚀 Bergabung dengan UI
                        </span>
                    </div>
                    
                    <h2 class="text-5xl md:text-7xl font-bold mb-10 text-white leading-tight text-premium">
                        Wujudkan <span class="text-gradient-primary">Excellence</span> Akademik Anda
                    </h2>
                    
                    <p class="text-2xl md:text-3xl mb-16 text-white/80 max-w-4xl mx-auto leading-relaxed">
                        Bergabunglah dengan ribuan mahasiswa UI yang telah merasakan transformasi digital dalam perjalanan akademik mereka
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-8 justify-center items-center mb-16">
                        <button class="group btn-primary text-slate-800 px-16 py-6 rounded-3xl font-bold text-2xl transition-premium shadow-premium">
                            <span class="flex items-center relative z-10">
                                🎯 Daftar Sekarang
                                <svg class="w-7 h-7 ml-3 group-hover:translate-x-1 transition-premium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </button>
                        <button class="group glass-premium text-white px-16 py-6 rounded-3xl font-bold text-2xl transition-premium border border-yellow-500/50 hover:border-yellow-500/70">
                            <span class="flex items-center">
                                🎬 Demo Gratis
                                <svg class="w-7 h-7 ml-3 group-hover:scale-110 transition-premium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">
                        <div>
                            <div class="text-4xl font-bold text-gradient-primary mb-2">2,500+</div>
                            <div class="text-white/70 font-medium">Mahasiswa UI</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-gradient-primary mb-2">99.9%</div>
                            <div class="text-white/70 font-medium">System Uptime</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-gradient-primary mb-2">24/7</div>
                            <div class="text-white/70 font-medium">Technical Support</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-gradient-primary mb-2">5★</div>
                            <div class="text-white/70 font-medium">User Rating</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-black text-white py-20 transition-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-16">
                <div class="col-span-2">
                    <div class="flex items-center mb-8">
                        <div class="w-16 h-16 icon-premium rounded-3xl flex items-center justify-center shadow-premium">
                            <span class="text-white font-bold text-3xl relative z-10">🎓</span>
                        </div>
                        <span class="ml-4 text-3xl font-bold text-gradient-primary text-premium">SkripsiBimbingan</span>
                    </div>
                    <p class="text-gray-300 mb-8 max-w-md text-xl leading-relaxed">
                        Platform bimbingan skripsi terdepan yang menghadirkan transformasi digital untuk excellence akademik Universitas Indonesia.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-14 h-14 glass-premium rounded-2xl flex items-center justify-center text-gray-300 hover:text-white hover:bg-yellow-600/20 transition-premium transform hover:scale-110 border border-yellow-500/20">
                            <span class="text-2xl">📧</span>
                        </a>
                        <a href="#" class="w-14 h-14 glass-premium rounded-2xl flex items-center justify-center text-gray-300 hover:text-white hover:bg-yellow-600/20 transition-premium transform hover:scale-110 border border-yellow-500/20">
                            <span class="text-2xl">📱</span>
                        </a>
                        <a href="#" class="w-14 h-14 glass-premium rounded-2xl flex items-center justify-center text-gray-300 hover:text-white hover:bg-yellow-600/20 transition-premium transform hover:scale-110 border border-yellow-500/20">
                            <span class="text-2xl">🌐</span>
                        </a>
                        <a href="#" class="w-14 h-14 glass-premium rounded-2xl flex items-center justify-center text-gray-300 hover:text-white hover:bg-yellow-600/20 transition-premium transform hover:scale-110 border border-yellow-500/20">
                            <span class="text-2xl">💼</span>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold mb-8 text-white text-premium">Fitur Utama</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">📋</span> Smart Proposal</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">🎥</span> Virtual Meeting</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">📊</span> Advanced Analytics</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">☁️</span> Cloud Documents</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">🤖</span> AI Assistant</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold mb-8 text-white text-premium">Support</h3>
                    <ul class="space-y-4 text-gray-300">
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">❓</span> Help Center</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">📖</span> Documentation</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">💡</span> FAQ</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">📞</span> Contact Support</a></li>
                        <li><a href="#" class="hover:text-yellow-400 transition-premium flex items-center text-lg"><span class="mr-3">🔒</span> Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 dark:border-gray-700 mt-16 pt-10">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-center md:text-left text-lg">&copy; 2024 SkripsiBimbingan - Universitas Indonesia. All rights reserved.</p>
                    <div class="flex items-center space-x-8 mt-6 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-premium text-lg">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-premium text-lg">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-yellow-400 transition-premium text-lg">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Dark mode functionality
        function initTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }

        function toggleTheme() {
            const isDark = document.documentElement.classList.contains('dark');
            
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                showNotification('Mode terang diaktifkan! ☀️', 'info');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                showNotification('Mode gelap diaktifkan! 🌙', 'info');
            }
        }

        // Initialize theme on page load
        initTheme();

        // Theme toggle event listeners
        document.getElementById('theme-toggle').addEventListener('click', toggleTheme);
        document.getElementById('theme-toggle-mobile').addEventListener('click', toggleTheme);

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.15)';
                navbar.style.backdropFilter = 'blur(40px) saturate(200%)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.1)';
                navbar.style.backdropFilter = 'blur(30px) saturate(180%)';
            }
        });

        // Enhanced button interactions
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Skip theme toggle buttons
                if (this.id === 'theme-toggle' || this.id === 'theme-toggle-mobile') {
                    return;
                }
                
                e.preventDefault();
                
                // Create enhanced ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 1000);
                
                // Enhanced button feedback
                const buttonText = this.textContent.trim();
                if (buttonText.includes('Mulai') || buttonText.includes('Daftar')) {
                    showNotification('🎉 Selamat datang di SkripsiBimbingan UI! Fitur pendaftaran akan segera tersedia.', 'success');
                } else if (buttonText.includes('Demo')) {
                    showNotification('🎬 Demo interaktif akan dimulai dalam mode preview. Fitur lengkap segera hadir!', 'info');
                } else if (buttonText.includes('Masuk')) {
                    showNotification('🔐 Sistem login terintegrasi dengan SSO UI akan segera tersedia.', 'info');
                } else if (buttonText.includes('Pelajari')) {
                    showNotification('📖 Dokumentasi lengkap fitur akan segera tersedia.', 'info');
                }
            });
        });

        // Enhanced notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const isDark = document.documentElement.classList.contains('dark');
            
            let bgColor, textColor, borderColor;
            switch(type) {
                case 'success':
                    bgColor = 'bg-green-500';
                    textColor = 'text-white';
                    borderColor = 'border-green-400';
                    break;
                case 'error':
                    bgColor = 'bg-red-500';
                    textColor = 'text-white';
                    borderColor = 'border-red-400';
                    break;
                default:
                    bgColor = 'bg-yellow-500';
                    textColor = 'text-slate-800';
                    borderColor = 'border-yellow-400';
            }
            
            notification.className = `fixed top-8 right-8 z-50 p-6 rounded-3xl shadow-premium transform translate-x-full transition-all duration-700 ${bgColor} ${textColor} ${borderColor} border-2 max-w-md backdrop-blur-sm`;
            notification.innerHTML = `
                <div class="flex items-start space-x-4">
                    <div class="flex-1 font-semibold text-lg leading-relaxed">${message}</div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-current opacity-70 hover:opacity-100 transition-opacity">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in with elegant animation
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
                notification.style.transform = 'translateX(0) scale(1.02)';
                setTimeout(() => {
                    notification.style.transform = 'translateX(0) scale(1)';
                }, 200);
            }, 100);
            
            // Auto remove after 6 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 700);
                }
            }, 6000);
        }

        // Enhanced CSS for animations and effects
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                transform: scale(0);
                animation: ripple-animation 1s cubic-bezier(0.4, 0, 0.2, 1);
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            button {
                position: relative;
                overflow: hidden;
            }
            
            /* Enhanced scroll animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }
            
            /* Smooth theme transitions */
            * {
                transition-property: background-color, border-color, color, fill, stroke, box-shadow;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 400ms;
            }
            
            /* Enhanced hover effects */
            .modern-card:hover {
                transform: translateY(-12px) scale(1.02);
            }
            
            .icon-premium:hover {
                transform: scale(1.1) rotate(5deg);
            }
        `;
        document.head.appendChild(style);

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.modern-card, .border-premium');
            animateElements.forEach(el => observer.observe(el));
        });

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                if (e.matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        });

        // Enhanced performance optimizations
        let ticking = false;
        function updateNavbar() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.15)';
                navbar.style.backdropFilter = 'blur(40px) saturate(200%)';
                navbar.style.borderBottom = '1px solid rgba(255, 215, 0, 0.2)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.1)';
                navbar.style.backdropFilter = 'blur(30px) saturate(180%)';
                navbar.style.borderBottom = '1px solid rgba(255, 215, 0, 0.1)';
            }
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        });
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'990b37a252a3410c',t:'MTc2MDgyMzg3MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
