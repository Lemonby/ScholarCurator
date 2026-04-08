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
	<div class="bg-white rounded-xl border border-gray-200" style="overflow: visible !important;">
		<div class="overflow-x-auto">
			<table class="w-full">
				<!-- Table Header -->
				<thead class="bg-gray-50 border-b border-gray-200">
					<tr>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STUDENT NAME</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">NIM</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">COMPOSITE SCORE</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">STATUS</th>
						<th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase" style="min-width: 180px;">ACTIONS</th>
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
								<td class="px-6 py-4" style="overflow: visible !important;">
									<div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
										<button class="edit-btn" type="button"
											style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; background-color: rgb(79, 70, 229); color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; border: none; cursor: pointer; z-index: 10; position: relative;"
											title="Edit applicant"
											data-nim="<?= htmlspecialchars($mahasiswa['NIM'] ?? '') ?>"
											data-name="<?= htmlspecialchars($mahasiswa['name'] ?? '') ?>"
											data-email="<?= htmlspecialchars($mahasiswa['email'] ?? '') ?>"
											data-major="<?= htmlspecialchars($mahasiswa['major'] ?? '') ?>">
											<i class="bi bi-pencil-square"></i><span>Edit</span>
										</button>
										<button class="delete-btn" type="button"
											style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; background-color: rgb(220, 38, 38); color: white; font-size: 0.75rem; font-weight: 600; border-radius: 0.5rem; border: none; cursor: pointer; z-index: 10; position: relative;"
											title="Delete applicant"
											data-nim="<?= htmlspecialchars($mahasiswa['NIM'] ?? '') ?>"
											data-name="<?= htmlspecialchars($mahasiswa['name'] ?? '') ?>">
											<i class="bi bi-trash"></i><span>Delete</span>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				<?php else: ?>
					<tbody>
						<tr>
							<td colspan="5" class="px-6 py-8 text-center text-gray-500">No students to display</td>
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

<!-- CRUD Modal -->
<div id="crudModal" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-black/20 backdrop-blur-sm">
	<div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
		<!-- Modal Header -->
		<div class="mb-6" id="modalHeader">
			<h2 class="text-2xl font-bold text-gray-900">Edit Student Data</h2>
			<p class="text-sm text-gray-600 mt-1">Update information for <span id="modalStudentName" class="font-semibold text-[#6b3a9d]"></span></p>
		</div>

		<!-- Alert Messages -->
		<div id="modalErrorAlert" class="hidden mb-4 p-4 bg-red-50 rounded-lg border border-red-200">
			<p class="text-sm text-red-700" id="modalErrorText"></p>
		</div>
		<div id="modalSuccessAlert" class="hidden mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
			<p class="text-sm text-green-700" id="modalSuccessText"></p>
		</div>

		<!-- Modal Form -->
		<form id="crudForm" class="space-y-4">
			<input type="hidden" id="modalMode" value="edit">
			<input type="hidden" id="modalNIM" value="">

			<!-- Full Name -->
			<div id="nameFieldContainer" class="hidden">
				<label for="modalName" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
				<input type="text" id="modalName" placeholder="Enter full name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent outline-none transition">
			</div>

			<!-- Email -->
			<div id="emailFieldContainer" class="hidden">
				<label for="modalEmail" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
				<input type="email" id="modalEmail" placeholder="Enter email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent outline-none transition">
			</div>

			<!-- Major -->
			<div id="majorFieldContainer" class="hidden">
				<label for="modalMajor" class="block text-sm font-semibold text-gray-700 mb-1">Major</label>
				<input type="text" id="modalMajor" placeholder="Enter major" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6b3a9d] focus:border-transparent outline-none transition">
			</div>

			<!-- Delete Confirmation -->
			<div id="deleteConfirmContainer" class="hidden p-4 bg-red-50 rounded-lg border border-red-200">
				<p class="text-sm text-red-700">Are you sure you want to delete <strong id="deleteConfirmName"></strong>? This action cannot be undone.</p>
			</div>

			<!-- Modal Actions -->
			<div class="flex gap-3 pt-6">
				<button type="button" id="cancelModalBtn" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition">
					Cancel
				</button>
				<button type="submit" id="submitModalBtn" class="flex-1 px-4 py-2.5 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a3080] transition flex items-center justify-center gap-2">
					<span id="submitBtnText">Save Changes</span>
					<span id="submitBtnSpinner" style="display: none;" class="animate-spin">⟳</span>
				</button>
			</div>
		</form>
	</div>
</div>

<script>
// Debug: Log button visibility
document.addEventListener('DOMContentLoaded', function() {
	console.log('DOM Loaded - Checking buttons');
	const editBtns = document.querySelectorAll('.edit-btn');
	const deleteBtns = document.querySelectorAll('.delete-btn');
	console.log('Edit buttons found:', editBtns.length);
	console.log('Delete buttons found:', deleteBtns.length);
	
	const modal = document.getElementById('crudModal');
	const cancelBtn = document.getElementById('cancelModalBtn');
	const form = document.getElementById('crudForm');
	const submitBtn = document.getElementById('submitModalBtn');
	const errorAlert = document.getElementById('modalErrorAlert');
	const errorText = document.getElementById('modalErrorText');
	const successAlert = document.getElementById('modalSuccessAlert');
	const successText = document.getElementById('modalSuccessText');

	// Open edit modal
	editBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const nim = this.getAttribute('data-nim');
			const name = this.getAttribute('data-name');
			const email = this.getAttribute('data-email');
			const major = this.getAttribute('data-major');

			openEditModal(nim, name, email, major);
		});
	});

	// Open delete modal
	deleteBtns.forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const nim = this.getAttribute('data-nim');
			const name = this.getAttribute('data-name');

			openDeleteModal(nim, name);
		});
	});

	function openEditModal(nim, name, email, major) {
		document.getElementById('modalMode').value = 'edit';
		document.getElementById('modalNIM').value = nim;
		document.getElementById('modalStudentName').textContent = name;
		
		// Show edit fields
		document.getElementById('nameFieldContainer').classList.remove('hidden');
		document.getElementById('emailFieldContainer').classList.remove('hidden');
		document.getElementById('majorFieldContainer').classList.remove('hidden');
		document.getElementById('deleteConfirmContainer').classList.add('hidden');

		// Fill form values
		document.getElementById('modalName').value = name;
		document.getElementById('modalEmail').value = email;
		document.getElementById('modalMajor').value = major;

		// Update header and button
		document.querySelector('#modalHeader h2').textContent = 'Edit Student Data';
		document.getElementById('submitBtnText').textContent = 'Save Changes';

		resetAlerts();
		modal.classList.remove('hidden');
		document.getElementById('modalName').focus();
	}

	function openDeleteModal(nim, name) {
		document.getElementById('modalMode').value = 'delete';
		document.getElementById('modalNIM').value = nim;
		document.getElementById('modalStudentName').textContent = name;
		document.getElementById('deleteConfirmName').textContent = name;

		// Hide edit fields
		document.getElementById('nameFieldContainer').classList.add('hidden');
		document.getElementById('emailFieldContainer').classList.add('hidden');
		document.getElementById('majorFieldContainer').classList.add('hidden');
		document.getElementById('deleteConfirmContainer').classList.remove('hidden');

		// Update header and button
		document.querySelector('#modalHeader h2').textContent = 'Delete Student';
		document.getElementById('submitBtnText').textContent = 'Delete Student';
		submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
		submitBtn.classList.remove('bg-[#6b3a9d]', 'hover:bg-[#5a3080]');

		resetAlerts();
		modal.classList.remove('hidden');
	}

	function resetAlerts() {
		errorAlert.classList.add('hidden');
		successAlert.classList.add('hidden');
	}

	// Close modal
	cancelBtn.addEventListener('click', function() {
		modal.classList.add('hidden');
		form.reset();
		resetAlerts();
		submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
		submitBtn.classList.add('bg-[#6b3a9d]', 'hover:bg-[#5a3080]');
	});

	// Close on background click
	modal.addEventListener('click', function(e) {
		if (e.target === modal) {
			modal.classList.add('hidden');
			form.reset();
			resetAlerts();
			submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
			submitBtn.classList.add('bg-[#6b3a9d]', 'hover:bg-[#5a3080]');
		}
	});

	// Handle form submission
	form.addEventListener('submit', function(e) {
		e.preventDefault();

		const mode = document.getElementById('modalMode').value;
		const nim = document.getElementById('modalNIM').value;
		const name = document.getElementById('modalName').value;
		const email = document.getElementById('modalEmail').value;
		const major = document.getElementById('modalMajor').value;

		resetAlerts();

		if (mode === 'edit') {
			if (!name || !email || !major) {
				showError('All fields are required');
				return;
			}
			submitEdit(nim, name, email, major);
		} else if (mode === 'delete') {
			submitDelete(nim);
		}
	});

	function submitEdit(nim, name, email, major) {
		submitBtn.disabled = true;
		document.getElementById('submitBtnSpinner').style.display = 'inline-block';

		fetch('/admin/admissions/update', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-Requested-With': 'XMLHttpRequest'
			},
			body: JSON.stringify({
				nim: nim,
				name: name,
				email: email,
				major: major
			})
		})
		.then(response => response.json())
		.then(data => {
			submitBtn.disabled = false;
			document.getElementById('submitBtnSpinner').style.display = 'none';

			if (data.success) {
				showSuccess('Student data updated successfully');
				setTimeout(() => {
					location.reload();
				}, 1500);
			} else {
				showError(data.message || 'Failed to update student data');
			}
		})
		.catch(error => {
			submitBtn.disabled = false;
			document.getElementById('submitBtnSpinner').style.display = 'none';
			console.error('Error:', error);
			showError('An error occurred while saving. Please try again.');
		});
	}

	function submitDelete(nim) {
		submitBtn.disabled = true;
		document.getElementById('submitBtnSpinner').style.display = 'inline-block';

		fetch('/admin/admissions/delete', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-Requested-With': 'XMLHttpRequest'
			},
			body: JSON.stringify({
				nim: nim
			})
		})
		.then(response => response.json())
		.then(data => {
			submitBtn.disabled = false;
			document.getElementById('submitBtnSpinner').style.display = 'none';

			if (data.success) {
				showSuccess('Student deleted successfully');
				setTimeout(() => {
					location.reload();
				}, 1500);
			} else {
				showError(data.message || 'Failed to delete student');
			}
		})
		.catch(error => {
			submitBtn.disabled = false;
			document.getElementById('submitBtnSpinner').style.display = 'none';
			console.error('Error:', error);
			showError('An error occurred while deleting. Please try again.');
		});
	}

	function showError(message) {
		errorText.textContent = message;
		errorAlert.classList.remove('hidden');
	}

	function showSuccess(message) {
		successText.textContent = message;
		successAlert.classList.remove('hidden');
	}

	// Close on ESC key
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
			modal.classList.add('hidden');
			form.reset();
			resetAlerts();
		}
	});
});
</script>

<?= $this->endSection() ?>