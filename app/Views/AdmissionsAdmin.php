<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<div>
			<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Applicant Final Rankings</p>
			<p class="text-gray-600 mt-2">Review composite scores and make final scholarship determinations.</p>
        </div>
	</div>

	<!-- Debug/Error Messages -->
	<?php if (!empty($errors)): ?>
		<div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded">
			<h5 class="font-bold text-red-700 mb-2">⚠️ System Messages:</h5>
			<ul class="text-sm text-red-700 space-y-1">
				<?php foreach ($errors as $flag => $message): ?>
					<li>• <strong><?= $flag ?>:</strong> <?= $message ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

    <!-- Selection Overview -->
	<div class="mb-8 grid grid-cols-2 gap-6">
		<!-- Pass Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">PASS</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2"><?= $mahasiswaPassCount ?></p>
				</div>
				<div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
					<i class="bi bi-check-circle text-green-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600">students</p>
		</div>

		<!-- Did not qualify Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Did not qualify</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2"><?= $mahasiswaFailCount ?></p>
				</div>
				<div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
					<i class="bi bi-x-circle text-red-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600">students</p>
		</div>
	</div>

	<!-- Filters Section -->
	

	<!-- Table Section -->
	<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
		<div class="overflow-x-auto">
			<table class="w-full">
				<!-- Table Header -->
				<thead class="bg-gray-50 border-b border-gray-200">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STUDENT NAME</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">NIM</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">COMPOSITE SCORE</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STATUS</th>
					</tr>
				</thead>
				<?php if (!empty($mahasiswaList)): ?>
					<tbody class="divide-y divide-gray-200">
						<?php foreach ($mahasiswaList as $mahasiswa): ?>
							<tr class="hover:bg-gray-50 transition">
								<td class="px-6 py-4">
									<div class="flex items-center gap-3">
										<div class="w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center font-semibold text-[#6b3a9d]">
											<?= strtoupper(substr($mahasiswa['name'], 0, 1)) ?>
										</div>
										<div>
											<p class="font-semibold text-gray-900"><?= $mahasiswa['name'] ?></p>
										</div>
									</div>
								</td>
								<td class="px-6 py-4 text-gray-700"><?= $mahasiswa['NIM'] ?? '-' ?></td>
								<td class="px-6 py-4">
									<div class="flex items-center gap-2">
										<span class="text-2xl font-bold text-[#6b3a9d]"><?= $mahasiswa['finalScore'] ?? 'N/A' ?></span>
									</div>
								</td>
								<td class="px-6 py-4">
									<div class="flex items-center gap-2">
										<?php 
											$statusClass = ($mahasiswa['resultStatus'] ?? 'fail') === 'pass' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
											$statusText = ($mahasiswa['resultStatus'] ?? 'fail') === 'pass' ? 'Approved' : 'Rejected';
										?>
										<button class="px-3 py-1.5 <?= $statusClass ?> text-xs font-semibold rounded-lg transition">
											<?= $statusText ?>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				<?php else: ?>
					<tbody>
						<tr>
							<td colspan="4" class="px-6 py-8 text-center text-gray-500">No students to display</td>
						</tr>
					</tbody>
				<?php endif; ?>
			</table>
		</div>

		<!-- Pagination -->
		<div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between flex-wrap gap-4">
			<p class="text-sm text-gray-600">
				Showing <span class="font-semibold"><?= ($startIndex + 1) ?></span>-<span class="font-semibold"><?= min($startIndex + count($mahasiswaList), $mahasiswaCount) ?></span> 
				of <span class="font-semibold"><?= $mahasiswaCount ?> applicants</span>
			</p>
			<div class="flex items-center gap-2">
				<!-- Previous Button -->
				<a href="<?= $currentPage > 1 ? '?page=' . ($currentPage - 1) : '#' ?>" 
					class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-[#6b3a9d] transition rounded <?= $currentPage <= 1 ? 'cursor-not-allowed opacity-50' : '' ?>">
					<i class="bi bi-chevron-left"></i>
				</a>

				<!-- Page Numbers -->
				<?php 
					// Tentukan range halaman yang ditampilkan
					$startPage = max(1, $currentPage - 2);
					$endPage = min($totalPages, $currentPage + 2);
					
					// Tampilkan ellipsis jika ada halaman sebelumnya
					if ($startPage > 1): ?>
						<button class="w-8 h-8 flex items-center justify-center text-gray-700 rounded">1</button>
						<?php if ($startPage > 2): ?>
							<span class="text-gray-400">...</span>
						<?php endif; ?>
					<?php endif; ?>

					<?php for ($i = $startPage; $i <= $endPage; $i++): ?>
						<?php if ($i == $currentPage): ?>
							<button class="w-8 h-8 flex items-center justify-center bg-[#6b3a9d] text-white font-semibold rounded">
								<?= $i ?>
							</button>
						<?php else: ?>
							<a href="?page=<?= $i ?>" class="w-8 h-8 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition rounded font-semibold">
								<?= $i ?>
							</a>
						<?php endif; ?>
					<?php endfor; ?>

					<!-- Tampilkan ellipsis jika ada halaman sesudahnya -->
					<?php if ($endPage < $totalPages): ?>
						<?php if ($endPage < $totalPages - 1): ?>
							<span class="text-gray-400">...</span>
						<?php endif; ?>
						<a href="?page=<?= $totalPages ?>" class="w-8 h-8 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition rounded">
							<?= $totalPages ?>
						</a>
					<?php endif; ?>
				
				<!-- Next Button -->
				<a href="<?= $currentPage < $totalPages ? '?page=' . ($currentPage + 1) : '#' ?>" 
					class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-[#6b3a9d] transition rounded <?= $currentPage >= $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>">
					<i class="bi bi-chevron-right"></i>
				</a>
			</div>
		</div>
	</div>

	
</div>

<?= $this->endSection() ?>