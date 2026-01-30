@extends('admin.layout')

@section('title', 'Manage Pages')

@section('content')
<div class="bg-[#eef2fb] px-4 md:px-8 py-6">
    <div class="mb-4">
        <h1 class="text-3xl font-extrabold text-slate-900">Manage Pages</h1>
    </div>

    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4 text-lg font-semibold">Add New Post</div>
        <div class="p-6 space-y-5">
            <div>
                <label class="text-sm font-semibold text-slate-700">Meta Title</label>
                <input type="text" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Enter Meta Title">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Meta Description</label>
                <input type="text" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Enter Meta Description">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Page Title</label>
                <input type="text" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Enter Keyword Title">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Image Alt Text</label>
                <input type="text" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Enter Image Alt Text">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Heading 2</label>
                <input type="text" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100" placeholder="Enter Heading 2">
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Type</label>
                <select class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-100">
                    <option>Post</option>
                    <option>Page</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700">Page Description:</label>
                <div class="mt-2 rounded-xl border border-slate-200 bg-slate-50">
                    <div class="flex gap-2 px-4 py-3 text-slate-600 text-sm">
                        <span class="font-semibold">Toolbar mock</span>
                        <span class="text-slate-400">(Hook your editor here)</span>
                    </div>
                    <div class="h-48 bg-white border-t border-slate-200"></div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-5 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow-md">Save</button>
                <a href="{{ route('admin.pages') }}" class="px-5 py-3 rounded-lg border border-slate-200 text-slate-800 font-semibold bg-white">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
