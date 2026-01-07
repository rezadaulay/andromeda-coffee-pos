@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

	<div class="flex justify-between items-center mb-4">
		<h1 class="text-xl font-bold">Daftar Metode Pembayaran</h1>
	</div>

	@if(session('success'))
		<div class="mb-4 text-green-700">{{ session('success') }}</div>
	@endif
	@if(session('error'))
		<div class="mb-4 text-red-700">{{ session('error') }}</div>
	@endif

	<div class="overflow-x-auto">
		<table class="min-w-full border border-gray-200">
			<thead class="bg-gray-50">
				<tr>
					<th class="px-4 py-2 text-left text-sm font-semibold border">Nama</th>
					<th class="px-4 py-2 text-left text-sm font-semibold border">Deskripsi</th>
					<th class="px-4 py-2 text-left text-sm font-semibold border">Action</th>
				</tr>
			</thead>

			<tbody>
				@forelse($paymentMethods as $method)
				<tr class="hover:bg-gray-50">
					<td class="px-4 py-2 border">{{ $method->name }}</td>
                    <td class="px-4 py-2 border">{{ $method->description }}</td>
                    <th class="px-4 py-2 border">
                        <a href="/dashboard/payment/detail/{{ $method->id }}" class="text-teal-600 hover:underline text-sm">Detail</a>
                    </th>
				</tr>
				@empty
				<tr>
					<td class="px-4 py-2 border text-center" colspan="2">Belum ada metode pembayaran.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

	@if(method_exists($paymentMethods, 'hasPages') && $paymentMethods->hasPages())
		<div class="mt-4">
			{{ $paymentMethods->links() }}
		</div>
	@endif

</div>

@endsection