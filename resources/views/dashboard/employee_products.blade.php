@extends('layouts.ecommerce')

@section('content')
<style>[x-cloak]{display:none!important}</style>

<div class="py-8 bg-gray-50">
  <div class="max-w-6xl mx-auto" x-data="productPage()">

    {{-- Title --}}
    <h1 class="text-2xl md:text-3xl font-extrabold text-emerald-800 mb-4">Product Management</h1>

    {{-- Toasts --}}
    @if(session('success'))
      <div x-data="{show:true, init(){ setTimeout(()=> this.show=false, 4000) }}" x-show="show" x-transition
           class="mb-4 flex items-center justify-between bg-emerald-50 border border-emerald-200 text-emerald-900 px-4 py-3 rounded-xl shadow-sm">
        <div class="flex items-center gap-2">✅
          <span class="text-sm">
            {{ session('success') }}
            @if(session('added_product_name'))
              <span class="font-semibold">{{ session('added_product_name') }}</span>
            @endif
          </span>
        </div>
        <button @click="show=false" class="ml-4 text-emerald-700 hover:text-emerald-900 text-lg leading-none">&times;</button>
      </div>
    @endif

    @if(session('product_updated'))
      <div x-data="{show:true}" x-show="show" x-transition
           class="mb-4 flex items-center justify-between bg-sky-50 border border-sky-200 text-sky-900 px-4 py-3 rounded-xl shadow-sm">
        <div class="flex items-center gap-2">✏️
          <span class="text-sm">{{ session('product_updated') }}</span>
        </div>
        <button @click="show=false" class="ml-4 text-sky-700 hover:text-sky-900 text-lg leading-none">&times;</button>
      </div>
    @endif

    @if(session('product_deleted'))
      <div x-data="{show:true}" x-show="show" x-transition
           class="mb-4 flex items-center justify-between bg-red-50 border border-red-200 text-red-900 px-4 py-3 rounded-xl shadow-sm">
        <div class="flex items-center gap-2">🗑️
          <span class="text-sm">{{ session('product_deleted') }}</span>
        </div>
        <button @click="show=false" class="ml-4 text-red-700 hover:text-red-900 text-lg leading-none">&times;</button>
      </div>
    @endif

    {{-- ================= Add New Product ================= --}}
  <section class="bg-white rounded-2xl shadow-sm border border-emerald-100 mb-8">
      <div class="px-6 pt-5 pb-4 flex items-center justify-between gap-4 border-b border-gray-100">
        <div>
          <h2 class="text-lg font-semibold text-emerald-800">Add New Product</h2>
          <p class="text-xs text-gray-500">Fill out the details below to add a new item to the catalogue.</p>
        </div>
      </div>

  <form method="POST" action="{{ route('employee.products.store') }}" enctype="multipart/form-data"
    class="px-6 pt-4 pb-8 space-y-5">
        @csrf
        <div class="grid gap-6 md:grid-cols-2">
          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Product Name</label>
            <input type="text" name="name"
              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              required>
          </div>

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Unit Price</label>
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center justify-center text-sm font-medium text-gray-600 bg-gray-100 border border-gray-300 rounded-md px-3 py-2">₱</span>
              <input type="number" name="unit_price" min="0" step="0.01" placeholder="Enter amount"
                class="w-full border border-gray-300 rounded-md px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
            </div>
          </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Stock Quantity</label>
            <input type="number" name="stock" min="0" step="1"
              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
              required>
          </div>

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Product Image</label>
            <input type="file" name="image"
              class="w-full border border-dashed border-gray-300 rounded-lg px-3 py-3 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <p class="mt-1 text-[11px] text-gray-400">Optional. JPG / PNG, preferably square.</p>
          </div>
        </div>

        <div>
          <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Description</label>
          <textarea name="description" rows="3"
            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            placeholder="Describe what this product is used for…" required></textarea>
        </div>

        {{-- Footer bar for Add Product button --}}
        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
          <button type="submit"
                  class="group inline-flex items-center gap-3 rounded-full bg-emerald-600 px-6 py-3
                         text-white text-sm md:text-base font-semibold shadow-lg ring-1 ring-emerald-300/30
                         transition-all hover:bg-emerald-700 hover:shadow-xl hover:-translate-y-0.5
                         focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-400 focus-visible:ring-offset-2">
            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/15 ring-1 ring-white/20">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
              </svg>
            </span>
            <span>Add Product</span>
          </button>
        </div>
        <br>
      </form>
    </section>

    {{-- ================= All Products ================= --}}
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200">
      <div class="px-6 pt-5 pb-4 flex items-center justify-between gap-4 border-b border-gray-100">
        <div>
          <h2 class="text-lg font-semibold text-emerald-800">All Products</h2>
          <p class="text-xs text-gray-500">Overview of all items currently in the system.</p>
        </div>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
          {{ $products->total() }} items
        </span>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full text-sm table-fixed">
          <colgroup>
            <col style="width:20%"><col style="width:35%"><col style="width:12%"><col style="width:8%"><col style="width:13%"><col style="width:12%">
          </colgroup>
          <thead class="bg-gray-50 text-xs text-gray-600 uppercase tracking-wide">
            <tr>
              <th class="px-4 py-3 text-left font-semibold">Name</th>
              <th class="px-4 py-3 text-left font-semibold">Description</th>
              <th class="px-4 py-3 text-left font-semibold">Unit Price</th>
              <th class="px-4 py-3 text-left font-semibold">Stock</th>
              <th class="px-4 py-3 text-left font-semibold">Image</th>
              <th class="px-4 py-3 text-left font-semibold text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($products as $product)
              @php $img = $product->firstImagePath(); @endphp
              <tr class="hover:bg-emerald-50/40 transition-colors">
                <td class="px-4 py-3 align-top font-medium text-gray-900">{{ $product->name }}</td>
                <td class="px-4 py-3 align-top text-gray-700">
                  <div class="max-h-16 overflow-hidden text-ellipsis">{{ $product->description }}</div>
                </td>
                <td class="px-4 py-3 align-top text-gray-800 whitespace-nowrap">₱{{ number_format($product->unit_price, 2) }}</td>
                <td class="px-4 py-3 align-top text-gray-800 text-center">{{ $product->stock }}</td>
                <td class="px-4 py-3 align-top text-center">
                  @if($img)
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md border border-gray-200 mx-auto">
                  @else
                    <span class="text-[11px] text-gray-400">No image</span>
                  @endif
                </td>
                <td class="px-4 py-3 align-top">
                  <div class="flex flex-col items-center gap-1">
                    {{-- EDIT (button, no submit) --}}
                    <button type="button"
                      class="text-xs font-semibold text-sky-700 hover:text-sky-900 hover:underline"
                      @click='openEdit({
                        id: {{ $product->id }},
                        name: @json($product->name),
                        description: @json($product->description),
                        unit_price: {{ $product->unit_price }},
                        stock: {{ $product->stock }},
                        image_url: @json($img ? asset("storage/".$img) : ""),
                        update_url: @json(route("employee.products.update", $product))
                      })'>
                      Edit
                    </button>

                    {{-- DELETE (button, no submit) --}}
                    <form id="deleteForm-{{ $product->id }}" action="{{ route('employee.products.destroy', $product) }}" method="POST" class="hidden">
                      @csrf @method('DELETE')
                    </form>
                    <button type="button"
                      class="text-xs font-semibold text-red-600 hover:text-red-700 hover:underline"
                      @click='openDelete({ id: {{ $product->id }}, name: @json($product->name) })'>
                      Delete
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="px-6 py-4 border-t border-gray-100 bg-white/50 flex items-center justify-between">
        <div class="text-sm text-gray-600">Showing <span class="font-medium">{{ $products->firstItem() ?: 0 }}</span> to <span class="font-medium">{{ $products->lastItem() ?: 0 }}</span> of <span class="font-medium">{{ $products->total() }}</span> products</div>
        <div>
          {{ $products->links() }}
        </div>
      </div>
    </section>

    {{-- ================= Edit Modal ================= --}}
    <div x-show="showEdit" x-transition.opacity x-cloak
         class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
         @keydown.window.escape="closeEdit()" @click.self="closeEdit()">
      <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 w-full max-w-lg relative" @click.stop>
        <button @click="closeEdit()" class="absolute top-2 right-2 text-gray-400 hover:text-red-600 text-2xl leading-none">&times;</button>
        <h2 class="text-xl font-bold text-orange-600 mb-4">Edit Product</h2>

        <form :action="edit.update_url" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf
          @method('PUT')

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Product Name</label>
            <input type="text" name="name"
              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
              x-model="edit.name" required>
          </div>

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Description</label>
            <textarea name="description" rows="3"
              class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
              x-model="edit.description" required></textarea>
          </div>

          <div class="grid gap-4 md:grid-cols-2">
            <div>
              <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Unit Price</label>
              <input type="number" name="unit_price" min="0" step="0.01"
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                x-model="edit.unit_price" required>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Stock Quantity</label>
              <input type="number" name="stock" min="0" step="1"
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                x-model="edit.stock" required>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1 uppercase tracking-wide">Image</label>
            <input type="file" name="image"
              class="w-full border border-dashed border-gray-300 rounded-lg px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            <template x-if="edit.image_url">
              <img :src="edit.image_url" alt="Product Image" class="w-16 h-16 object-cover rounded mt-2 border border-gray-200">
            </template>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-sm hover:bg-orange-600 active:bg-orange-700 transition">
              Update Product
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- ================= Delete Modal ================= --}}
    <div x-show="showDelete" x-transition.opacity x-cloak
         class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
         @keydown.window.escape="closeDelete()" @click.self="closeDelete()">
      <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 w-full max-w-md relative" @click.stop>
        <button @click="closeDelete()" class="absolute top-2 right-3 text-gray-400 hover:text-red-600 text-2xl leading-none" style="position: absolute; top: 10px; right: 10px;">&times;</button>
        <h2 class="text-xl font-bold text-red-600 mb-3">Delete Product</h2>
        <p class="mb-6 text-sm text-gray-700">
          Are you sure you want to delete <span class="font-semibold" x-text="del.name"></span>? This action cannot be undone.
        </p>
        <div class="flex justify-end gap-3">
          <button @click="closeDelete()" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm hover:bg-gray-200">Cancel</button>
          <button @click="confirmDelete()" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-semibold hover:bg-red-700">Yes, Delete</button>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Alpine (must be present for the clicks to work) --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function productPage(){
  return {
    // Edit modal state
    showEdit: false,
    edit: { id:null, name:'', description:'', unit_price:'', stock:'', image_url:'', update_url:'' },

    // Delete modal state
    showDelete: false,
    del: { id:null, name:'' },

    // Open edit
    openEdit(p){
      this.edit = { ...p };
      this.showEdit = true;
    },
    closeEdit(){ this.showEdit = false; },

    // Open delete
    openDelete(p){
      this.del = { ...p };
      this.showDelete = true;
    },
    closeDelete(){ this.showDelete = false; this.del = { id:null, name:'' }; },

    // Submit the hidden delete form once confirmed
    confirmDelete(){
      if(!this.del.id) return;
      const form = document.getElementById('deleteForm-' + this.del.id);
      if(form) form.submit();
      this.closeDelete();
    }
  }
}
</script>
@endsection
