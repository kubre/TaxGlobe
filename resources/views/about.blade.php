<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                <h1 class="text-3xl">About</h1>
            </div>
            <span class="block mt-8 text-center font-bold">
                &copy; TaxGlobe India {{ date('Y') }} | <a target="_blank" class="text-indigo-500"
                    href="https://kubre.in">Designed
                    by
                    Vaibhav Kubre</a>
            </span>
        </div>
    </div>
</x-app-layout>
