<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<div>
			<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Criteria List</p>
			<p class="text-gray-600 mt-2">Manage and view all evaluation criteria with their weights and types.</p>
        </div>
	</div>

	<!-- Summary Cards -->
	<div class="mb-8 grid grid-cols-3 gap-6">
		<!-- Total Criteria Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">TOTAL CRITERIA</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2"><?= $totalCriteria ?></p>
				</div>
				<div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
					<i class="bi bi-list-check text-blue-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600">active criteria</p>
		</div>

		<!-- Total Weight Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">TOTAL WEIGHT</p>
					<p class="text-3xl font-bold text-[#6b3a9d] mt-2"><?= number_format($totalWeight * 100, 0) ?>%</p>
				</div>
				<div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
					<i class="bi bi-percent text-purple-600 text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600"><?= $totalWeight == 1.0 ? 'Balanced' : 'Needs adjustment' ?></p>
		</div>

		<!-- Weight Status Card -->
		<div class="bg-white rounded-xl p-6 border border-gray-200">
			<div class="flex items-start justify-between mb-4">
				<div>
					<p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">STATUS</p>
					<?php if ($totalWeight == 1.0): ?>
						<p class="text-3xl font-bold text-green-600 mt-2">✓ OK</p>
					<?php else: ?>
						<p class="text-3xl font-bold text-red-600 mt-2">⚠ Alert</p>
					<?php endif; ?>
				</div>
				<div class="w-12 h-12 <?= $totalWeight == 1.0 ? 'bg-green-100' : 'bg-red-100' ?> rounded-full flex items-center justify-center">
					<i class="bi <?= $totalWeight == 1.0 ? 'bi-check-circle text-green-600' : 'bi-exclamation-circle text-red-600' ?> text-xl"></i>
				</div>
			</div>
			<p class="text-sm text-gray-600"><?= $totalWeight == 1.0 ? 'All weights valid' : 'Total weight invalid' ?></p>
		</div>
	</div>

	<!-- Criteria Table -->
	<div class="bg-white rounded-xl mb-8 border border-gray-200 overflow-hidden">
		<div class="overflow-x-auto">
			<table class="w-full" style="table-layout: fixed;">
				<!-- Table Header -->
				<thead class="bg-gray-50 border-b border-gray-200">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 10%;">CODE</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 20%;">CRITERIA NAME</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 15%;">TYPE</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 30%;">WEIGHT</th>
						<th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase" style="width: 10%;">ACTIONS</th>
					</tr>
				</thead>
				<?php if (!empty($criteriaList)): ?>
					<tbody class="divide-y divide-gray-200">
						<?php foreach ($criteriaList as $criteria): ?>
							<tr class="hover:bg-gray-50 transition">
								<!-- Code -->
								<td class="px-6 py-4 truncate">
									<div class="flex items-center gap-2">
										<span class="inline-flex items-center justify-center w-8 h-8 bg-[#6b3a9d]/10 text-[#6b3a9d] text-xs font-bold rounded">
											<?= $criteria['criteriaCode'] ?>
										</span>
									</div>
								</td>

								<!-- Criteria Name -->
								<td class="px-6 py-4 truncate">
									<p class="font-semibold text-gray-900 truncate"><?= htmlspecialchars($criteria['criteriaName']) ?></p>
								</td>

								<!-- Type -->
								<td class="px-6 py-4 truncate">
									<div class="flex items-center gap-2">
										<?php if ($criteria['criteriaType'] === 'benefit'): ?>
											<span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full whitespace-nowrap">
												Benefit
											</span>
										<?php else: ?>
											<span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full whitespace-nowrap">
												Cost
											</span>
										<?php endif; ?>
									</div>
								</td>

								<!-- Weight -->
								<td class="px-6 py-4">
									<div class="flex items-center gap-3">
										<div class="flex-1 bg-gray-200 rounded-full h-2 min-w-0">
											<div class="bg-[#6b3a9d] h-2 rounded-full" style="width: <?= ($criteria['criteriaWeight'] * 100) ?>%"></div>
										</div>
										<span class="text-sm font-semibold text-gray-700 w-12 text-right flex-shrink-0">
											<?= number_format($criteria['criteriaWeight'] * 100, 1) ?>%
										</span>
									</div>
								</td>

								<!-- Actions -->
								<td class="px-6 py-4">
									<div class="flex items-center justify-center">
										<button class="delete-btn px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg transition hover:bg-red-700 hover:shadow-lg whitespace-nowrap" 
											type="button"
											title="Delete criteria"
											data-id="<?= htmlspecialchars($criteria['idCriteria']) ?>"
											data-name="<?= htmlspecialchars($criteria['criteriaName']) ?>">
											<i class="bi bi-trash"></i>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				<?php else: ?>
					<tbody>
						<tr>
							<td colspan="5" class="px-6 py-8 text-center text-gray-500">No criteria found</td>
						</tr>
					</tbody>
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>


<!-- View Details Modal -->
<div id="detailsModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">
	<div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-2xl">
		<!-- Modal Header -->
		<div class="mb-6">
			<h2 class="text-2xl font-bold text-gray-900">Criteria Details</h2>
			<p class="text-sm text-gray-600 mt-1">Full information about <span id="detailName" class="font-semibold text-[#6b3a9d]"></span></p>
		</div>

		<!-- Modal Content -->
		<div class="space-y-4 mb-6">
			<!-- Code & Name -->
			<div class="grid grid-cols-2 gap-4">
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-1">Code</label>
					<p id="detailCode" class="text-lg font-bold text-[#6b3a9d]"></p>
				</div>
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-1">Criteria Name</label>
					<p id="detailNameFull" class="text-lg font-semibold text-gray-900"></p>
				</div>
			</div>

			<!-- Type & Weight -->
			<div class="grid grid-cols-2 gap-4">
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
					<p id="detailType" class="text-sm font-semibold"></p>
				</div>
				<div>
					<label class="block text-sm font-semibold text-gray-700 mb-1">Weight</label>
					<p id="detailWeight" class="text-lg font-bold text-[#6b3a9d]"></p>
				</div>
			</div>

			<!-- Description -->
			<div>
				<label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
				<div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
					<p id="detailDescription" class="text-sm text-gray-700 leading-relaxed"></p>
				</div>
			</div>
		</div>

		<!-- Modal Actions -->
		<div class="flex gap-3">
			<button type="button" id="closeDetailsBtn" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
				Close
			</button>
		</div>
	</div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">
	<div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
		<div class="mb-6">
			<h2 class="text-2xl font-bold text-gray-900">Delete Criteria</h2>
			<p class="text-sm text-gray-600 mt-1">Are you sure you want to delete <span id="deleteCriteriaName" class="font-semibold text-red-600"></span>?</p>
		</div>

		<div class="p-4 bg-red-50 rounded-lg border border-red-200 mb-6">
			<p class="text-sm text-red-700">⚠️ This action cannot be undone. All associated assessments will also be affected.</p>
		</div>

		<div class="flex gap-3">
			<button type="button" id="cancelDeleteBtn" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
				Cancel
			</button>
			<button type="button" id="confirmDeleteBtn" class="flex-1 px-4 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition flex items-center justify-center gap-2">
				<i class="bi bi-trash"></i>
				<span>Delete</span>
			</button>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Elements
	const viewBtns = document.querySelectorAll('.view-btn');
	const deleteBtns = document.querySelectorAll('.delete-btn');
	const detailsModal = document.getElementById('detailsModal');
	const deleteModal = document.getElementById('deleteModal');
	const closeDetailsBtn = document.getElementById('closeDetailsBtn');
	const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
	const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

	let currentCriteriaId = null;

	// View button click
	viewBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			const id = this.getAttribute('data-id');
			const name = this.getAttribute('data-name');
			const description = this.getAttribute('data-description') || 'No description available';
			const type = this.getAttribute('data-type');
			const weight = parseFloat(this.getAttribute('data-weight'));

			// Populate modal
			document.getElementById('detailName').textContent = name;
			document.getElementById('detailCode').textContent = 'C' + (Array.from(viewBtns).indexOf(this) + 1);
			document.getElementById('detailNameFull').textContent = name;
			document.getElementById('detailDescription').textContent = description || 'No description available';
			document.getElementById('detailWeight').textContent = (weight * 100).toFixed(1) + '%';

			if (type === 'benefit') {
				document.getElementById('detailType').innerHTML = '<span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">📈 Benefit</span>';
			} else {
				document.getElementById('detailType').innerHTML = '<span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">📉 Cost</span>';
			}

			detailsModal.classList.remove('hidden');
		});
	});

	// Delete button click
	deleteBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			currentCriteriaId = this.getAttribute('data-id');
			const name = this.getAttribute('data-name');
			document.getElementById('deleteCriteriaName').textContent = name;
			deleteModal.classList.remove('hidden');
		});
	});

	// Close details modal
	closeDetailsBtn.addEventListener('click', function() {
		detailsModal.classList.add('hidden');
	});

	// Cancel delete
	cancelDeleteBtn.addEventListener('click', function() {
		deleteModal.classList.add('hidden');
		currentCriteriaId = null;
	});

	// Confirm delete
	confirmDeleteBtn.addEventListener('click', function() {
		if (!currentCriteriaId) return;

		confirmDeleteBtn.disabled = true;

		fetch('/admin/criteria-list/delete/' + currentCriteriaId, {
			method: 'POST',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			}
		})
		.then(response => response.json())
		.then(data => {
			confirmDeleteBtn.disabled = false;

			if (data.success) {
				deleteModal.classList.add('hidden');
				setTimeout(() => {
					location.reload();
				}, 1000);
			} else {
				alert('Error: ' + data.message);
			}
		})
		.catch(error => {
			confirmDeleteBtn.disabled = false;
			console.error('Error:', error);
			alert('An error occurred. Please try again.');
		});
	});

	// Close modals on background click
	detailsModal.addEventListener('click', function(e) {
		if (e.target === detailsModal) {
			detailsModal.classList.add('hidden');
		}
	});

	deleteModal.addEventListener('click', function(e) {
		if (e.target === deleteModal) {
			deleteModal.classList.add('hidden');
			currentCriteriaId = null;
		}
	});

	// Close on ESC key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape') {
			detailsModal.classList.add('hidden');
			deleteModal.classList.add('hidden');
		}
	});
});
</script>

<?= $this->endSection() ?>
