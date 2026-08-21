<section
    x-data="{
        avatarUrl: @js($user->avatar_url ?? null),
        preview: @js($user->avatar_url ?? null),
        file: null,
        init() {
            // Reset preview to original avatar if the user cancels selection
        },
        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.file = file;
                this.preview = URL.createObjectURL(file);
            } else {
                this.file = null;
                this.preview = this.avatarUrl;
            }
        },
        resetAvatar() {
            this.file = null;
            this.preview = this.avatarUrl;
            // Clear the file input
            this.$refs.fileInput.value = '';
        }
    }"
    class="bg-white rounded-xl shadow-sm p-6 mb-6"
>
    <header class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('Profile Avatar') }}
            </h2>
            <p class="text-sm text-gray-500">
                {{ __('Update your account\'s profile picture.') }}
            </p>
        </div>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            <i class="fas fa-camera me-1"></i> Photo
        </span>
    </header>

    <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Avatar Preview & Upload Area -->
        <div class="flex flex-col md:flex-row items-center gap-6">
            <!-- Avatar Preview -->
            <div class="relative group">
                <div class="w-32 h-32 rounded-full overflow-hidden shadow-lg ring-4 ring-white transition-transform duration-300 group-hover:scale-105 bg-gray-100 flex items-center justify-center">
                    <template x-if="preview">
                        <img :src="preview" alt="Avatar" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!preview">
                        <span class="text-gray-400 text-sm">No image</span>
                    </template>
                </div>
                <!-- Hover overlay (optional) -->
                <div class="absolute inset-0 flex items-center justify-center rounded-full bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <span class="text-white text-xs font-medium">Change</span>
                </div>
            </div>

            <!-- Upload Controls -->
            <div class="flex-1 w-full">
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <!-- Hidden file input -->
                    <input type="file"
                           name="avatar"
                           accept="image/*"
                           x-ref="fileInput"
                           @change="handleFileSelect"
                           class="hidden"
                           id="avatarInput">

                    <!-- Custom label as upload button -->
                    <label for="avatarInput"
                           class="cursor-pointer inline-flex items-center px-5 py-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200 text-gray-700 hover:text-blue-600 font-medium">
                        <i class="fas fa-upload me-2"></i>
                        <span>Choose new image</span>
                    </label>

                    <!-- Reset button (only shows if a new file is selected) -->
                    <button type="button"
                            x-show="file"
                            x-transition
                            @click="resetAvatar"
                            class="text-sm text-red-500 hover:text-red-700 font-medium">
                        <i class="fas fa-times-circle me-1"></i> Remove
                    </button>

                    @error('avatar')
                        <p class="text-sm text-red-600 w-full">{{ $message }}</p>
                    @enderror
                </div>
                <p class="mt-2 text-xs text-gray-400">Recommended: Square image, at least 200×200px</p>
            </div>
        </div>

        <!-- Save Button & Status -->
        <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
            <x-primary-button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <i class="fas fa-save me-2"></i> {{ __('Save Avatar') }}
            </x-primary-button>

            @if (session('status') === 'avatar-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition.duration.300ms
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-600 font-medium"
                >
                    <i class="fas fa-check-circle me-1"></i> {{ __('Saved successfully!') }}
                </p>
            @endif
        </div>
    </form>
</section>