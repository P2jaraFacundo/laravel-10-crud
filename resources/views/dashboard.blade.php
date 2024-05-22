<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Agregar tres botones -->
                    <div class="mt-4">
                        <br>
                        <a href="{{ route('students.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" style="background-color: #3b82f6;">Student</a>
                        <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" style="background-color: #67f63b;">Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
