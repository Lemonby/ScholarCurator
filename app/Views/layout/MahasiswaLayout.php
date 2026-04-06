<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ScholarCurator | Admin Dashboard</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="m-0 p-0 bg-gray-50">

    <div class="flex h-screen bg-gradient-to-b from-[#f6f1f8] to-[#f1ecf5]">
        
        <!-- SIDEBAR -->
        <aside class="w-64 h-screen flex flex-col border-r border-[#dcd0e4] bg-gradient-to-b from-[#f0eaf5] to-[#eae1f0] overflow-y-auto p-6">
            <!-- Branding Card -->
            <div class="rounded-2xl bg-gradient-to-br from-[#e7dff0] via-[#ede5f8] to-[#e0d8eb] p-4 text-[#4e2d79] shadow-lg border border-white/50">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#7f679e]">Scholarship portal</p>
                <p class="mt-2 text-[24px] font-extrabold leading-[0.95]">Aaademia<br>Curator</p>
            </div>

            <!-- Menu Items -->
            <nav class="mt-6 space-y-2 text-[14px] font-medium text-[#5e4d74]">
                <?php $currentUri = uri_string(); ?>

                <a 
                    href="<?= base_url('/mahasiswa/dashboard') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'dashboard') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-speedometer2 flex-shrink-0 text-lg"></i>
                    <span class="truncate">Dashboard</span>
                </a>

                <a 
                    href="<?= base_url('/mahasiswa/apply') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'apply') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-book flex-shrink-0 text-lg"></i>
                    <span class="truncate">Apply for Scholarship</span>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="mt-auto pt-8">
                <button class="w-full rounded-xl bg-gradient-to-r from-[#5f2394] to-[#7b379d] px-4 py-3 text-sm font-bold text-white transition duration-200 hover:shadow-lg hover:scale-105 active:scale-95 shadow-md" type="button">+ Apply Now</button>
                <div class="mt-6 space-y-4 text-[14px] text-[#66577b]">
                    <a class="flex items-center gap-2.5 transition duration-200 hover:text-[#4f2782] hover:scale-110 hover:translate-x-1" href="#help">
                        <i class="bi bi-question-circle flex-shrink-0 text-lg"></i>
                        Help Center
                    </a>
                    <a class="flex items-center gap-2.5 transition duration-200 hover:text-red-500 hover:scale-110 hover:translate-x-1" href="<?= site_url('logout') ?>">
                        <i class="bi bi-box-arrow-left flex-shrink-0 text-lg"></i>
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-auto bg-gray-50">
            <div class="flex items-center justify-between gap-4 bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                <div class="flex items-center gap-4">
                    <!-- search bar -->
                    <div class="relative">
                        <input type="text" placeholder="Search data..." class="w-64 rounded-full border border-gray-300 bg-gray-50 py-2 pl-10 pr-4 text-sm focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/50 focus:outline-none transition duration-200">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Notification Bell -->
                    <button class="relative p-2.5 text-[#6b3a9d] bg-purple-100/50 hover:bg-[#6b3a9d]/10 rounded-lg transition duration-200 group">
                        <i class="bi bi-bell text-lg"></i>
                        <span class="absolute top-0.5 right-0.5 w-2.5 h-2.5 bg-red-500 rounded-full animate-pulse"></span>
                    </button>

                    <!-- Settings Icon -->
                    <button class="p-2.5 text-[#6b3a9d] bg-purple-100/50 hover:bg-[#6b3a9d]/10 rounded-lg transition duration-200 group">
                        <i class="bi bi-gear text-lg"></i>
                    </button>

                    <!-- Profile User -->
                    <button class="flex items-center gap-2 p-2 pl-3 text-[#6b3a9d] bg-gradient-to-r from-[#6b3a9d]/10 to-[#4f2782]/10 hover:from-[#6b3a9d]/20 hover:to-[#4f2782]/20 rounded-lg transition duration-200 group">
                        <i class="bi bi-person-circle text-lg"></i>
                        <span class="text-sm font-medium">Profile</span>
                    </button>
                </div>
            </div>

            <?= $this->renderSection('content') ?>
            
        </main>
    </div>
</body>
</html>