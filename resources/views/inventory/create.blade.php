@extends('layouts.backend')

@section('navTheme')
{{ 'light' }}
@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}
@endsection

@section('content')
<section class="min-vh-100 d-flex align-items-start mt-5 pt-5vh">
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('inventory.index') }}"
                        class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Back</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                        <form method="post" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="quantity" class="block text-sm font-medium text-gray-700"> Quantity </label>
                                <div class="mt-1">
                                    <input type="text" id="quantity" name="quantity"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('quantity')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Added Initial Stock -->
                            <div class="sm:col-span-6">
                                <label for="initial_stock" class="block text-sm font-medium text-gray-700"> Initial Stock </label>
                                <div class="mt-1">
                                    <input type="number" id="initial_stock" name="initial_stock" 
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('initial_stock')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                                <div class="mt-1">
                                    <input type="number" min="0.00" max="10000.00" step="0.01" id="price" name="price"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('price')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sm:col-span-6 pt-5">
                                <label for="status" class="block text-sm font-medium text-gray-700"> Status </label>
                                <div class="mt-1">
                                    <select id="status" name="status" class="form-multiselect block w-full mt-1">
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-6 p-4">
                                <button type="submit"
                                    class="px-4 py-2 btn-sm primary-btn rounded-lg text-white">Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
