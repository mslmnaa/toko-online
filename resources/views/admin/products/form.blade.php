<x-admin-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ isset($product) ? __('Edit Product') : __('Add New Product') }}
            </h1>
        </div>

        <!-- Form Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm transition-colors duration-200">
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">There were some problems with your input.</span>
                        <ul class="mt-3 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-6">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('name') border-red-500 @enderror" 
                               value="{{ old('name', $product->name ?? '') }}" 
                               required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight</label>
                        <input type="number" 
                               name="weight" 
                               id="weight" 
                            value="{{ old('weight', default: $product->weight ?? '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                               >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   step="0.01" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                                   value="{{ old('price', default: $product->price ?? '') }}" 
                                   required>
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                                   value="{{ old('stock', $product->stock ?? 0) }}" 
                                   required>
                        </div>
                     
                        
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <select name="category" 
                                id="category" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="coffee" {{ (old('category', $product->category ?? '') == 'coffee') ? 'selected' : '' }}>Coffee</option>
                            <option value="tea" {{ (old('category', $product->category ?? '') == 'tea') ? 'selected' : '' }}>Tea</option>
                            <option value="refresh" {{ (old('category', $product->category ?? '') == 'refresh') ? 'selected' : '' }}>Refresh</option>
                        </select>
                    </div>

                    
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-primary-50 file:text-primary-700
                                      dark:file:bg-primary-900/20 dark:file:text-primary-400
                                      hover:file:bg-primary-100 dark:hover:file:bg-primary-900/30
                                      @error('image') border-red-500 @enderror" 
                               {{ isset($product) ? '' : 'required' }}>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex justify-center rounded-md border border-transparent bg-primary-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                            {{ isset($product) ? 'Update Product' : 'Add Product' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>