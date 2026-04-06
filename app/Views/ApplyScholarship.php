<?= $this->extend('layout/MahasiswaLayout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-gray-50 p-8">

		<!-- Header -->
	<!-- <div class="mb-8">
		<p class="text-3xl font-bold text-[#6b3a9d] mt-2">Criteria & Weighting </p>
		<p class="text-gray-600 mt-4 max-w-2xl">Define how applications are evaluated by assigning relative importance to each qualifying factor.</p>
	</div> -->

    	<div class="max-w-8xl">
		<!-- Progress Steps -->
		<div class="mb-12">
			<div class="flex items-center justify-between">
				<!-- Step 1 -->
				<div class="flex flex-col items-center flex-1">
					<div class="w-12 h-12 rounded-full bg-[#6b3a9d] text-white flex items-center justify-center font-bold mb-3 relative z-10">
						1
					</div>
					<span class="text-sm font-semibold text-gray-900">GPA</span>
				</div>

				<!-- Connector Line 1 -->
				<div class="flex-1 h-1 bg-gray-300 -mx-4 mb-6"></div>

				<!-- Step 2 -->
				<div class="flex flex-col items-center flex-1">
					<div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold mb-3 relative z-10">
						2
					</div>
					<span class="text-sm font-semibold text-gray-600">Parent Income</span>
				</div>

				<!-- Connector Line 2 -->
				<div class="flex-1 h-1 bg-gray-300 -mx-4 mb-6"></div>

				<!-- Step 3 -->
				<div class="flex flex-col items-center flex-1">
					<div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold mb-3 relative z-10">
						3
					</div>
					<span class="text-sm font-semibold text-gray-600">numberofdependent</span>
				</div>

				<!-- Connector Line 3 -->
				<div class="flex-1 h-1 bg-gray-300 -mx-4 mb-6"></div>

				<!-- Step 4 -->
				<div class="flex flex-col items-center flex-1">
					<div class="w-12 h-12 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold mb-3 relative z-10">
						4
					</div>
					<span class="text-sm font-semibold text-gray-600">NonAcademic Achievements</span>
				</div>
			</div>
		</div>

		<!-- Form Content -->
		<div class="bg-white rounded-2xl shadow-lg p-10">
			<form action="<?= base_url('/mahasiswa/apply') ?>" method="POST">
				<!-- Section Title -->
				<div class="mb-8 border-l-4 border-[#6b3a9d] pl-4">
					<h2 class="text-2xl font-bold text-gray-900 mb-2">Personal Information</h2>
					<p class="text-sm text-gray-600">Please provide your legal contact details as they appear on your ID.</p>
				</div>

				<!-- Form Fields -->
				<div class="space-y-6">
					<!-- Row 1: Full Name and Email -->
					<div class="grid grid-cols-2 gap-6">
						<div>
							<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">GPA</label>
							<input type="number" step="0.01" placeholder="e.g. 3.8" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/20 outline-none transition" required>
						</div>
						<div>
							<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">Parent Income</label>
							<input type="number" step="0.01" placeholder="e.g. 50000" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/20 outline-none transition" required>
						</div>
					</div>

					<!-- Row 2: Phone and Date of Birth -->
					<div class="grid grid-cols-2 gap-6">
						<div>
							<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">Number of Dependents</label>
							<input type="number" placeholder="e.g. 2" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/20 outline-none transition" required>
						</div>
						<div>
							<label class="block text-xs uppercase tracking-wide font-bold text-gray-700 mb-3">Non-Academic Achievements</label>
							<input type="text" placeholder="e.g. Leadership roles, volunteer work" class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#6b3a9d] focus:ring-2 focus:ring-[#6b3a9d]/20 outline-none transition" required>
						</div>
					</div>

					<!-- Identity Verification Box -->
					<div class="mt-8 p-6 bg-gradient-to-br from-[#f3e8ff] to-[#f0e6ff] rounded-xl border border-[#e9d5ff]">
						<div class="flex items-start gap-4">
							<div class="flex-shrink-0">
								<div class="flex items-center justify-center h-6 w-6 rounded-full bg-[#6b3a9d] text-white">
									<i class="bi bi-info text-sm"></i>
								</div>
							</div>
							<div>
								<h3 class="font-semibold text-gray-900 mb-1">Identity Verification</h3>
								<p class="text-sm text-gray-700">Your information is encrypted and only used for scholarship eligibility verification. We do not share your private data with third parties.</p>
							</div>
						</div>
					</div>

					<!-- Upload ID Section -->
					<div class="mt-6 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 text-center">
						<div class="flex flex-col items-center">
							<div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white mb-3">
								<i class="bi bi-cloud-upload text-2xl"></i>
							</div>
							<p class="text-sm font-semibold text-gray-900 mb-1">Upload ID Copy</p>
							<p class="text-xs text-gray-500">JPG, PNG, PDF (Max 5MB)</p>
						</div>
					</div>
				</div>

				<!-- Bottom Actions -->
				<div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-200">
					<button type="button" class="px-6 py-2.5 text-[#6b3a9d] font-semibold bg-white border-2 border-[#6b3a9d] rounded-lg hover:bg-[#6b3a9d]/5 transition">
						Save Draft
					</button>
					<div class="flex gap-3">
						<button type="button" class="px-6 py-2.5 text-gray-700 font-semibold bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
							Previous
						</button>
						<button type="button" class="px-6 py-2.5 bg-[#6b3a9d] text-white font-semibold rounded-lg hover:bg-[#5a2d7f] transition flex items-center gap-2">
							Next Step
							<i class="bi bi-arrow-right"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>


