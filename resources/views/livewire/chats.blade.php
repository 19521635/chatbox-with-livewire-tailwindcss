<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Chats') }}
    </h2>
</x-slot>

<div class="py-12" wire:poll>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-12">
            <div class="h-96 col-span-9 flex flex-col">
                <div class="flex-grow overflow-y-scroll" id="messages">
                    @foreach ($chats as $chat)
                    <div class="@if($loop->even) bg-blue-50 @endif h-14 px-4 py-2 flex flex-row overflow-y-hidden">
                        <div class="text-blue-700 hover:text-blue-900 font-bold cursor-pointer">
                            {{$chat->name}}:
                        </div>
                        <div class="text-black font-semibold ml-2">
                            {{$chat->body}}
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="h-16">
                    <form class="h-full grid grid-cols-12" wire:submit.prevent="send()">
                        <input type="text"
                            class="col-span-11 focus:outline-none focus:ring-0 focus:border-opacity-0 border-b-0 border-l-0 border-r-0 border-blue-200"
                            placeholder="Type something ..." wire:model.defer="body">

                        <button type="button" wire:click.prevent="send()"
                            class="bg-blue-300 focus-within:outline-none hover:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 m-auto text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
            <div class="col-span-3 bg-gray-50 flex flex-col">
                @foreach ($users as $user)
                <div
                    class="px-4 py-2 cursor-pointer text-blue-700 hover:text-blue-900 font-bold flex flex-row justify-items-center items-center">
                    <div class="h-2 w-2 rounded-full @if($user->isOnline()) bg-green-400 @endif bg-red-400 mr-1">
                    </div> {{$user->name}}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>