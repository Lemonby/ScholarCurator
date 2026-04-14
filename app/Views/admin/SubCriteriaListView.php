<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<div class="p-8 bg-gray-50 min-h-screen">
	<!-- Header -->
	<div class="mb-8">
		<div>
			<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Sub Criteria List</p>
			<p class="text-gray-600 mt-2">Manage and view all evaluation criteria with their weights and types.</p>
        </div>
	</div>

    <!-- Subcriteria Table -->
    <?php if (!empty($subCriteriaList)): ?>
		<?php 
			// Group subcriteria by criteria name
			$groupedSubcriteria = [];
			foreach ($subCriteriaList as $sub) {
				$criteriaName = $sub['criteriaName'] ?? 'N/A';
				if (!isset($groupedSubcriteria[$criteriaName])) {
					$groupedSubcriteria[$criteriaName] = [];
				}
				$groupedSubcriteria[$criteriaName][] = $sub;
			}
		?>
		<?php foreach ($groupedSubcriteria as $criteriaName => $subcriteriaGroup): ?>
			<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mt-9 mb-4">
				<div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
					<h3 class="text-lg font-bold text-gray-900">Sub Criteria <?= htmlspecialchars($criteriaName) ?></h3>
				</div>
				<div class="overflow-x-auto">
					<table class="w-full table-layout-fixed" style="table-layout: fixed;">
						<!-- Table Header -->
						<thead class="bg-gray-50 border-b border-gray-200">
							<tr>
								<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 10%;">SUB ID</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 20%;">SUB NAME</th>
								<th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase" style="width: 25%;">VARIABLE VALUE</th>
								<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="width: 30%;">COMMENT</th>
								<th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase" style="width: 10%;">ACTIONS</th>
							</tr>
						</thead>
						<tbody class="divide-y divide-gray-200">
							<?php foreach ($subcriteriaGroup as $subcriteria): ?>
								<tr class="hover:bg-gray-50 transition">
									<!-- Sub ID -->
									<td class="px-6 py-4 w-1/6 truncate">
										<span class="inline-flex items-center justify-center w-8 h-8 bg-[#6b3a9d]/10 text-[#6b3a9d] text-xs font-bold rounded">
											<?= $subcriteria['subCriteriaCode'] ?>
										</span>
									</td>

									<!-- Sub Name -->
									<td class="px-6 py-4 truncate">
										<p class="text-gray-700 truncate"><?= htmlspecialchars($subcriteria['subName']) ?></p>
									</td>

									<!-- Variable Value -->
									<td class="px-6 py-4 truncate">
										<p class="text-sm text-gray-600 font-mono text-center"><?= htmlspecialchars($subcriteria['variableValue']) ?></p>
									</td>

									<!-- Comment -->
									<td class="px-6 py-4 truncate">
										<p class="text-sm text-gray-600 truncate" title="<?= htmlspecialchars($subcriteria['comment'] ?? '-') ?>"><?= htmlspecialchars(substr($subcriteria['comment'] ?? '-', 0, 50)) ?><?= strlen($subcriteria['comment'] ?? '') > 50 ? '...' : '' ?></p>
									</td>

									<!-- Actions -->
									<td class="px-6 py-4">
										<div class="flex items-center justify-center">
											<button class="delete-sub-btn px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg transition hover:bg-red-700 hover:shadow-lg whitespace-nowrap" 
												type="button"
												title="Delete subcriteria"
												data-id="<?= htmlspecialchars($subcriteria['subCriteriaCode']) ?>">
												<i class="bi bi-trash"></i>
											</button>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mt-9 p-8 text-center text-gray-500">
			No subcriteria found
		</div>
	<?php endif; ?>
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
