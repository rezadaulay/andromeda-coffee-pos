@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 antialiased">
    <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Katalog Produk</h1>
            <p class="text-gray-500 mt-1">Pilih produk berkualitas untuk transaksi hari ini.</p>
        </div>
        <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100">
            <span class="text-sm text-gray-400 uppercase tracking-widest font-semibold">Unit Terpilih:</span>
            <span id="cart-count" class="ml-2 text-xl font-bold text-teal-600">0</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="product-card group relative bg-white rounded-3xl border-2 border-transparent shadow-sm hover:border-teal-500 hover:shadow-xl transition-all duration-300 overflow-hidden"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ $product->price }}"
                    data-quantity="{{ $product->quantity }}">
                    
                    <div class="p-6 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-teal-50 text-teal-700 text-xs font-bold px-3 py-1 rounded-full">
                                ID: #{{ $product->id }}
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Stok: {{ $product->quantity }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-teal-600 transition-colors">
                            {{ $product->name }}
                        </h3>

                        <div class="mb-6">
                            <span class="text-sm text-gray-400 block italic">Harga Satuan</span>
                            <span class="text-2xl font-black text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="mt-auto pt-6 border-t border-gray-50">
                            <div class="flex items-center justify-between bg-gray-50 rounded-2xl p-1">
                                <button type="button" class="btn-decrease w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-gray-400 hover:text-red-500 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"/></svg>
                                </button>

                                <input type="text" class="qty-input w-12 text-center font-black text-lg bg-transparent border-none focus:ring-0 text-gray-800" value="0" readonly>

                                <button type="button" class="btn-increase w-10 h-10 flex items-center justify-center rounded-xl hover:bg-white hover:shadow-sm text-gray-400 hover:text-teal-500 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                </button>
                            </div>
                            <div class="mt-3 text-right">
                                <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Subtotal</span>
                                <div class="subtotal font-bold text-teal-600">Rp 0</div>
                            </div>
                            <div class="stock-warning text-sm text-red-400 mt-2 hidden">Stok tidak mencukupi</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-400 font-medium text-lg">Oops! Produk belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-10">
                <div class="bg-gray-900 rounded-[2rem] shadow-2xl p-8 text-white relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-teal-500 opacity-20 rounded-full blur-3xl"></div>
                    
                    <h2 class="text-2xl font-bold mb-6">Ringkasan <br><span class="text-teal-400">Transaksi</span></h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm text-gray-400 font-medium uppercase tracking-widest">
                            <span>Total Item</span>
                            <span id="total-items" class="text-white font-bold text-lg">0</span>
                        </div>
                        <div class="pt-4 border-t border-gray-800">
                            <span class="text-sm text-gray-400 block mb-1">Total Pembayaran</span>
                            <div id="total-price" class="text-3xl font-black text-teal-400">Rp 0</div>
                        </div>
                    </div>

                    <!-- Daftar item di cart -->
                    <div id="cart-items" class="mb-6 max-h-40 overflow-auto space-y-3">
                        <p class="text-sm text-gray-300">Belum ada item yang dipilih.</p>
                    </div>

                    <form method="POST" action="{{ route('selling.store') }}">
                        @csrf
                        <input type="hidden" id="cartData" name="cart_data" value="[]">
                        <input type="hidden" id="paymentMethodInput" name="payment_method" value="">
                        <button type="button" id="checkoutBtn" disabled
                            class="w-full py-4 rounded-2xl bg-teal-500 hover:bg-teal-400 disabled:bg-gray-700 disabled:text-gray-500 text-white font-bold text-lg transition-all transform active:scale-95 shadow-lg shadow-teal-500/20 flex items-center justify-center gap-3">
                            <span>Selesaikan Pesanan</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>

                    <!-- Checkout Modal (client-side only) -->
                    <div id="checkoutModal" class="fixed inset-0 z-50 hidden items-center justify-center">
                        <div class="absolute inset-0 bg-black/50"></div>
                        <div class="relative w-full max-w-2xl mx-auto bg-white rounded-xl overflow-hidden shadow-xl">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold">Ringkasan Pesanan</h3>
                                    <button id="modalClose" class="text-gray-500 hover:text-gray-700">✕</button>
                                </div>

                                <div id="modal-items" class="space-y-3 max-h-64 overflow-auto mb-4">
                                    <!-- populated by JS -->
                                </div>

                                <div class="flex justify-between items-center border-t pt-4">
                                    <div class="text-sm text-gray-500">Total</div>
                                    <div id="modal-total" class="text-2xl font-bold text-gray-900">Rp 0</div>
                                </div>

                                <!-- payment choice moved to sale page after saving -->

                                <div class="mt-6 flex gap-3">
                                    <button id="payBtn" class="ml-auto px-5 py-3 bg-teal-600 hover:bg-teal-500 text-white font-bold rounded-lg">Simpan</button>
                                    <button id="modalCancel" class="px-4 py-3 bg-gray-500 rounded-lg">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-[10px] text-gray-500 mt-6 text-center italic">
                        Pastikan jumlah produk sudah benar sebelum melakukan checkout.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function(){
        function formatRp(amount){
            return 'Rp ' + Number(amount || 0).toLocaleString('id-ID');
        }

        function collectCart(){
            const items = [];
            document.querySelectorAll('.product-card').forEach(card => {
                const qty = parseInt(card.querySelector('.qty-input').value || '0', 10);
                if(qty > 0){
                    items.push({
                        product_id: card.dataset.id,
                        name: card.dataset.name || card.querySelector('h3')?.textContent?.trim(),
                        quantity: qty,
                        price: parseInt(card.dataset.price || 0, 10),
                    });
                }
            });
            return items;
        }

        function renderCart(){
            const items = collectCart();
            const list = document.getElementById('cart-items');
            list.innerHTML = '';

            if(items.length === 0){
                list.innerHTML = '<p class="text-sm text-gray-300">Belum ada item yang dipilih.</p>';
            } else {
                items.forEach(it => {
                    const row = document.createElement('div');
                    row.className = 'flex items-center justify-between bg-white/5 rounded-lg p-2';
                    row.innerHTML = `
                        <div class="truncate">
                            <div class="text-sm text-gray-200 font-semibold truncate">${it.name}</div>
                            <div class="text-xs text-gray-400">Qty: ${it.quantity} × ${formatRp(it.price)}</div>
                        </div>
                        <div class="ml-4 text-right text-sm font-bold text-teal-300">${formatRp(it.quantity * it.price)}</div>
                    `;
                    list.appendChild(row);
                });
            }

            // update totals + hidden input + cart count
            const totals = items.reduce((acc, it) => {
                acc.items += it.quantity;
                acc.price += it.quantity * it.price;
                return acc;
            }, { items: 0, price: 0 });

            document.getElementById('total-items').textContent = totals.items;
            document.getElementById('total-price').textContent = formatRp(totals.price);
            document.getElementById('cart-count').textContent = totals.items;
            const cartInput = document.getElementById('cartData');
            if(cartInput) cartInput.value = JSON.stringify(items);
            const checkoutBtn = document.getElementById('checkoutBtn');
            if(checkoutBtn) checkoutBtn.disabled = totals.items === 0;
        }

        // handle increase/decrease using event delegation with stock check
        document.addEventListener('click', function(e){
            const inc = e.target.closest('.btn-increase');
            const dec = e.target.closest('.btn-decrease');
            if(inc || dec){
                const btn = inc || dec;
                const card = btn.closest('.product-card');
                if(!card) return;
                const input = card.querySelector('.qty-input');
                const current = parseInt(input.value || '0', 10);
                let newVal = inc ? current + 1 : Math.max(0, current - 1);

                // client-side stock validation
                const stock = parseInt(card.dataset.quantity || 0, 10);
                const warningEl = card.querySelector('.stock-warning');
                if(newVal > stock){
                    newVal = stock; // cap to available
                    if(warningEl){
                        warningEl.textContent = stock > 0 ? `Stok tidak mencukupi. Sisa: ${stock}` : 'Stok habis';
                        warningEl.classList.remove('hidden');
                        clearTimeout(warningEl._hideTimeout);
                        warningEl._hideTimeout = setTimeout(() => warningEl.classList.add('hidden'), 2500);
                    }
                } else if(warningEl){
                    warningEl.classList.add('hidden');
                }

                input.value = newVal;
                // update subtotal in card
                const price = parseInt(card.dataset.price || 0, 10);
                const subtotalEl = card.querySelector('.subtotal');
                if(subtotalEl) subtotalEl.textContent = formatRp(newVal * price);
                renderCart();
            }
        });

        // Checkout modal handling
        const checkoutForm = document.querySelector('form[action="{{ route("selling.store") }}"]');
        const modal = document.getElementById('checkoutModal');
        const modalItems = document.getElementById('modal-items');
        const modalTotal = document.getElementById('modal-total');
        const modalClose = document.getElementById('modalClose');
        const modalCancel = document.getElementById('modalCancel');
        const payBtn = document.getElementById('payBtn');

        function showModal(){
            if(!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function hideModal(){
            if(!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        const checkoutBtn = document.getElementById('checkoutBtn');
        if(checkoutBtn){
            checkoutBtn.addEventListener('click', function(){
                const items = collectCart();
                modalItems.innerHTML = '';
                if(items.length === 0){
                    modalItems.innerHTML = '<p class="text-sm text-gray-500">Tidak ada item.</p>';
                } else {
                    items.forEach(it => {
                        const r = document.createElement('div');
                        r.className = 'flex justify-between items-center border-b pb-2';
                        r.innerHTML = `<div class="text-sm text-gray-700">${it.name} <span class="text-xs text-gray-500">× ${it.quantity}</span></div><div class="font-semibold">${formatRp(it.quantity * it.price)}</div>`;
                        modalItems.appendChild(r);
                    });
                }
                const total = items.reduce((s, it) => s + it.quantity * it.price, 0);
                modalTotal.textContent = formatRp(total);
                showModal();
            });
        }

        if(modalClose) modalClose.addEventListener('click', hideModal);
        if(modalCancel) modalCancel.addEventListener('click', hideModal);

        if(payBtn){
            payBtn.addEventListener('click', function(){
                // submit the original checkout form (save sale), payment chosen later
                if(checkoutForm) {
                    hideModal();
                    checkoutForm.submit();
                }
            });
        }

        // init
        renderCart();
    })();
</script>
@endsection