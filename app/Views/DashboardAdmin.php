<?= $this->extend('layout/AdminLayout') ?>

<?= $this->section('content') ?>

<?php	$userName = $userName ?? 'Admin';
	$userEmail = $userEmail ?? 'demo@scholarcurator.id';
?>

<div class="p-8 space-y-8">
	<!-- Application Status & Active Criteria -->
	<div class="grid grid-cols-3 gap-6">
		<!-- Application Status -->
		<div class="bg-gradient-to-br from-[#f3e8ff] to-[#e9d5ff] rounded-2xl p-6 shadow-sm border border-purple-200">
			<h3 class="text-lg font-bold text-gray-900 mb-6">Summary Aplication</h3>
			<div class="space-y-4">
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">Total User</span>
					</div>
					<span class="text-lg font-bold text-gray-900">412</span>
				</div>
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">Pass</span>
					</div>
					<span class="text-lg font-bold text-gray-900">1,890</span>
				</div>
				<div class="flex items-center justify-between">
					<div class="flex items-center gap-2">
						<span class="w-3 h-3 bg-[#6b3a9d] rounded-full"></span>
						<span class="text-sm font-medium text-gray-700">did not qualify</span>
					</div>
					<span class="text-lg font-bold text-gray-900">180</span>
				</div>
			</div>
			<button class="mt-6 w-full flex items-center justify-between px-4 py-2 text-[#6b3a9d] font-semibold hover:bg-white/50 rounded-lg transition">
				REVIEW QUEUE
				<i class="bi bi-chevron-right"></i>
			</button>
		</div>

		<!-- Active Scholarship Programs -->
		<div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm">
			<div class="flex items-center justify-between mb-6">
				<h3 class="text-lg font-bold text-gray-900">Active Criteria</h3>
				<a href="#" class="text-[#6b3a9d] font-semibold text-sm hover:underline">View All Programs</a>
			</div>
			<div class="space-y-4">
				<!-- Program 1 -->
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
					<div class="flex items-center gap-4">
						<div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white">
							<i class="bi bi-globe"></i>
						</div>
						<div>
							<h4 class="font-semibold text-gray-900">Global STEM Excellence Fund</h4>
							<p class="text-sm text-gray-500">Deadline: Oct 15, 2024</p>
						</div>
					</div>
					<div class="text-right">
						<p class="font-bold text-[#6b3a9d]">1,204</p>
						<span class="text-xs bg-[#6b3a9d]/10 text-[#6b3a9d] px-2 py-1 rounded font-semibold">IN REVIEW</span>
					</div>
				</div>
				<!-- Program 2 -->
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
					<div class="flex items-center gap-4">
						<div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#ec4899] to-[#f43f5e] flex items-center justify-center text-white">
							<i class="bi bi-palette"></i>
						</div>
						<div>
							<h4 class="font-semibold text-gray-900">Visionary Arts Grant 2024</h4>
							<p class="text-sm text-gray-500">Deadline: Nov 02, 2024</p>
						</div>
					</div>
					<div class="text-right">
						<p class="font-bold text-[#fbbf24]">542</p>
						<span class="text-xs bg-[#fbbf24]/20 text-[#b45309] px-2 py-1 rounded font-semibold">OPEN</span>
					</div>
				</div>
				<!-- Program 3 -->
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-xl hover:border-[#6b3a9d] transition">
					<div class="flex items-center gap-4">
						<div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] flex items-center justify-center text-white">
							<i class="bi bi-people"></i>
						</div>
						<div>
							<h4 class="font-semibold text-gray-900">Civic Leaders Fellowship</h4>
							<p class="text-sm text-gray-500">Deadline: Dec 20, 2024</p>
						</div>
					</div>
					<div class="text-right">
						<p class="font-bold text-gray-500">736</p>
						<span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded font-semibold">DRAFT</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Recent Applicant Inquiries & Scale Impact -->
	<div class="grid grid-cols-3 gap-6">
		<!-- Recent Applicant Inquiries -->
		<div class="col-span-2 bg-white rounded-2xl p-6 shadow-sm">
			<div class="flex items-center justify-between mb-6">
				<h3 class="text-lg font-bold text-gray-900">Recent Applicant Inquiries</h3>
				<a href="#" class="text-[#6b3a9d] font-semibold text-sm hover:underline">Go to Inbox</a>
			</div>
			<div class="grid grid-cols-2 gap-4">
				<!-- Inquiry 1 -->
				<div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition">
					<div class="flex items-center gap-3 mb-3">
						<div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#fbbf24] to-[#f59e0b] flex items-center justify-center text-white font-bold text-sm">
							ER
						</div>
						<h4 class="font-semibold text-gray-900">Elena Rodriguez</h4>
					</div>
					<p class="text-sm text-gray-600">"When is the scoring window closing?"</p>
				</div>
				<!-- Inquiry 2 -->
				<div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition">
					<div class="flex items-center gap-3 mb-3">
						<div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#3b82f6] to-[#1e40af] flex items-center justify-center text-white font-bold text-sm">
							MT
						</div>
						<h4 class="font-semibold text-gray-900">Marcus Thorne</h4>
					</div>
					<p class="text-sm text-gray-600">"Problem with my documents..."</p>
				</div>
			</div>
		</div>

		<!-- Scale Your Impact -->
		<div class="bg-gradient-to-br from-[#6b3a9d] to-[#4f2782] rounded-2xl p-6 text-white shadow-lg">
			<h3 class="text-lg font-bold mb-2">Scale your impact with Analytics</h3>
			<p class="text-sm opacity-75 mb-6">Export detailed demographic reports to better understand your applicant pool reach.</p>
			<button class="w-full bg-white text-[#6b3a9d] font-bold py-2 rounded-lg hover:bg-gray-100 transition">
				Generate Report
			</button>
		</div>
	</div>
</div>

<?= $this->endSection() ?>
