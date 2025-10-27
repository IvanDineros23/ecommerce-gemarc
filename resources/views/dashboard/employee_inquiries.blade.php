@extends('layouts.ecommerce')
@section('title','Product Inquiries | Gemarc Employee Dashboard')

@section('content')
<div class="py-8">
  <div class="text-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Product Inquiries</h1>
    <p class="text-gray-600">View and manage product & contact inquiries submitted from the website.</p>
  </div>

  <div x-data="{openInquiries:true, openContacts:true}" class="w-full max-w-6xl mx-auto space-y-6">

    {{-- Product Inquiries --}}
    <section class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
      <button @click="openInquiries=!openInquiries" class="w-full flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
          <h2 class="text-base font-semibold text-gray-800">Product Inquiries</h2>
          <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">{{ $inquiries->count() }}</span>
        </div>
        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openInquiries ? 'rotate-180':''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
      </button>

      <div x-show="openInquiries" x-transition class="border-t border-gray-200">
        @if($inquiries->isEmpty())
          <div class="px-6 py-10 text-center text-sm text-gray-500">No product inquiries found.</div>
        @else
          {{-- Toolbar (server-side clear) --}}
          <div class="px-4 pt-3 pb-2 border-b border-gray-100">
            <div class="flex flex-wrap items-center gap-3">

              {{-- NAME --}}
              <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="inqNameSel" name="name" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Name</option>
                  @foreach($inquiries->pluck('name')->filter()->unique()->sort() as $n)
                    <option value="{{ $n }}">{{ $n }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">
                  Clear
                </button>
              </form>

              {{-- EMAIL --}}
              <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="inqEmailSel" name="email" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Email</option>
                  @foreach($inquiries->pluck('email')->filter()->unique()->sort() as $e)
                    <option value="{{ $e }}">{{ $e }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">
                  Clear
                </button>
              </form>

              {{-- PRODUCT --}}
              <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="inqProductSel" name="product" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Product</option>
                  @foreach($inquiries->pluck('product')->filter()->unique()->sort() as $p)
                    <option value="{{ $p }}">{{ $p }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">
                  Clear
                </button>
              </form>

            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full text-sm table-fixed">
              <colgroup>
                <col style="width:16%"><col style="width:22%"><col style="width:18%"><col style="width:30%"><col style="width:14%">
              </colgroup>
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th class="px-4 py-2 text-left font-medium">Name</th>
                  <th class="px-4 py-2 text-left font-medium">Email</th>
                  <th class="px-4 py-2 text-left font-medium">Product</th>
                  <th class="px-4 py-2 text-left font-medium">Message</th>
                  <th class="px-4 py-2 text-left font-medium">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                @foreach($inquiries as $inq)
                <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $inq->name }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $inq->email }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $inq->product }}</td>
                  <td class="px-4 py-2 overflow-hidden text-ellipsis">{{ $inq->message }}</td>
                  <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-500">{{ $inq->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </section>

    {{-- Contact Us Submissions --}}
    <section class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
      <button @click="openContacts=!openContacts" class="w-full flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-3">
          <h2 class="text-base font-semibold text-gray-800">Contact Us Submissions</h2>
          <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">{{ $contacts->count() }}</span>
        </div>
        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="openContacts ? 'rotate-180':''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
      </button>

      <div x-show="openContacts" x-transition class="border-t border-gray-200">
        @if($contacts->isEmpty())
          <div class="px-6 py-10 text-center text-sm text-gray-500">No contact submissions found.</div>
        @else
          {{-- Toolbar (server-side clear) --}}
          <div class="px-4 pt-3 pb-2 border-b border-gray-100">
            <div class="flex flex-wrap items-center gap-3">

              <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="conNameSel" name="full_name" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Name</option>
                  @foreach($contacts->pluck('full_name')->filter()->unique()->sort() as $n)
                    <option value="{{ $n }}">{{ $n }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">Clear</button>
              </form>

              <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="conEmailSel" name="email" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Email</option>
                  @foreach($contacts->pluck('email')->filter()->unique()->sort() as $e)
                    <option value="{{ $e }}">{{ $e }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">Clear</button>
              </form>

              <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="conPhoneSel" name="phone" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Phone</option>
                  @foreach($contacts->pluck('phone')->filter()->unique()->sort() as $p)
                    <option value="{{ $p }}">{{ $p }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">Clear</button>
              </form>

              <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="conCompanySel" name="company" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Company</option>
                  @foreach($contacts->pluck('company')->filter()->unique()->sort() as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">Clear</button>
              </form>

              <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-2">
                @csrf @method('DELETE')
                <select id="conServiceSel" name="service_interest" class="h-9 rounded-md border-gray-300 text-sm">
                  <option value="">Select Service</option>
                  @foreach($contacts->pluck('service_interest')->filter()->unique()->sort() as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                  @endforeach
                </select>
                <button type="submit" class="px-2.5 h-9 rounded-md text-sm border border-gray-300 hover:bg-gray-50">Clear</button>
              </form>

            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full text-sm table-fixed">
              <colgroup>
                <col style="width:14%"><col style="width:22%"><col style="width:14%"><col style="width:14%"><col style="width:14%"><col style="width:18%"><col style="width:14%">
              </colgroup>
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th class="px-4 py-2 text-left font-medium">Name</th>
                  <th class="px-4 py-2 text-left font-medium">Email</th>
                  <th class="px-4 py-2 text-left font-medium">Phone</th>
                  <th class="px-4 py-2 text-left font-medium">Company</th>
                  <th class="px-4 py-2 text-left font-medium">Service Interest</th>
                  <th class="px-4 py-2 text-left font-medium">Message</th>
                  <th class="px-4 py-2 text-left font-medium">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                @foreach($contacts as $contact)
                <tr class="hover:bg-gray-50">
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $contact->full_name }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $contact->email }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $contact->phone }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $contact->company }}</td>
                  <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis">{{ $contact->service_interest }}</td>
                  <td class="px-4 py-2 overflow-hidden text-ellipsis">{{ $contact->message }}</td>
                  <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-500">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </section>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
/**
 * Guard: don't allow submitting a DELETE clear if the select is empty.
 * Also asks for a quick confirmation para hindi aksidenteng ma-wipe.
 */
document.addEventListener('submit', function(e){
  const form = e.target.closest('form');
  if(!form) return;

  // Only for our clear forms (they all have exactly one SELECT)
  const sel = form.querySelector('select');
  if(!sel) return;

  if(!sel.value){
    e.preventDefault();
    alert('Please choose a value to clear.');
    sel.focus();
    return;
  }

  if(!confirm('Delete all records matching: "' + sel.value + '" ?')){
    e.preventDefault();
  }
}, true);
</script>
@endpush
