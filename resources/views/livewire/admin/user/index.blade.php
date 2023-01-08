<div>
    <div class="max-w-7xl ">
        <div class="bg-skin-base overflow-hidden  sm:rounded-lg p-2">
            @if (auth()->user()->can('create users'))
                <div class="flex justify-end p-2 mb-6">
                    <x-buttons.secondary wire:click="$emit('createUser')">{{ __('Create user') }}
                    </x-buttons.secondary>
                </div>
            @endif
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow-sm overflow-hidden border-b border-gray-200 sm:rounded-lg border">
                        <table class="min-w-full divide-y divide-gray-200 sm:rounded-lg">
                            <thead class="bg-gray-50 font-medium text-left">
                                <tr>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        #</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Avatar</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col" class="px-6 py-4 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-skin-base divide-y divide-gray-200 text-gray-600">
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center ">
                                                <img class="w-10 h-10 rounded-full" src="{{ $user->avatarUrl() }}"
                                                    alt="avatar of {{ $user->username }}">
                                                <div class="ml-4 font-medium ">
                                                    <div class="font-semibold">
                                                        <a href="/users/{{ $user->username() }}">{{ $user->username() }}
                                                        </a>
                                                    </div>
                                                    <div class="text-sm ">Joined in
                                                        {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            <div class="flex justify-end">
                                                <div class="flex space-x-2 px-2">
                                                    @if (auth()->user()->can('access user roles'))
                                                        <livewire:admin.user.roles :user_id="$user->id"
                                                            wire:key="{{ $user->id }}" />
                                                    @endif
                                                    @if (auth()->user()->can('edit users'))
                                                        <x-buttons.primary wire:click.prefetch="showModal">
                                                            {{ svg('iconsax-bul-edit-2', 'w-5 h-5') }}
                                                        </x-buttons.primary>
                                                    @endif
                                                    @can('delete users')
                                                        <x-buttons.primary class="hover:text-rose-500 "
                                                            wire:click="deleteConfirm()">
                                                            {{ svg('iconsax-lin-trash', 'h-5 w-5') }}
                                                        </x-buttons.primary>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $users->withQueryString()->links('livewire::tailwind') !!}
        </div>
    </div>
    {{-- create role modal --}}
    @if (auth()->user()->can('create users'))
        <div x-data="{ modal: false }" class="flex justify-center" x-init="@this.on('createUser', () => {
            modal = true;
        });
        @this.on('closeModal', () => {
            modal = false;
        })">
            <div x-show="modal" class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true"
                aria-labelledby="modal-title-1" x-on:keydown.escape.prevent.stop="modal=false" style="display: none;">
                <div x-show="modal" class="fixed inset-0 bg-black bg-opacity-20" style="display: none;"></div>
                <div x-show="modal" x-transition="" x-on:click="modal = false"
                    class="relative flex min-h-screen items-center justify-center p-4" style="display: none;">
                    <div x-on:click.stop="" x-trap.noscroll.inert="modal"
                        class="relative w-full max-w-2xl overflow-y-auto rounded-xl bg-skin-base p-12  shadow-2xl">
                        <header class="flex items-center ">
                            <h5 class="text-3xl font-extrabold line-clamp-3  tracking-wide text-gray-700"></h5>
                            <div class="flex-1 flex justify-end">
                                <x-buttons.primary @click="modal=false" class="hover:text-skin-600">
                                    <svg class="h-6 w-6" viewBox="0 0 456 512" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor">
                                        <title>cancel</title>
                                        <path
                                            d="M64 388L196 256 64 124 96 92 228 224 360 92 392 124 260 256 392 388 360 420 228 288 96 420 64 388Z">
                                        </path>
                                    </svg>
                                </x-buttons.primary>
                            </div>
                        </header>
                        <div class="mt-8">
                            <form wire:submit.prevent="store">
                                @csrf
                                <!-- Name -->
                                <div>
                                    <x-label for="username" :value="__('User Name')" />

                                    <x-form.input-small type="text" id="username" class="block mt-1 w-full"
                                        name="username" wire:model="username" autofocus />
                                    <x-error field="username" class="text-rose-500" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-form.input-small type="email" id="email" class="block mt-1 w-full"
                                        name="email" wire:model="email" />
                                    <x-error field="email" class="text-rose-500" />
                                </div>
                                <x-buttons.secondary type="submit" class="mt-8">{{ __('Register') }}
                                </x-buttons.secondary>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
