<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <button type="button" wire:click="create" class=" px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"> Create </button>

    @foreach ($galleries as $gallery)

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
            <div class="relative aspect-square">
                <img
                    src="https://via.placeholder.com/300x300?text=Gallery+"
                    alt="{{$gallery->name}}"
                    class="h-48 text-gray-400"
                >
                <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                    1234 photos
                </div>
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $gallery->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ $gallery->description  }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-500 dark:text-gray-400">Created: </span>
                    <div class="flex space-x-2">
                        <button wire:click="show({{$gallery}})" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">View</button>
                        <button  wire:click="edit({{ $gallery->id }})" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        @if($isOpen)
            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="flex min-h-screen items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <!-- Modal header -->
                        <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">
                                {{ $galleryId ? 'Edit Gallery' : 'New Gallery' }}
                            </h3>
                        </div>

                        <!-- Modal body -->
                        <div class="px-6 py-4">
                            <form class="space-y-4">
                                <!-- Gallery Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Gallery Name
                                    </label>
                                    <div class="relative">
                                        <input
                                            type="text"
                                            id="name"
                                            wire:model="name"
                                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm @error('name') border-red-500 @enderror"
                                            placeholder="Enter gallery name"
                                        >
                                        @error('name')
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        @enderror
                                    </div>
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Description
                                    </label>
                                    <div class="relative">
                            <textarea
                                id="description"
                                wire:model="description"
                                rows="4"
                                class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm @error('description') border-red-500 @enderror"
                                placeholder="Enter gallery description"
                            ></textarea>
                                        @error('description')
                                        <div class="absolute top-0 right-0 pt-2 pr-3">
                                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        @enderror
                                    </div>
                                    @error('description')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Visibility Settings -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Visibility
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <label class="inline-flex items-center">
                                            <input
                                                type="checkbox"
                                                wire:model="public"
                                                value="public"
                                                class="form-radio text-blue-600 focus:ring-blue-500 dark:bg-gray-700"
                                            >
                                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Public</span>
                                        </label>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex items-center justify-end space-x-3">
                            <button type="button" wire:click="$set('isOpen', false)" lass="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Cancel
                            </button>
                            <button type="button" wire:click="save" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ $galleryId ? 'Save Changes' : 'Create Gallery' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        @endif

</div>
