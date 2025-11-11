@extends('layouts.ecommerce')
@section('title','Product Inquiries | Gemarc Employee Dashboard')

@section('content')
<div class="py-8 bg-gray-50">
  <div class="max-w-6xl mx-auto">

    {{-- Page Header --}}
    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-emerald-800 tracking-tight">Product Inquiries</h1>
      <p class="mt-2 text-sm text-gray-600">
        View and manage product &amp; contact inquiries submitted from the website.
      </p>
    </div>

    <div x-data="{openInquiries:true, openContacts:true}" class="space-y-6">

      {{-- ===================== Product Inquiries ===================== --}}
      <section class="bg-white rounded-2xl border border-emerald-100 shadow-sm overflow-hidden">
        {{-- Card header --}}
        <button
          @click="openInquiries=!openInquiries"
          class="w-full flex items-center justify-between px-5 py-4 hover:bg-emerald-50/60 transition-colors"
        >
          <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-full bg-emerald-100 flex items-center justify-center">
              <svg class="w-5 h-5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h12" />
              </svg>
            </div>
            <div>
              <h2 class="text-sm font-semibold text-gray-900">Product Inquiries</h2>
              <p class="text-xs text-gray-500">Messages from product inquiry forms.</p>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
              {{ $inquiries->count() }} records
            </span>
            <svg
              class="w-5 h-5 text-gray-400 transition-transform duration-200"
              :class="openInquiries ? 'rotate-180' : ''"
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </button>

        <div x-show="openInquiries" x-transition class="border-t border-gray-100">
          @if($inquiries->isEmpty())
            <div class="px-6 py-10 text-center text-sm text-gray-500">
              No product inquiries found.
            </div>
          @else
            {{-- Filter toolbar - compact horizontal --}}
            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50 flex flex-wrap items-center gap-3 justify-between">
              <div class="flex items-center gap-2 text-xs font-medium text-gray-600">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h10M4 6h.01M10 12h10M4 12h.01M10 18h10M4 18h.01"/>
                </svg>
                <span>Filters:</span>
                <span class="hidden md:inline text-[11px] text-gray-400">
                  Choose a value then click <span class="font-semibold">Clear</span> to delete matching records.
                </span>
              </div>

              <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                {{-- NAME --}}
                <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="name"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-emerald-500 focus:border-emerald-500"
                  >
                    <option value="">Select name…</option>
                    @foreach($inquiries->pluck('name')->filter()->unique()->sort() as $n)
                      <option value="{{ $n }}">{{ $n }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- EMAIL --}}
                <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="email"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-emerald-500 focus:border-emerald-500"
                  >
                    <option value="">Select email…</option>
                    @foreach($inquiries->pluck('email')->filter()->unique()->sort() as $e)
                      <option value="{{ $e }}">{{ $e }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- PRODUCT --}}
                <form method="POST" action="{{ route('employee.inquiries.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="product"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-emerald-500 focus:border-emerald-500"
                  >
                    <option value="">Select product…</option>
                    @foreach($inquiries->pluck('product')->filter()->unique()->sort() as $p)
                      <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>
              </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
              <table class="min-w-full text-sm table-fixed">
                <colgroup>
                  <col style="width:16%">
                  <col style="width:22%">
                  <col style="width:20%">
                  <col style="width:30%">
                  <col style="width:12%">
                </colgroup>
                <thead class="bg-emerald-50 text-xs text-emerald-900 sticky top-0 z-10">
                  <tr>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Name</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Email</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Product</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Message</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Date</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  @foreach($inquiries as $inq)
                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-emerald-50/60 transition-colors">
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-800">
                        {{ $inq->name }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $inq->email }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $inq->product }}
                      </td>
                      <td class="px-4 py-2 overflow-hidden text-ellipsis text-gray-700">
                        {{ $inq->message }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-500">
                        {{ $inq->created_at->format('Y-m-d H:i') }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </section>

      {{-- ===================== Contact Us Submissions ===================== --}}
      <section class="bg-white rounded-2xl border border-sky-100 shadow-sm overflow-hidden">
        {{-- Card header --}}
        <button
          @click="openContacts=!openContacts"
          class="w-full flex items-center justify-between px-5 py-4 hover:bg-sky-50/60 transition-colors"
        >
          <div class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-full bg-sky-100 flex items-center justify-center">
              <svg class="w-5 h-5 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v8H4zM4 16h4v4H4zM10 16h10v4H10z"/>
              </svg>
            </div>
            <div>
              <h2 class="text-sm font-semibold text-gray-900">Contact Us Submissions</h2>
              <p class="text-xs text-gray-500">Messages from the general contact form.</p>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-sky-50 text-sky-700 border border-sky-100">
              {{ $contacts->count() }} records
            </span>
            <svg
              class="w-5 h-5 text-gray-400 transition-transform duration-200"
              :class="openContacts ? 'rotate-180' : ''"
              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
        </button>

        <div x-show="openContacts" x-transition class="border-t border-gray-100">
          @if($contacts->isEmpty())
            <div class="px-6 py-10 text-center text-sm text-gray-500">
              No contact submissions found.
            </div>
          @else
            {{-- Filter toolbar - compact horizontal --}}
            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50 flex flex-wrap items-center gap-3 justify-between">
              <div class="flex items-center gap-2 text-xs font-medium text-gray-600">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h10M4 6h.01M10 12h10M4 12h.01M10 18h10M4 18h.01"/>
                </svg>
                <span>Filters:</span>
                <span class="hidden md:inline text-[11px] text-gray-400">
                  Choose a value then click <span class="font-semibold">Clear</span> to delete matching records.
                </span>
              </div>

              <div class="flex flex-wrap items-center gap-2 w-full lg:w-auto">
                {{-- NAME --}}
                <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="full_name"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-sky-500 focus:border-sky-500"
                  >
                    <option value="">Select name…</option>
                    @foreach($contacts->pluck('full_name')->filter()->unique()->sort() as $n)
                      <option value="{{ $n }}">{{ $n }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- EMAIL --}}
                <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="email"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-sky-500 focus:border-sky-500"
                  >
                    <option value="">Select email…</option>
                    @foreach($contacts->pluck('email')->filter()->unique()->sort() as $e)
                      <option value="{{ $e }}">{{ $e }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- PHONE --}}
                <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="phone"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-sky-500 focus:border-sky-500"
                  >
                    <option value="">Select phone…</option>
                    @foreach($contacts->pluck('phone')->filter()->unique()->sort() as $p)
                      <option value="{{ $p }}">{{ $p }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- COMPANY --}}
                <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="company"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-sky-500 focus:border-sky-500"
                  >
                    <option value="">Select company…</option>
                    @foreach($contacts->pluck('company')->filter()->unique()->sort() as $c)
                      <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>

                {{-- SERVICE --}}
                <form method="POST" action="{{ route('employee.contacts.clear') }}" class="flex items-center gap-1">
                  @csrf @method('DELETE')
                  <select
                    name="service_interest"
                    class="h-8 rounded-md border-gray-300 text-xs bg-white focus:ring-sky-500 focus:border-sky-500"
                  >
                    <option value="">Select service…</option>
                    @foreach($contacts->pluck('service_interest')->filter()->unique()->sort() as $s)
                      <option value="{{ $s }}">{{ $s }}</option>
                    @endforeach
                  </select>
                  <button
                    type="submit"
                    class="px-2 h-8 rounded-md border border-gray-300 text-[11px] text-gray-600 hover:bg-red-50 hover:text-red-600 transition inline-flex items-center gap-1"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6L6 18"></path>
                      <path d="M6 6l12 12"></path>
                    </svg>
                    Clear
                  </button>
                </form>
              </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
              <table class="min-w-full text-sm table-fixed">
                <colgroup>
                  <col style="width:14%">
                  <col style="width:22%">
                  <col style="width:14%">
                  <col style="width:14%">
                  <col style="width:14%">
                  <col style="width:18%">
                  <col style="width:14%">
                </colgroup>
                <thead class="bg-sky-50 text-xs text-sky-900 sticky top-0 z-10">
                  <tr>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Name</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Email</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Phone</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Company</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Service Interest</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Message</th>
                    <th class="px-4 py-2 text-left font-semibold tracking-wide">Date</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                  @foreach($contacts as $contact)
                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-sky-50/70 transition-colors">
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-800">
                        {{ $contact->full_name }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $contact->email }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $contact->phone }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $contact->company }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap overflow-hidden text-ellipsis text-gray-700">
                        {{ $contact->service_interest }}
                      </td>
                      <td class="px-4 py-2 overflow-hidden text-ellipsis text-gray-700">
                        {{ $contact->message }}
                      </td>
                      <td class="px-4 py-2 whitespace-nowrap text-xs text-gray-500">
                        {{ $contact->created_at->format('Y-m-d H:i') }}
                      </td>
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
