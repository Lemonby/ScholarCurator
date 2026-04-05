<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ScholarCurator | Admin Dashboard</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="m-0 p-0 bg-gray-50">

    <div class="flex h-screen bg-gradient-to-b from-[#f6f1f8] to-[#f1ecf5]">
        
        <!-- SIDEBAR -->
        <aside class="w-64 h-screen flex flex-col border-r border-[#dcd0e4] bg-gradient-to-b from-[#f0eaf5] to-[#eae1f0] p-5 overflow-y-auto shadow-xl">
            <!-- Logo -->
            <div>
					<p class="text-[22px] font-extrabold leading-none tracking-[-0.03em] text-transparent bg-clip-text bg-gradient-to-r from-[#4f2782] to-[#6b3a9d]">ScholarCurator</p>
				</div>

            <!-- Branding Card -->
            <div class="mt-7 rounded-2xl bg-gradient-to-br from-[#e7dff0] via-[#ede5f8] to-[#e0d8eb] p-4 text-[#4e2d79] shadow-lg border border-white/50">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#7f679e]">Scholarship portal</p>
                <p class="mt-2 text-[24px] font-extrabold leading-[0.95]">Aaademia<br>Curator</p>
            </div>

            <!-- Menu Items -->
            <nav class="mt-6 space-y-2 text-[14px] font-medium text-[#5e4d74]">
                <?php $currentUri = uri_string(); ?>

                <a 
                    href="<?= base_url('/dashboard-admin') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'dashboard') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-speedometer2 flex-shrink-0 text-lg"></i>
                    <span class="truncate">Dashboard</span>
                </a>

                <a 
                    href="<?= base_url('/opportunities') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'katalog') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-book flex-shrink-0 text-lg"></i>
                    <span class="truncate">Opportunities</span>
                </a>

                <a 
                    href="<?= base_url('/my-applications') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'peminjamanku') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-bookmark flex-shrink-0 text-lg"></i>
                    <span class="truncate">My Applications</span>
                </a>

                <a 
                    href="<?= base_url('/messages') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'reservasi') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-calendar-check flex-shrink-0 text-lg"></i>
                    <span class="truncate">Messages</span>
                </a>

                <a 
                    href="<?= base_url('/pengaturan') ?>" 
                    class="flex items-center gap-3 rounded-xl px-3 py-3 transition duration-200 <?= strpos($currentUri, 'pengaturan') !== false ? 'bg-white text-[#4f2782] shadow-md' : 'hover:bg-white hover:shadow-md hover:text-[#4f2782]' ?>"
                >
                    <i class="bi bi-gear flex-shrink-0 text-lg"></i>
                    <span class="truncate">Pengaturan</span>
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
                    <a class="flex items-center gap-2.5 transition duration-200 hover:text-[#4f2782] hover:scale-110 hover:translate-x-1" href="<?= site_url('logout') ?>">
                        <i class="bi bi-box-arrow-left flex-shrink-0 text-lg"></i>
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-auto bg-gray-50">

            <?= $this->renderSection('content') ?>
            
        </main>
    </div>
</body>
</html>